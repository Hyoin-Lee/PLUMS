<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('view courses')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to view courses.');
        }

        // $courses = Course::with('questions')->paginate(10);
        $search = $request->input('query');
        $courses = Course::with(['questions'])
            ->when($search, function ($query) use ($search) {
                return $query->where('title', 'like', "%{$search}%");
            })
            ->paginate(10);
        $softDeletedCount = Course::onlyTrashed()->count();
        return view('courses.index', compact('courses', 'softDeletedCount'));
    }

    public function create()
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('create courses')) {
            return redirect()->route('courses.index')->with('error', 'You do not have permission to create courses.');
        }

        return view('courses.create');
    }

    public function store(StoreCourseRequest $request)
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('create courses')) {
            return redirect()->route('courses.index')->with('error', 'You do not have permission to create courses.');
        }

        $validated = $request->validated();
        Course::create($validated);
        return view('courses.index');
    }

    public function edit(Course $course)
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('edit courses')) {
            return redirect()->route('courses.index')->with('error', 'You do not have permission to edit courses.');
        }

        return view('courses.edit', compact('course'));
    }

    public function update(StoreCourseRequest $request, Course $course)
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('edit courses')) {
            return redirect()->route('courses.index')->with('error', 'You do not have permission to edit courses.');
        }

        $validated = $request->validated();
        $course->update($validated);
        return redirect()->route('courses.index');
    }

    public function delete(Course $course)
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('delete courses')) {
            return redirect()->route('courses.index')->with('error', 'You do not have permission to delete courses.');
        }

        return view('courses.delete', compact('course'));
    }

    public function destroy(Course $course)
    {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('delete courses')) {
            return redirect()->route('courses.index')->with('error', 'You do not have permission to delete courses.');
        }

        $course->delete();
        return view('courses.index')->with('success', 'Course deleted successfully.');
    }

    public function trash()
    {
        $trashedCourses = Course::onlyTrashed()->get();
        return view('courses.trash', compact('trashedCourses'));
    }

    public function restore($id)
    {
        $course = Course::onlyTrashed()->findOrFail($id);
        $course->restore();
        return redirect(route('courses.trash'))->with('success', 'Course restored successfully.');
    }

    public function forceDelete($id)
    {
        $course = Course::onlyTrashed()->findOrFail($id);
        $course->forceDelete();
        return redirect(route('courses.trash'))->with('success', 'Course deleted permanently.');
    }

}
