<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Teachers</h2>
            <a href="{{ route('teachers.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Add Teacher</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-4">
                    @if(session('status'))
                        <div class="rounded-md bg-green-50 border border-green-200 text-green-800 px-4 py-3">{{ session('status') }}</div>
                    @endif

                    @if($teachers->isEmpty())
                        <p class="text-gray-700">No teachers yet. Add the first one.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($teachers as $teacher)
                                        <tr>
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <div class="font-semibold text-gray-900">{{ $teacher->name }}</div>
                                                <div class="text-sm text-gray-500">Added {{ $teacher->created_at->diffForHumans() }}</div>
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap">{{ $teacher->email }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap">{{ $teacher->phone ?? '—' }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap">{{ $teacher->department ?? '—' }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-right space-x-2">
                                                <a href="{{ route('teachers.show', $teacher) }}" class="text-indigo-600 hover:text-indigo-900 text-sm">View</a>
                                                <a href="{{ route('teachers.edit', $teacher) }}" class="text-amber-600 hover:text-amber-900 text-sm">Edit</a>
                                                <form method="POST" action="{{ route('teachers.destroy', $teacher) }}" class="inline" onsubmit="return confirm('Delete this teacher?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">{{ $teachers->links() }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
