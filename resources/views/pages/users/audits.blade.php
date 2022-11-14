<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Audits') }}
        </h2>
    </x-slot>

    <div class="px-1 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-end gap-3 mb-4">
                <!-- Search -->
                <form action="{{ route('users.audits', $id) }}" method="GET" class="flex justify-end">
                    <div class="flex items-center">
                        <x-text-input id="email" class="block" type="text" name="search" :value="request()->get('search')" placeholder="Name.." />
                    </div>
                </form>

                <span>|</span>
    
                <!-- Button:Back -->
                @can('root_access')                    
                    <a href="{{ route('users.show', $id) }}">
                        <x-primary-button>
                            {{ __('Back') }}
                        </x-primary-button>
                    </a>
                @endcan
            </div>

            @forelse ($audits as $audit)                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <!-- Date -->
                        <div class="flex">
                            <p class="mr-1 font-semibold">{{ __('Date') }}:</p>
                            <p class="text-gray-800">{{ \Carbon\Carbon::parse($audit->created_at)->locale(app()->getLocale())->isoFormat("Do MMM YYYY, HH:mm") }}</p>
                        </div>
                       
                        <!-- Name -->
                        <div class="flex mt-1">
                            <p class="mr-1 font-semibold">{{ __('Name') }}:</p>
                            <p class="text-gray-800">{{ $audit->user->name }}</p>
                        </div>

                        <!-- Event -->
                        <div class="flex mt-1">
                            <p class="mr-1 font-semibold">{{ __('Event') }}:</p>
                            <p class="text-gray-800">{{ ucfirst($audit->event) }}</p>
                        </div>

                        <!-- Modify -->
                        @if ($audit->event == 'updated')
                            <div class="mt-4">
                                <p class="font-semibold">{{ __('Modify') }}</p>
                                @foreach ($audit->decodeOldValues() as $key => $value)
                                    <p class="text-gray-800">
                                        <span class="mr-1 font-semibold">• [{{ __($key) }}]</span>
                                        <span>{{ $audit->decodeOldValues()[$key] }}</span>
                                        <span class="mx-1">~</span>
                                        <span>{{ $audit->decodeNewValues()[$key] }}</span>
                                    </p>
                                @endforeach
                            </div>
                        @endif

                        <!-- IP Address -->
                        <div class="flex mt-4">
                            <p class="mr-1 font-semibold">{{ __('IP Address') }}:</p>
                            <p class="text-gray-800">{{ $audit->ip_address }}</p>
                        </div>

                        <!-- User Agent -->
                        <div class="flex">
                            <p class="mr-1 font-semibold">{{ __('User Agent') }}:</p>
                            <p class="text-gray-800">{{ $audit->user_agent }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <p>{{ __('No record found') }}</p>
                    </div>
                </div>
            @endforelse

            {{ $audits->render() }}
        </div>
    </div>
</x-app-layout>
