<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Course</p>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $course->title }}</h2>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('courses.edit', $course) }}" class="inline-flex items-center px-4 py-2 bg-amber-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-600 focus:bg-amber-600 active:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:ring-offset-2 transition ease-in-out duration-150">Edit</a>
                <a href="{{ route('courses.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Back</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if(session('status'))
                <div class="rounded-md bg-green-50 border border-green-200 text-green-800 px-4 py-3">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-3">
                    <div>
                        <p class="text-sm text-gray-500">Instructor</p>
                        <p class="text-lg font-medium text-gray-900">{{ $course->instructor ?? 'Not set' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Schedule</p>
                        <p class="text-lg font-medium text-gray-900">
                            Starts: {{ $course->starts_at?->format('M d, Y') ?? 'TBD' }}
                            <span class="mx-2 text-gray-400">|</span>
                            Ends: {{ $course->ends_at?->format('M d, Y') ?? 'TBD' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Description</p>
                        <p class="text-gray-800 leading-relaxed whitespace-pre-line">{{ $course->description ?? 'No description provided.' }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Created</p>
                        <p class="text-gray-800">{{ $course->created_at->toDayDateTimeString() }}</p>
                    </div>
                    <form method="POST" action="{{ route('courses.destroy', $course) }}" onsubmit="return confirm('Delete this course?');">
                        @csrf
                        @method('DELETE')
                        <x-danger-button>Delete course</x-danger-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
