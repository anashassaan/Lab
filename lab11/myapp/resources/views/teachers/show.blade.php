<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Teacher</p>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $teacher->name }}</h2>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('teachers.edit', $teacher) }}" class="inline-flex items-center px-4 py-2 bg-amber-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-600 focus:bg-amber-600 active:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:ring-offset-2 transition ease-in-out duration-150">Edit</a>
                <a href="{{ route('teachers.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Back</a>
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
                        <p class="text-lg font-medium text-gray-900">{{ $teacher->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Phone</p>
                        <p class="text-lg font-medium text-gray-900">{{ $teacher->phone ?? 'Not set' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Department</p>
                        <p class="text-lg font-medium text-gray-900">{{ $teacher->department ?? 'Not set' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Created</p>
                        <p class="text-gray-800">{{ $teacher->created_at->toDayDateTimeString() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Last updated</p>
                        <p class="text-gray-800">{{ $teacher->updated_at->diffForHumans() }}</p>
                    </div>
                    <form method="POST" action="{{ route('teachers.destroy', $teacher) }}" onsubmit="return confirm('Delete this teacher?');">
                        @csrf
                        @method('DELETE')
                        <x-danger-button>Delete teacher</x-danger-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
