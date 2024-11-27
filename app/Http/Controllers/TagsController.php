<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Question;
use App\Http\Requests\UpdateQuestionTagsRequest;
use Illuminate\Validation\Rule;

class TagsController extends Controller
{
    public function index(Request $request)
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('view tags')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to view tags.');
        }

        // $tags = Tag::with('questionTags')->paginate(10);
        $search = $request->input('query');
        $tags = Tag::with(['questionTags'])
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10);
        return view('tags.index', compact('tags'));
    }

    public function applyTags(UpdateQuestionTagsRequest $request, Question $question)
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('edit questions')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to edit questions.');
        }

        $question->tags()->sync($request->tags);
        return redirect()->route('questions.edit', $question->id);
    }

    public function create() {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('create tags')) {
            return redirect()->route('tags.index')->with('error', 'You do not have permission to create tags.');
        }

        return view('tags.create');
    }

    public function store(StoreTagRequest $request) {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('create tags')) {
            return redirect()->route('tags.index')->with('error', 'You do not have permission to create tags.');
        }

        $validated = $request->validated();
        Tag::create($validated);
        return redirect()->route('tags.index')->with('success', 'Tag created successfully.');
    }

    public function edit(Tag $tag) {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('edit tags')) {
            return redirect()->route('tags.index')->with('error', 'You do not have permission to edit tags.');
        }

        return view('tags.edit', compact('tag'));
    }
    public function update(Request $request, Tag $tag)
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('edit tags')) {
            return redirect()->route('tags.index')->with('error', 'You do not have permission to edit tags.');
        }

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tags', 'name')->ignore($tag->id)
            ]
        ]);

        $tag->update($validated);
        return redirect()->route('tags.index');
    }

    public function delete(Tag $tag) {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('delete tags')) {
            return redirect()->route('certificates.index')->with('error', 'You do not have permission to delete tags.');
        }

        return view('tags.delete', compact('tag'));
    }

    public function destroy(Request $request, Tag $tag)
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('delete tags')) {
            return redirect()->route('tags.index')->with('error', 'You do not have permission to delete tags.');
        }

        $tag->delete();
        return redirect()->route('tags.index')->with('success', 'Certificate deleted successfully.');
    }
}
