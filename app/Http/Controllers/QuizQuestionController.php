<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Classes\TelemetryClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuizQuestionRequest;
use App\Http\Requests\SubmitQuizForResultsRequest;
use App\Models\Course;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizResult;
use App\Models\QuizResultAnswer;
use App\Models\User;
use Illuminate\Http\Request;

class QuizQuestionController extends Controller
{
    public function store(StoreQuizQuestionRequest $request) {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('create quizzes')) {
            return redirect()->route('home')->with('error', 'You do not have permission to create quizzes.');
        }

        $validated = $request->validated();
        QuizQuestion::create($validated);
        $quiz = Quiz::find($validated['quiz_id']);
        return redirect()->route('quizzes.edit', $quiz);
    }

    public function destroy(int $quizQuestionId) {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('delete quizzes')) {
            return redirect()->route('home')->with('error', 'You do not have permission to delete quizzes.');
        }

        // Laravel was being weird and wouldn't do this normally - not sure why, but this workaround works
        $quizQuestion = QuizQuestion::find($quizQuestionId);
        $quizId = $quizQuestion->quiz_id;
        $quizQuestion->delete();
        $quiz = Quiz::find($quizId);
        return redirect()->route('quizzes.edit', $quiz);
    }

    private function submitResults(User $user, int $score, int $totalScore, int | null $quizId, int | null $courseId, string | null $tags, $submitted, int | null $recommendation) {
        $quizResult = QuizResult::create([
            'user_id' => $user->id,
            'quiz_id' => $quizId,
            'course_id' => $courseId,
            'tags' => $tags,
            'score' => $score,
            'total_score' => $totalScore,
            'recommendation_id' => $recommendation
        ]);

        foreach ($submitted as $submission) {
            $questionId = $submission['questionId'];
            $answerId = $submission['answerId'];

            QuizResultAnswer::create([
                'quiz_result_id' => $quizResult->id,
                'question_id' => $questionId,
                'answer_id' => $answerId,
//                'time_taken' => null
            ]);
        }
    }

    public function fetchQuizInfo(Quiz $quiz) {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('view quizzes')) {
            return redirect()->route('home')->with('error', 'You do not have permission to view quizzes.');
        }

        $questions = $quiz->questions;

        $toReturn = $questions->map(function ($question) {
            return [
                'id' => $question->id,
                'question' => $question->question,
                'answers' => $question->answers->map(function ($answer) {
                    return [
                        'id' => $answer->id,
                        'answer' => $answer->answer,
                    ];
                })->toArray()
            ];
        });

        return ApiResponseClass::sendResponse($toReturn, "Fetched quiz information");
    }

    public function fetchAllQuizzes() {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('view quizzes')) {
            return redirect()->route('home')->with('error', 'You do not have permission to view quizzes.');
        }

        $quizzes = Quiz::all();
        $courses = Course::all();

        $toReturn = [
            'static' => $quizzes->map(function ($quiz) {
                return [
                    'id' => $quiz->id,
                    'title' => $quiz->title,
                    'description' => $quiz->description ?? "No description provided",
                ];
            })->toArray(),
            'dynamic' => $courses->map(function ($course) {
                return [
                    'id' => $course->id,
                    'title' => $course->title,
                    'description' => "A quiz dynamically generated for $course->title"
                ];
            })->toArray()
        ];

        return ApiResponseClass::sendResponse($toReturn, "Fetched quizzes");
    }

    public function generateQuiz(Request $request) {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('view quizzes')) {
            return redirect()->route('home')->with('error', 'You do not have permission to view quizzes.');
        }

        $courseId = $request->get('courseId');

        if (!$courseId) {
            if ($request->query('tags')) {
                return $this->generateQuizViaTags($request);
            } else {
                return ApiResponseClass::sendResponse([], 'You must provide a course id or valid tags', false, 400);
            }
        }

        $questions = collect();
        $certificateLevels = Question::where('course_id', $courseId)->distinct()->pluck('certificate_id');

        foreach ($certificateLevels as $level) {
            $questionsForLevel = Question::where('course_id', $courseId)->where('certificate_id', $level)->inRandomOrder()->limit(5) ->get();
            $questions = $questions->merge($questionsForLevel);
        }

        $toReturn = $questions->map(function ($question) {
            return [
                'id' => $question->id,
                'question' => $question->question,
                'answers' => $question->answers->map(function ($answer) {
                    return [
                        'id' => $answer->id,
                        'answer' => $answer->answer,
                    ];
                })->toArray()
            ];
        });

        return ApiResponseClass::sendResponse($toReturn, "Successfully generated quiz for courseId $courseId");
    }

    public function generateQuizViaTags(Request $request) {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('view quizzes')) {
            return redirect()->route('home')->with('error', 'You do not have permission to view quizzes.');
        }

        $courseId = $request->get('courseId');
        $tags = $request->query('tags');
        $tagsArr = is_string($tags) ? explode(',', $tags) : null;

        if (!$tagsArr) {
            return ApiResponseClass::sendResponse([], 'You must provide valid tags', false, 400);
        }

        $questions = collect();
        $certificateLevels = Question::whereHasTag($tagsArr)->distinct()->pluck('certificate_id');

        foreach ($certificateLevels as $level) {
            $questionsForLevel = Question::whereHasTag($tagsArr)->where('certificate_id', $level)->inRandomOrder()->limit(5)->get();
            $questions = $questions->merge($questionsForLevel);
        }

        $toReturn = $questions->map(function ($question) {
            return [
                'id' => $question->id,
                'question' => $question->question,
                'answers' => $question->answers->map(function ($answer) {
                    return [
                        'id' => $answer->id,
                        'answer' => $answer->answer,
                    ];
                })->toArray()
            ];
        });

        return ApiResponseClass::sendResponse($toReturn, "Successfully generated quiz for tags \"$tags\"");
    }

    public function submitQuiz(SubmitQuizForResultsRequest $request)
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('submit quizzes')) {
            return redirect()->route('home')->with('error', 'You do not have permission to submit quizzes.');
        }

        $validated = $request->validated();
        $submitted = $validated['answers'];
        $quizId = $validated['quizId'] ?? null;

        if (!$quizId) {
            return $this->submitDynamicQuiz($request);
        }

        if (!$submitted || !is_array($submitted)) {
            return ApiResponseClass::sendResponse([], 'Failed to grade', false, 400);
        }

        $score = 0;
        $totalScore = 0;
        $correct = [];
        $incorrect = [];

        foreach ($submitted as $submission) {
            $questionId = $submission['questionId'];
            $answerId = $submission['answerId'];
            $question = Question::find($questionId);

            if (!$question) {
                continue;
            }

            $answers = $question->answers;
            $toScore = $question->score;
            $submittedAnswer = $answers->firstWhere('id', $answerId);

            if ($submittedAnswer && $submittedAnswer->correct) {
                $score += $toScore;
                $correct[] = $questionId;
            } else {
                $correctAnswer = $answers->firstWhere('correct', true);
                $incorrect[] = [
                    'question' => [
                        'id' => $question->id,
                        'text' => $question->question,
                    ],
                    'submittedAnswer' => [
                        'id' => $submittedAnswer->id,
                        'text' => $submittedAnswer->answer,
                    ],
                    'correctAnswer' => $correctAnswer ? [
                        'id' => $correctAnswer->id,
                        'text' => $correctAnswer->answer,
                    ] : null
                ];
            }

            $totalScore += $toScore;
        }

        $results = [
            'id' => $quizId ?? "dynamic",
            'score' => $score,
            'totalScore' => $totalScore,
            'percentage' => ($score / $totalScore) * 100,
            'correct' => $correct,
            'incorrect' => $incorrect,
        ];

        $this->submitResults($user, $score, $totalScore, $quizId, null, null, $submitted, null);
        // TelemetryClass::logTelemetry('quiz_graded', $results, 'mobile', $request->ip(), $user->id);
        return ApiResponseClass::sendResponse($results, 'Graded successfully');
    }

    public function submitDynamicQuiz(SubmitQuizForResultsRequest $request)
    {
        $user = auth('sanctum')->user();
        $validated = $request->validated();
        $submitted = $validated['answers'];
        $courseId = $validated['courseId'] ?? null;
        $tags = $validated['tags'] ?? null;

        if (!$submitted || !is_array($submitted)) {
            return ApiResponseClass::sendResponse([], 'Failed to grade', false, 400);
        }

        $results = [];
        $lowestCertId = 100;
        $lowestCert = null;

        foreach ($submitted as $submission) {
            $questionId = $submission['questionId'];
            $answerId = $submission['answerId'];
            $question = Question::find($questionId);

            if (!$question) {
                continue;
            }

            $certificate = $question->certificate;
            $certificateId = $certificate->id;

            if ($lowestCertId > $certificateId) {
                $lowestCertId = $certificateId;
                $lowestCert = $certificate;
            }

            $toScore = $question->score;
            $answers = $question->answers;
            $submittedAnswer = $answers->firstWhere('id', $answerId);

            if (!isset($results[$certificateId])) {
                $results[$certificateId] = [
                    'certName' => $certificate->cert_name,
                    'threshold' => $certificate->threshold,
                    'score' => 0,
                    'totalScore' => 0,
                    'correct' => [],
                    'incorrect' => [],
                ];
            }

            $correctAnswer = $answers->firstWhere('correct', true);
            $isCorrect = $submittedAnswer && $submittedAnswer->correct;

            if ($isCorrect) {
                $results[$certificateId]['score'] += $toScore;
                $results[$certificateId]['correct'][] = $questionId;
            } else {
                $results[$certificateId]['incorrect'][] = [
                    'question' => [
                        'id' => $question->id,
                        'text' => $question->question,
                    ],
                    'submittedAnswer' => [
                        'id' => $submittedAnswer->id ?? null,
                        'text' => $submittedAnswer->answer ?? null,
                    ],
                    'correctAnswer' => [
                        'id' => $correctAnswer->id,
                        'text' => $correctAnswer->answer,
                    ]
                ];
            }

            $results[$certificateId]['totalScore'] += $toScore;
        }

        $score = 0;
        $totalScore = 0;
        $highestCertName = $lowestCert->cert_name;
        $highestCertLevel = $lowestCert->id;

        foreach ($results as $level => $data) {
            $score += $data['score'];
            $totalScore += $data['totalScore'];

            $results[$level]['percentage'] = ($data['totalScore'] > 0)
                ? ($data['score'] / $data['totalScore']) * 100
                : 0;

            if ($results[$level]['percentage'] >= $results[$level]['threshold']) {
                if ($highestCertLevel < $level) {
                    $highestCertName = $results[$level]['certName'];
                    $highestCertLevel = $level;
                }
            }
        }

        $finalResults = [
            'id' => "dynamic",
            'results' => $results,
            'score' => $score,
            'totalScore' => $totalScore,
            'percentage' => $score / $totalScore * 100,
            'recommendation' => [
                'id' => $highestCertLevel,
                'certName' => $highestCertName,
            ]
        ];

        $this->submitResults($user, $score, $totalScore, null, $courseId, $tags, $submitted, $highestCertLevel);
        // TelemetryClass::logTelemetry('dynamic_quiz_graded', $finalResults, 'mobile', $request->ip(), $user->id);
        return ApiResponseClass::sendResponse($finalResults, 'Graded dynamic quiz successfully');
    }
}
