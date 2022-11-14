<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Deleted User') }}
        </h2>
    </x-slot>

    <div class="px-1 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alert:Success -->
            <x-alert-success class="mb-4" />

            <div class="mb-4 flex justify-end">
                <!-- Button:Trash -->
                @can('root_access')                    
                    <a href="{{ route('users.trash') }}">
                        <x-primary-button>
                            {{ __('Trash') }}
                        </x-primary-button>
                    </a>
                @endcan
            </div>
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- ID -->
                    <div class="mb-4">
                        <p class="font-semibold">{{ __('ID') }}</p>
                        <p class="text-gray-800">{{ $user->id }}</p>
                    </div>

                    <!-- Name -->
                    <div class="mb-4">
                        <p class="font-semibold">{{ __('Name') }}</p>
                        <p class="text-gray-800">{{ $user->name }}</p>
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <p class="font-semibold">{{ __('Email') }}</p>
                        <p class="text-gray-800">{{ $user->email }}</p>
                    </div>

                    <!-- Created At -->
                    <div class="mb-4">
                        <p class="font-semibold">{{ __('Created At') }}</p>
                        <p class="text-gray-800">{{ \Carbon\Carbon::parse($user->created_at)->locale(app()->getLocale())->isoFormat("Do MMM YYYY, HH:mm") }}</p>
                    </div>

                    <!-- Deleted At -->
                    <div class="">
                        <p class="font-semibold">{{ __('Deleted At') }}</p>
                        <p class="text-gray-800">{{ \Carbon\Carbon::parse($user->deleted_at)->locale(app()->getLocale())->isoFormat("Do MMM YYYY, HH:mm") }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
