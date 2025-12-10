<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $userId = auth()->id();

        $stats = [
            'courses' => Course::where('user_id', $userId)->count(),
            'teachers' => Teacher::where('user_id', $userId)->count(),
            'students' => Student::where('user_id', $userId)->count(),
        ];

        $recentCourses = Course::where('user_id', $userId)->latest()->take(5)->get();
        $recentTeachers = Teacher::where('user_id', $userId)->latest()->take(5)->get();
        $recentStudents = Student::where('user_id', $userId)->latest()->take(5)->get();

        return view('dashboard', compact('stats', 'recentCourses', 'recentTeachers', 'recentStudents'));
    })->name('dashboard');

    Route::resource('courses', CourseController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('students', StudentController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
