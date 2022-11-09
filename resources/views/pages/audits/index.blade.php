<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Audits') }}
        </h2>
    </x-slot>

    <div class="px-1 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-input-success class="mb-4" />

            <form action="{{ route('audits.index') }}" method="GET" class="flex justify-end mb-4">
                <div class="flex items-center">
                    <x-text-input id="email" class="block" type="text" name="search" :value="request()->get('search')" placeholder="Search.." />
                </div>
            </form>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="overflow-auto">
                    <table class="min-w-full text-center">
                        <thead class="border-b bg-gray-800">
                            <tr>
                                <th class="w-1 text-sm font-medium text-white px-6 py-4 whitespace-nowrap">#</th>
                                <th class="w-1 text-sm font-medium text-white px-6 py-4 whitespace-nowrap">{{ __('Name') }}</th>
                                <th class="w-1 text-sm font-medium text-white px-6 py-4 whitespace-nowrap">{{ __('Event') }}</th>
                                <th class="w-1 text-sm font-medium text-white px-6 py-4 whitespace-nowrap">{{ __('Auditable Type') }}</th>
                                <th class="w-1 text-sm font-medium text-white px-6 py-4 whitespace-nowrap">{{ __('Auditable ID') }}</th>
                                <th class="w-1 text-sm font-medium text-white px-6 py-4 whitespace-nowrap">{{ __('IP Address') }}</th>
                                <th class="w-1 text-sm font-medium text-white px-6 py-4 whitespace-nowrap">{{ __('Created At') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($audits as $audit)
                                <tr class="{{$loop->odd ? 'bg-white' : 'bg-gray-100'}}  border-b">
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $audit->id }}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $audit->user?->name }}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ ucfirst($audit->event) }}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $audit->auditable_type }}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $audit->auditable_id }}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $audit->ip_address }}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($audit->created_at)->locale(app()->getLocale())->isoFormat("Do MMM YYYY, HH:mm,") }}</td>
                                    <td>
                                        <div class="flex items-center">
                                            <a href="{{ route('audits.show', $audit->id) }}">
                                                <x-primary-button class="ml-3">
                                                    {{ __('Show') }}
                                                </x-primary-button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            <tr class="bg-white border-b">
                                <td colspan="8" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">No record found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{ $audits->render() }}
        </div>
    </div>
</x-app-layout>
