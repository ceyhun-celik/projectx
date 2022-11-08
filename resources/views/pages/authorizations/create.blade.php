<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Authorization') }}
        </h2>
    </x-slot>

    <div class="px-1 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 flex justify-end">
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
                            <x-input-label for="name" :value="__('User Name')" />

                            <x-select>
                                @forelse ($users as $user)
                                    @if ($loop->first)
                                        <option value="">-- Select --</option>
                                    @endif

                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @empty
                                    <option value="">No result found</option>
                                @endforelse
                            </x-select>

                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
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
