<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\StoreQuestionRequest;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function store(StoreAnswerRequest $request)
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('create answers')) {
            return redirect()->route('questions.edit', $question)->with('error', 'You do not have permission to create answers.');
        }

        $validated = $request->validated();
        Answer::create($validated);
        $question = Question::find($validated['question_id']);
        return redirect()->route('questions.edit', $question);
    }

    public function edit(Answer $answer)
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('edit answers')) {
            return redirect()->route('questions.edit', $answer->question_id)->with('error', 'You do not have permission to edit answers.');
        }

        return view('answers.edit', compact('answer'));
    }

    public function update(StoreAnswerRequest $request, Answer $answer)
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('edit answers')) {
            return redirect()->route('questions.edit', $answer->question_id)->with('error', 'You do not have permission to edit answers.');
        }

        $validated = $request->validated();
        $answer->update($validated);
        $question = Question::find($answer->question_id);
        return redirect()->route('questions.edit', $question);
    }

    public function destroy(Answer $answer) {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('delete answers')) {
            return redirect()->route('questions.edit', $answer->question_id)->with('error', 'You do not have permission to delete answers.');
        }

        $answer->delete();
        $question = Question::find($answer->question_id);
        return redirect()->route('questions.edit', $question);
    }
}
