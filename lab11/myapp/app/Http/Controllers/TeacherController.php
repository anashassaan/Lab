<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $teachers = Teacher::where('user_id', $request->user()->id)
            ->latest()
            ->paginate(10);

        return view('teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('teachers', 'email')],
            'phone' => ['nullable', 'string', 'max:30'],
            'department' => ['nullable', 'string', 'max:255'],
        ]);

        Teacher::create($data + ['user_id' => $request->user()->id]);

        return redirect()->route('teachers.index')->with('status', 'Teacher added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Teacher $teacher): View
    {
        $this->authorizeTeacher($request, $teacher);

        return view('teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Teacher $teacher): View
    {
        $this->authorizeTeacher($request, $teacher);

        return view('teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher): RedirectResponse
    {
        $this->authorizeTeacher($request, $teacher);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('teachers', 'email')->ignore($teacher->id)],
            'phone' => ['nullable', 'string', 'max:30'],
            'department' => ['nullable', 'string', 'max:255'],
        ]);

        $teacher->update($data);

        return redirect()->route('teachers.show', $teacher)->with('status', 'Teacher updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Teacher $teacher): RedirectResponse
    {
        $this->authorizeTeacher($request, $teacher);

        $teacher->delete();

        return redirect()->route('teachers.index')->with('status', 'Teacher removed.');
    }

    private function authorizeTeacher(Request $request, Teacher $teacher): void
    {
        if ($teacher->user_id !== $request->user()->id) {
            abort(403);
        }
    }
}
