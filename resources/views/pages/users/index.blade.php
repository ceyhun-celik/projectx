<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="px-1 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success class="mb-4" />

            <div class="flex items-center justify-end gap-3 mb-4">
                <form action="{{ route('users.index') }}" method="GET" class="flex justify-end">
                    <div class="flex items-center">
                        <x-text-input id="email" class="block" type="text" name="search" :value="request()->get('search')" placeholder="Search.." />
                    </div>
                </form>

                <span>|</span>
    
                <a href="{{ route('users.create') }}">
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
                                <th class="w-1 text-sm font-medium text-white px-6 py-4 whitespace-nowrap">{{ __('Email') }}</th>
                                <th class="w-1 text-sm font-medium text-white px-6 py-4 whitespace-nowrap">{{ __('Created At') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="{{$loop->odd ? 'bg-white' : 'bg-gray-100'}}  border-b">
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $user->id }}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($user->created_at)->locale(app()->getLocale())->isoFormat("Do MMM YYYY, HH:mm,") }}</td>
                                    <td>
                                        <div class="flex items-center">
                                            <a href="{{ route('users.show', $user->id) }}">
                                                <x-primary-button class="ml-3">
                                                    {{ __('Show') }}
                                                </x-primary-button>
                                            </a>

                                            <a href="{{ route('users.edit', $user->id) }}">
                                                <x-primary-button class="ml-3">
                                                    {{ __('Edit') }}
                                                </x-primary-button>
                                            </a>

                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?')"> @csrf @method('DELETE')
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

            {{ $users->render() }}
        </div>
    </div>
</x-app-layout>
