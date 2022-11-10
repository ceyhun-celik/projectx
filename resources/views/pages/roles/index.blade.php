<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles') }}
        </h2>
    </x-slot>

    <div class="px-1 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="overflow-auto">
                    <table class="min-w-full text-center">
                        <thead class="border-b bg-gray-800">
                            <tr>
                                <th class="w-1 text-sm font-medium text-white px-6 py-4 whitespace-nowrap">#</th>
                                <th class="w-1 text-sm font-medium text-white px-6 py-4 whitespace-nowrap">{{ __('Role Name') }}</th>
                                <th class="w-1 text-sm font-medium text-white px-6 py-4 whitespace-nowrap">{{ __('Role Code') }}</th>
                                <th class="w-1 text-sm font-medium text-white px-6 py-4 whitespace-nowrap">{{ __('Created At') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $role)
                                <tr class="{{$loop->odd ? 'bg-white' : 'bg-gray-100'}}  border-b">
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $role->id }}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $role->role_name }}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $role->role_code }}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($role->created_at)->locale(app()->getLocale())->isoFormat("Do MMM YYYY, HH:mm") }}</td>
                                    <td></td>
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

            {{ $roles->render() }}
        </div>
    </div>
</x-app-layout>
