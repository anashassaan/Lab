<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Course</h2>
            <a href="{{ route('courses.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Back to list</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('courses.store') }}" class="space-y-6">
                        @include('courses.partials.form', [
                            'submitLabel' => 'Create course',
                            'cancelUrl' => route('courses.index'),
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
