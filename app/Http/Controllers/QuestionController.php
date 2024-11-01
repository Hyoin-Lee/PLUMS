<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Models\Question;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $questions = Question::with(['answers'])->paginate(10);
        return view('questions.index', compact('questions'));
    }

    public function create()
    {
        return view('questions.create');
    }

    public function edit(Question $question)
    {
        return view('questions.edit', compact('question'));
    }

    public function show($id)
    {
        $question = Question::with('answers')->findOrFail($id);
        return response()->json($question);
    }

    public function store(StoreQuestionRequest $request)
    {
        $validated = $request->validated();
        Question::create($validated);
        return redirect()->route('questions.index');
    }

    public function update(StoreQuestionRequest $request, Question $question)
    {
        $validated = $request->validated();
        $question->update($validated);
        return redirect()->route('questions.index');
    }

    public function destroy(Request $request, Question $question)
    {
        $question->delete();
        return redirect()->route('questions.index')->with('success', 'Question deleted successfully.');
    }
}
