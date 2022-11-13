<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Deleted Authorization') }}
        </h2>
    </x-slot>

    <div class="px-1 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alert:Success -->
            <x-alert-success class="mb-4" />

            <div class="mb-4 flex justify-end">
                <!-- Button:Trash -->
                <a href="{{ route('authorizations.trash') }}">
                    <x-primary-button>
                        {{ __('Trash') }}
                    </x-primary-button>
                </a>
            </div>
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- ID -->
                    <div class="mb-4">
                        <p class="font-semibold">{{ __('ID') }}</p>
                        <p class="text-gray-800">{{ $authorization->id }}</p>
                    </div>
                    
                    <!-- Name -->
                    <div class="mb-4">
                        <p class="font-semibold">{{ __('Name') }}</p>
                        <p class="text-gray-800">{{ $authorization->user->name }}</p>
                    </div>

                    <!-- Role Name -->
                    <div class="mb-4">
                        <p class="font-semibold">{{ __('Role Name') }}</p>
                        <p class="text-gray-800">{{ __($authorization->role->role_name) }}</p>
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <p class="font-semibold">{{ __('Status') }}</p>
                        <p class="text-gray-800">{{ __($authorization->status) }}</p>
                    </div>

                    <!-- Languages -->
                    <div class="mb-4">
                        <p class="font-semibold">{{ __('Language') }}</p>
                        <p class="text-gray-800">{{ __($authorization->language) }}</p>
                    </div>

                    <!-- Created At -->
                    <div class="mb-4">
                        <p class="font-semibold">{{ __('Created At') }}</p>
                        <p class="text-gray-800">{{ \Carbon\Carbon::parse($authorization->created_at)->locale(app()->getLocale())->isoFormat("Do MMM YYYY, HH:mm") }}</p>
                    </div>

                    <!-- Deleted At -->
                    <div class="">
                        <p class="font-semibold">{{ __('Deleted At') }}</p>
                        <p class="text-gray-800">{{ \Carbon\Carbon::parse($authorization->deleted_at)->locale(app()->getLocale())->isoFormat("Do MMM YYYY, HH:mm") }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
