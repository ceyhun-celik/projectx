<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Audit') }}
        </h2>
    </x-slot>

    <div class="px-1 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 flex justify-end">
                <!-- Button:List -->
                @can('root_access')
                    <a href="{{ route('audits.index') }}">
                        <x-primary-button>
                            {{ __('List') }}
                        </x-primary-button>
                    </a>
                @endcan
            </div>
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- ID -->
                    <div class="mb-4">
                        <p class="font-semibold">{{ __('ID') }}</p>
                        <p class="text-gray-800">{{ $audit->id }}</p>
                    </div>

                    <!-- Name -->
                    <div class="mb-4">
                        <p class="font-semibold">{{ __('Name') }}</p>
                        <p class="text-gray-800">{{ $audit->user->name }}</p>
                    </div>

                    <!-- Event -->
                    <div class="mb-4">
                        <p class="font-semibold">{{ __('Event') }}</p>
                        <p class="text-gray-800">{{ __($audit->event) }}</p>
                    </div>

                    <!-- Auditable Type -->
                    <div class="mb-4">
                        <p class="font-semibold">{{ __('Auditable Type') }}</p>
                        <p class="text-gray-800">{{ $audit->auditable_type }}</p>
                    </div>

                    <!-- Auditable ID -->
                    <div class="mb-4">
                        <p class="font-semibold">{{ __('Auditable ID') }}</p>
                        <p class="text-gray-800">{{ $audit->auditable_id }}</p>
                    </div>

                    <!-- IP Address -->
                    <div class="mb-4">
                        <p class="font-semibold">{{ __('IP Address') }}</p>
                        <p class="text-gray-800">{{ $audit->ip_address }}</p>
                    </div>

                    <!-- Created At -->
                    <div class="mb-4">
                        <p class="font-semibold">{{ __('Created At') }}</p>
                        <p class="text-gray-800">{{ \Carbon\Carbon::parse($audit->created_at)->locale(app()->getLocale())->isoFormat("Do MMM YYYY, HH:mm") }}</p>
                    </div>

                    <!-- Old Values -->
                    @if($audit->old_values != '[]')
                        <div class="mb-4">
                            <p class="font-semibold">{{ __('Old Values') }}</p>
                            @dump(json_decode($audit->old_values, true))
                        </div>
                    @endif

                    <!-- New Values -->
                    @if($audit->new_values != '[]')
                        <div class="mb-4">
                            <p class="font-semibold">{{ __('New Values') }}</p>
                            @dump(json_decode($audit->new_values, true))
                        </div>
                    @endif

                    <!-- User Agent -->
                    <div class="">
                        <p class="font-semibold">{{ __('User Agent') }}</p>
                        <p class="text-gray-800">{{ $audit->user_agent }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
