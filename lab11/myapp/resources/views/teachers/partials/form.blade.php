@csrf
@if(isset($teacher))
    @method('PUT')
@endif

<div class="space-y-6">
    <div>
        <x-input-label for="name" value="Name" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus value="{{ old('name', $teacher->name ?? '') }}" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" required value="{{ old('email', $teacher->email ?? '') }}" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="phone" value="Phone" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" value="{{ old('phone', $teacher->phone ?? '') }}" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>
    </div>
    <div>
        <x-input-label for="department" value="Department" />
        <x-text-input id="department" name="department" type="text" class="mt-1 block w-full" value="{{ old('department', $teacher->department ?? '') }}" />
        <x-input-error :messages="$errors->get('department')" class="mt-2" />
    </div>

    <div class="flex items-center gap-3">
        <x-primary-button>{{ $submitLabel ?? 'Save teacher' }}</x-primary-button>
        <a href="{{ $cancelUrl ?? route('teachers.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
    </div>
</div>
