<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $students = Student::where('user_id', $request->user()->id)
            ->latest()
            ->paginate(10);

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('students', 'email')],
            'phone' => ['nullable', 'string', 'max:30'],
            'roll_number' => ['required', 'string', 'max:50', Rule::unique('students', 'roll_number')],
            'program' => ['nullable', 'string', 'max:255'],
        ]);

        Student::create($data + ['user_id' => $request->user()->id]);

        return redirect()->route('students.index')->with('status', 'Student added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Student $student): View
    {
        $this->authorizeStudent($request, $student);

        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Student $student): View
    {
        $this->authorizeStudent($request, $student);

        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student): RedirectResponse
    {
        $this->authorizeStudent($request, $student);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('students', 'email')->ignore($student->id)],
            'phone' => ['nullable', 'string', 'max:30'],
            'roll_number' => ['required', 'string', 'max:50', Rule::unique('students', 'roll_number')->ignore($student->id)],
            'program' => ['nullable', 'string', 'max:255'],
        ]);

        $student->update($data);

        return redirect()->route('students.show', $student)->with('status', 'Student updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Student $student): RedirectResponse
    {
        $this->authorizeStudent($request, $student);

        $student->delete();

        return redirect()->route('students.index')->with('status', 'Student removed.');
    }

    private function authorizeStudent(Request $request, Student $student): void
    {
        if ($student->user_id !== $request->user()->id) {
            abort(403);
        }
    }
}
