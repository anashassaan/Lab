<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Student</p>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $student->name }}</h2>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('students.edit', $student) }}" class="inline-flex items-center px-4 py-2 bg-amber-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-600 focus:bg-amber-600 active:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:ring-offset-2 transition ease-in-out duration-150">Edit</a>
                <a href="{{ route('students.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Back</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if(session('status'))
                <div class="rounded-md bg-green-50 border border-green-200 text-green-800 px-4 py-3">{{ session('status') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="text-lg font-medium text-gray-900">{{ $student->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Phone</p>
                        <p class="text-lg font-medium text-gray-900">{{ $student->phone ?? 'Not set' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Roll number</p>
                        <p class="text-lg font-medium text-gray-900">{{ $student->roll_number }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Program</p>
                        <p class="text-lg font-medium text-gray-900">{{ $student->program ?? 'Not set' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Created</p>
                        <p class="text-gray-800">{{ $student->created_at->toDayDateTimeString() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Last updated</p>
                        <p class="text-gray-800">{{ $student->updated_at->diffForHumans() }}</p>
                    </div>
                    <form method="POST" action="{{ route('students.destroy', $student) }}" onsubmit="return confirm('Delete this student?');">
                        @csrf
                        @method('DELETE')
                        <x-danger-button>Delete student</x-danger-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
