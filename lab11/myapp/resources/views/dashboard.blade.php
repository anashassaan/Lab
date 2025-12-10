<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-3">
                    <p class="text-lg font-semibold">Welcome to Mini-LMS</p>
                    <p class="text-gray-700">Manage your courses with the navigation links below.</p>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('courses.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Go to Courses</a>
                        <a href="{{ route('courses.create') }}" class="text-sm text-indigo-700 hover:text-indigo-900">Create a course</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
