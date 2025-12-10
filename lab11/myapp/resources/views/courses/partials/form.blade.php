@csrf
@if(isset($course))
    @method('PUT')
@endif

<div class="space-y-6">
    <div>
        <x-input-label for="title" value="Title" />
        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required autofocus value="{{ old('title', $course->title ?? '') }}" />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="instructor" value="Instructor" />
        <x-text-input id="instructor" name="instructor" type="text" class="mt-1 block w-full" value="{{ old('instructor', $course->instructor ?? '') }}" />
        <x-input-error :messages="$errors->get('instructor')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="description" value="Description" />
        <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $course->description ?? '') }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <x-input-label for="starts_at" value="Starts on" />
            <x-text-input id="starts_at" name="starts_at" type="date" class="mt-1 block w-full" value="{{ old('starts_at', isset($course) && $course->starts_at ? $course->starts_at->format('Y-m-d') : '') }}" />
            <x-input-error :messages="$errors->get('starts_at')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="ends_at" value="Ends on" />
            <x-text-input id="ends_at" name="ends_at" type="date" class="mt-1 block w-full" value="{{ old('ends_at', isset($course) && $course->ends_at ? $course->ends_at->format('Y-m-d') : '') }}" />
            <x-input-error :messages="$errors->get('ends_at')" class="mt-2" />
        </div>
    </div>

    <div class="flex items-center gap-3">
        <x-primary-button>{{ $submitLabel ?? 'Save Course' }}</x-primary-button>
        <a href="{{ $cancelUrl ?? route('courses.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
    </div>
</div>
