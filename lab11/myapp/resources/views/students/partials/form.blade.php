@csrf
@if(isset($student))
    @method('PUT')
@endif

<div class="space-y-6">
    <div>
        <x-input-label for="name" value="Name" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus value="{{ old('name', $student->name ?? '') }}" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" required value="{{ old('email', $student->email ?? '') }}" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="phone" value="Phone" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" value="{{ old('phone', $student->phone ?? '') }}" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <x-input-label for="roll_number" value="Roll number" />
            <x-text-input id="roll_number" name="roll_number" type="text" class="mt-1 block w-full" required value="{{ old('roll_number', $student->roll_number ?? '') }}" />
            <x-input-error :messages="$errors->get('roll_number')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="program" value="Program" />
            <x-text-input id="program" name="program" type="text" class="mt-1 block w-full" value="{{ old('program', $student->program ?? '') }}" />
            <x-input-error :messages="$errors->get('program')" class="mt-2" />
        </div>
    </div>

    <div class="flex items-center gap-3">
        <x-primary-button>{{ $submitLabel ?? 'Save student' }}</x-primary-button>
        <a href="{{ $cancelUrl ?? route('students.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
    </div>
</div>
