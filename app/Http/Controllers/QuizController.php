<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Classes\TelemetryClass;
use App\Http\Requests\StoreQuizRequest;
use App\Http\Requests\SubmitQuizForResultsRequest;
use App\Models\Course;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('view quizzes')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to view quizzes.');
        }

        // $quizzes = Quiz::query()->paginate(10);
        $search = $request->input('query');
        $quizzes = Quiz::query()
            ->when($search, function ($query) use ($search) {
                return $query->where('title', 'like', "%{$search}%");
            })
            ->paginate(10);
        $trashedCount = Quiz::onlyTrashed()->count();
        return view('quizzes.index', compact('quizzes', 'trashedCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('create quizzes')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to create quizzes.');
        }

        $courses = Course::all();
        return view('quizzes.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuizRequest $request)
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('create quizzes')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to create quizzes.');
        }

        $validated = $request->validated();
        Quiz::create($validated);
        return redirect(route('quizzes.index'))->with('success', 'Quiz created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('view quizzes')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to view quizzes.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('edit quizzes')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to edit quizzes.');
        }

        $quiz = Quiz::findOrFail($id);
        $courses = Course::all();
        $questions = Question::all();
        return view('quizzes.edit', compact('quiz', 'courses', 'questions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreQuizRequest $request, Quiz $quiz)
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('edit quizzes')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to edit quizzes.');
        }

        $validated = $request->validated();
        $quiz->update($validated);
        return redirect(route('quizzes.index'))->with('success', 'Quiz updated successfully.');
    }
    
    public function delete($id)
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('delete quizzes')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to delete quizzes.');
        }

        $quiz = Quiz::findOrFail($id);
        return view('quizzes.delete', compact('quiz'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();
        return redirect(route('quizzes.index'))->with('success', 'Quiz moved to trash successfully.');
    }
    public function trash()
    {
        $trashedQuizzes = Quiz::onlyTrashed()->get();
        return view('quizzes.trash', compact('trashedQuizzes'));
    }

    public function restore($id)
    {
        $quiz = Quiz::onlyTrashed()->findOrFail($id);
        $quiz->restore();
        return redirect(route('quizzes.index'))->with('success', 'Quiz restored successfully.');
    }

    public function remove($id)
    {
        $quiz = Quiz::onlyTrashed()->findOrFail($id);
        $quiz->forceDelete();
        return redirect(route('quizzes.index'))->with('success', 'Quiz permanently deleted.');
    }

    public function restoreAll()
    {
        Quiz::onlyTrashed()->restore();
        return redirect(route('quizzes.index'))->with('success', 'All quizzes restored successfully.');
    }

    public function empty()
    {
        Quiz::onlyTrashed()->forceDelete();
        return redirect(route('quizzes.index'))->with('success', 'All quizzes permanently deleted.');
    }
}
