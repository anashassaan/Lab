<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Welcome back</p>
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">Mini LMS Overview</h2>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('courses.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md font-semibold text-xs uppercase tracking-wide hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">New Course</a>
                <a href="{{ route('teachers.create') }}" class="inline-flex items-center px-4 py-2 bg-amber-500 text-white rounded-md font-semibold text-xs uppercase tracking-wide hover:bg-amber-600 focus:ring-2 focus:ring-amber-400 focus:ring-offset-2">New Teacher</a>
                <a href="{{ route('students.create') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-md font-semibold text-xs uppercase tracking-wide hover:bg-emerald-700 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">New Student</a>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            @php
                $sessionJson = session('academic_snapshot');
                $academicSnapshot = $sessionJson ? json_decode($sessionJson, true) : null;
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white shadow-sm rounded-lg p-6 border border-slate-100">
                    <p class="text-sm text-gray-500">Courses</p>
                    <p class="text-3xl font-semibold text-gray-900 mt-2">{{ $stats['courses'] ?? 0 }}</p>
                    <p class="text-sm text-gray-500 mt-1">Owned by you</p>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-6 border border-slate-100">
                    <p class="text-sm text-gray-500">Teachers</p>
                    <p class="text-3xl font-semibold text-gray-900 mt-2">{{ $stats['teachers'] ?? 0 }}</p>
                    <p class="text-sm text-gray-500 mt-1">Faculty roster</p>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-6 border border-slate-100">
                    <p class="text-sm text-gray-500">Students</p>
                    <p class="text-3xl font-semibold text-gray-900 mt-2">{{ $stats['students'] ?? 0 }}</p>
                    <p class="text-sm text-gray-500 mt-1">Enrolled learners</p>
                </div>
            </div>

            <div class="bg-white shadow-sm rounded-lg p-6 border border-slate-100">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-sm text-gray-500">Session Insight</p>
                        <h3 class="text-lg font-semibold text-gray-900">Automatic session data</h3>
                    </div>
                    <span class="text-xs uppercase tracking-wide text-gray-500">Real time</span>
                </div>
                <dl class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <dt class="text-sm text-gray-500">Login counter</dt>
                        <dd class="text-2xl font-semibold text-gray-900">{{ session('login_counter', 0) }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Last login</dt>
                        <dd class="text-base font-medium text-gray-900">{{ session('last_login_time', '—') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Username</dt>
                        <dd class="text-base font-medium text-gray-900">{{ session('username', '—') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Role</dt>
                        <dd class="text-base font-medium text-gray-900">{{ session('role', '—') }}</dd>
                    </div>
                </dl>

                <div class="mt-6">
                    <p class="text-sm text-gray-500 mb-2">JSON snapshot (course, semester, year)</p>
                    <pre class="bg-slate-900 text-slate-50 text-sm rounded-md p-4 overflow-x-auto">{{ $sessionJson ?? 'No session JSON recorded yet.' }}</pre>

                    @if($academicSnapshot)
                        <ul class="mt-3 text-sm text-gray-700 grid grid-cols-1 sm:grid-cols-3 gap-2">
                            <li><span class="font-semibold text-gray-900">Course:</span> {{ $academicSnapshot['course'] ?? '—' }}</li>
                            <li><span class="font-semibold text-gray-900">Semester:</span> {{ $academicSnapshot['semester'] ?? '—' }}</li>
                            <li><span class="font-semibold text-gray-900">Year:</span> {{ $academicSnapshot['year'] ?? '—' }}</li>
                        </ul>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white shadow-sm rounded-lg border border-slate-100">
                    <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                        <div>
                            <p class="text-sm text-gray-500">Recent Courses</p>
                            <h3 class="text-lg font-semibold text-gray-900">Latest 5</h3>
                        </div>
                        <a href="{{ route('courses.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800">View all</a>
                    </div>
                    <div class="divide-y divide-slate-100">
                        @forelse($recentCourses as $course)
                            <div class="px-6 py-4 flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $course->title }}</p>
                                    <p class="text-sm text-gray-500">Starts {{ $course->starts_at?->format('M d, Y') ?? 'TBD' }}</p>
                                </div>
                                <a href="{{ route('courses.show', $course) }}" class="text-sm text-indigo-600 hover:text-indigo-800">Open</a>
                            </div>
                        @empty
                            <div class="px-6 py-4 text-gray-500">No courses yet.</div>
                        @endforelse
                    </div>
                </div>

                <div class="bg-white shadow-sm rounded-lg border border-slate-100">
                    <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                        <div>
                            <p class="text-sm text-gray-500">Recent Teachers</p>
                            <h3 class="text-lg font-semibold text-gray-900">Latest 5</h3>
                        </div>
                        <a href="{{ route('teachers.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800">View all</a>
                    </div>
                    <div class="divide-y divide-slate-100">
                        @forelse($recentTeachers as $teacher)
                            <div class="px-6 py-4 flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $teacher->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $teacher->department ?? 'No department' }}</p>
                                </div>
                                <a href="{{ route('teachers.show', $teacher) }}" class="text-sm text-indigo-600 hover:text-indigo-800">Open</a>
                            </div>
                        @empty
                            <div class="px-6 py-4 text-gray-500">No teachers yet.</div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm rounded-lg border border-slate-100">
                <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                    <div>
                        <p class="text-sm text-gray-500">Recent Students</p>
                        <h3 class="text-lg font-semibold text-gray-900">Latest 5</h3>
                    </div>
                    <a href="{{ route('students.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800">View all</a>
                </div>
                <div class="divide-y divide-slate-100">
                    @forelse($recentStudents as $student)
                        <div class="px-6 py-4 flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-900">{{ $student->name }}</p>
                                <p class="text-sm text-gray-500">{{ $student->program ?? 'No program' }} • Roll {{ $student->roll_number }}</p>
                            </div>
                            <a href="{{ route('students.show', $student) }}" class="text-sm text-indigo-600 hover:text-indigo-800">Open</a>
                        </div>
                    @empty
                        <div class="px-6 py-4 text-gray-500">No students yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
