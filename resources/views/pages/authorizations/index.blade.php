<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Authorizations') }}
        </h2>
    </x-slot>

    <div class="px-1 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alert:Success -->
            <x-alert-success class="mb-4" />

            <div class="flex items-center justify-end gap-3 mb-4">
                <!-- Search -->
                <form action="{{ route('authorizations.index') }}" method="GET" class="flex justify-end">
                    <div class="flex items-center">
                        <x-text-input id="email" class="block" type="text" name="search" :value="request()->get('search')" placeholder="{{ __('Search') }}.." />
                    </div>
                </form>

                <span>|</span>
    
                <!-- Button:Create -->
                <a href="{{ route('authorizations.create') }}">
                    <x-primary-button>
                        {{ __('Create') }}
                    </x-primary-button>
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="overflow-auto">
                    <table class="min-w-full text-center">
                        <thead class="border-b bg-gray-800">
                            <tr>
                                <th class="w-1 text-sm font-medium text-white px-6 py-4 whitespace-nowrap">#</th>
                                <th class="w-1 text-sm font-medium text-white px-6 py-4 whitespace-nowrap">{{ __('Name') }}</th>
                                <th class="w-1 text-sm font-medium text-white px-6 py-4 whitespace-nowrap">{{ __('Role Name') }}</th>
                                <th class="w-1 text-sm font-medium text-white px-6 py-4 whitespace-nowrap">{{ __('Status') }}</th>
                                <th class="w-1 text-sm font-medium text-white px-6 py-4 whitespace-nowrap">{{ __('Language') }}</th>
                                <th class="w-1 text-sm font-medium text-white px-6 py-4 whitespace-nowrap">{{ __('Created At') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($authorizations as $authorization)
                                <tr class="{{$loop->odd ? 'bg-white' : 'bg-gray-100'}}  border-b">
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $authorization->id }}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $authorization->user->name }}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $authorization->role->role_name }}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ ucfirst($authorization->status) }}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ strtoupper($authorization->language) }}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($authorization->created_at)->locale(app()->getLocale())->isoFormat("Do MMM YYYY, HH:mm") }}</td>
                                    <td>
                                        <div class="flex items-center">
                                            <!-- Button:Show -->
                                            <a href="{{ route('authorizations.show', $authorization->id) }}">
                                                <x-primary-button class="ml-3">
                                                    {{ __('Show') }}
                                                </x-primary-button>
                                            </a>

                                            <!-- Button:Edit -->
                                            <a href="{{ route('authorizations.edit', $authorization->id) }}">
                                                <x-primary-button class="ml-3">
                                                    {{ __('Edit') }}
                                                </x-primary-button>
                                            </a>

                                            <!-- Button:Delete -->
                                            <form action="{{ route('authorizations.destroy', $authorization->id) }}" method="POST" onsubmit="return confirm('Are you sure?')"> @csrf @method('DELETE')
                                                <x-primary-button class="ml-3">
                                                    {{ __('Delete') }}
                                                </x-primary-button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            <tr class="bg-white border-b">
                                <td colspan="5" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ __('No record found') }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{ $authorizations->render() }}
        </div>
    </div>
</x-app-layout>
