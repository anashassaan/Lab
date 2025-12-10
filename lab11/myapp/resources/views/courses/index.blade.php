<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Courses</h2>
            <a href="{{ route('courses.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">New Course</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-4">
                    @if(session('status'))
                        <div class="rounded-md bg-green-50 border border-green-200 text-green-800 px-4 py-3">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($courses->isEmpty())
                        <p class="text-gray-700">No courses yet. Create your first course to get started.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Instructor</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Starts</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ends</th>
                                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($courses as $course)
                                        <tr>
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <div class="font-semibold text-gray-900">{{ $course->title }}</div>
                                                <div class="text-sm text-gray-500">Created {{ $course->created_at->diffForHumans() }}</div>
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap">{{ $course->instructor ?? '—' }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap">{{ $course->starts_at?->format('M d, Y') ?? 'TBD' }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap">{{ $course->ends_at?->format('M d, Y') ?? 'TBD' }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-right space-x-2">
                                                <a href="{{ route('courses.show', $course) }}" class="text-indigo-600 hover:text-indigo-900 text-sm">View</a>
                                                <a href="{{ route('courses.edit', $course) }}" class="text-amber-600 hover:text-amber-900 text-sm">Edit</a>
                                                <form method="POST" action="{{ route('courses.destroy', $course) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm" onclick="return confirm('Delete this course?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">{{ $courses->links() }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
