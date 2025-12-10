<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Student</h2>
            <a href="{{ route('students.show', $student) }}" class="text-sm text-gray-600 hover:text-gray-900">Back to student</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('students.update', $student) }}" class="space-y-6">
                        @include('students.partials.form', [
                            'student' => $student,
                            'submitLabel' => 'Update student',
                            'cancelUrl' => route('students.show', $student),
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
