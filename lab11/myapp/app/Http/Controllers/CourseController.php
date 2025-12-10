<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $courses = Course::where('user_id', $request->user()->id)
            ->latest()
            ->paginate(10);

        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'instructor' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
        ]);

        Course::create($data + ['user_id' => $request->user()->id]);

        return redirect()
            ->route('courses.index')
            ->with('status', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Course $course): View
    {
        $this->authorizeCourse($request, $course);

        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Course $course): View
    {
        $this->authorizeCourse($request, $course);

        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course): RedirectResponse
    {
        $this->authorizeCourse($request, $course);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'instructor' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
        ]);

        $course->update($data);

        return redirect()
            ->route('courses.show', $course)
            ->with('status', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Course $course): RedirectResponse
    {
        $this->authorizeCourse($request, $course);

        $course->delete();

        return redirect()
            ->route('courses.index')
            ->with('status', 'Course deleted successfully.');
    }

    private function authorizeCourse(Request $request, Course $course): void
    {
        if ($course->user_id !== $request->user()->id) {
            abort(403);
        }
    }
}
