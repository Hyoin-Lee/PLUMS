<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\Question;
use App\Models\Tag;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('view questions')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to view questions.');
        }

        $search = $request->input('query');
        $questions = Question::with(['answers'])
            ->when($search, function ($query) use ($search) {
                return $query->where('question', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('questions.index', compact('questions'));
    }

    public function create()
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('create questions')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to create questions.');
        }

        $allTags = Tag::all();
        $courses = Course::all();
        $certificates = Certificate::all();
        return view('questions.create', compact('allTags', 'courses', 'certificates'));
    }

    public function edit(Question $question)
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('edit questions')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to edit questions.');
        }

        $allTags = Tag::all();
        $questionTags = $question->tags()->get();
        $courses = Course::all();
        $certificates = Certificate::all();
        return view('questions.edit', compact('question', 'allTags', 'questionTags', 'courses', 'certificates'));
    }

    public function show($id)
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('view questions')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to view questions.');
        }

        $question = Question::with('answers')->findOrFail($id);
        return view($question);
    }

    public function store(StoreQuestionRequest $request)
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('create questions')) {
            return redirect()->route('questions.index')->with('error', 'You do not have permission to create questions.');
        }

        $validated = $request->validated();
        Question::create($validated);
        return redirect(route('questions.index'));
    }

    public function update(StoreQuestionRequest $request, Question $question)
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('edit questions')) {
            return redirect()->route('questions.index')->with('error', 'You do not have permission to edit questions.');
        }

        $validated = $request->validated();
        $question->update($validated);
        return redirect(route('questions.index'));
    }

    public function delete(Question $question) {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('delete questions')) {
            return redirect()->route('questions.index')->with('error', 'You do not have permission to delete questions.');
        }

        return view('questions.delete', compact('question'));
    }

    public function destroy(Question $question)
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('delete questions')) {
            return redirect()->route('questions.index')->with('error', 'You do not have permission to delete questions.');
        }

        $question->delete();
        return redirect(route('questions.index'))->with('success', 'Question deleted successfully.');
    }
}
