<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Authorization') }}
        </h2>
    </x-slot>

    <div class="px-1 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 flex justify-end">
                <!-- Button:List -->
                <a href="{{ route('authorizations.index') }}">
                    <x-primary-button>
                        {{ __('List') }}
                    </x-primary-button>
                </a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('authorizations.update', $authorization->id) }}" method="post"> @csrf @method('PUT')
                        <!-- Name -->
                        <div class="mb-4">
                            <x-input-label :value="__('Name')" />

                            <x-input-label :value="$authorization->user->name" />
                        </div>

                        <!-- Role Name -->
                        <div class="mb-4">
                            <x-input-label for="role_id" :value="__('Role Name')" />

                            <x-select name="role_id">
                                @forelse ($roles as $role)
                                    @if ($loop->first)
                                        <option value="">{{ __('-- Select --') }}</option>
                                    @endif

                                    <option {{ old('role_id') ?? $authorization->role_id == $role->id ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->role_name }}</option>
                                @empty
                                    <option value="">No result found</option>
                                @endforelse
                            </x-select>

                            <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <x-input-label for="status" :value="__('Status')" />

                            <x-select name="status">
                                <option value="">{{ __('-- Select --') }}</option>
                                <option {{ old('status') ?? $authorization->status == 'active' ? 'selected' : '' }} value="active">{{ __('Active') }}</option>
                                <option {{ old('status') ?? $authorization->status == 'banned' ? 'selected' : '' }} value="banned">{{ __('Banned') }}</option>
                            </x-select>

                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <!-- Button -->
                        <div class="flex justify-end">
                            <x-primary-button>
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
