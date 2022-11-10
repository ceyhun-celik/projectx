<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Authorization') }}
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
                    <form action="{{ route('authorizations.store') }}" method="post"> @csrf
                        <!-- User Name -->
                        <div class="mb-4">
                            <x-input-label for="user_id" :value="__('User Name')" />

                            <x-select name="user_id">
                                @forelse ($users as $user)
                                    @if ($loop->first)
                                        <option value="">{{ __('-- Select --') }}</option>
                                    @endif

                                    <option {{ old('user_id') == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                @empty
                                    <option value="">No result found</option>
                                @endforelse
                            </x-select>

                            <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                        </div>

                        <!-- Role Name -->
                        <div class="mb-4">
                            <x-input-label for="role_id" :value="__('Role Name')" />

                            <x-select name="role_id">
                                @forelse ($roles as $role)
                                    @if ($loop->first)
                                        <option value="">{{ __('-- Select --') }}</option>
                                    @endif

                                    <option {{ old('role_id') == $role->id ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->role_name }}</option>
                                @empty
                                    <option value="">No result found</option>
                                @endforelse
                            </x-select>

                            <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
                        </div>

                        <!-- Button -->
                        <div class="flex justify-end">
                            <x-primary-button>
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
