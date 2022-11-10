<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show User') }}
        </h2>
    </x-slot>

    <div class="px-1 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success class="mb-4" />

            <div class="mb-4 flex justify-end">
                <a href="{{ route('users.index') }}">
                    <x-primary-button class="mr-1">
                        {{ __('List') }}
                    </x-primary-button>
                </a>

                <a href="{{ route('users.watch', $user->id) }}">
                    <x-primary-button class="mr-1">
                        {{ __('Watch') }}
                    </x-primary-button>

                <a href="{{ route('users.audits', $user->id) }}">
                    <x-primary-button>
                        {{ __('Audits') }}
                    </x-primary-button>
                </a>
            </div>
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <p class="font-semibold">{{ __('ID') }}</p>
                        <p class="text-gray-800">{{ $user->id }}</p>
                    </div>

                    <div class="mb-4">
                        <p class="font-semibold">{{ __('Name') }}</p>
                        <p class="text-gray-800">{{ $user->name }}</p>
                    </div>

                    <div class="mb-4">
                        <p class="font-semibold">{{ __('Email') }}</p>
                        <p class="text-gray-800">{{ $user->email }}</p>
                    </div>

                    <div class="">
                        <p class="font-semibold">{{ __('Created At') }}</p>
                        <p class="text-gray-800">{{ \Carbon\Carbon::parse($user->created_at)->locale(app()->getLocale())->isoFormat("Do MMM YYYY, HH:mm,") }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
