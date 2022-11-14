<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Management') }}
        </h2>
    </x-slot>

    <div class="px-1 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Roles -->
                    @can('admin_access')
                        <a href="{{ route('roles.index') }}" class="group block text-gray-600 group-hover:text-black">
                            <span class="mr-1">•</span>
                            <span class="group-hover:underline">{{ __('Roles') }}</span>
                        </a>
                    @endcan

                    <!-- Users -->
                    @can('admin_access')
                        <a href="{{ route('users.index') }}" class="group block mt-4 text-gray-600 group-hover:text-black">
                            <span class="mr-1">•</span>
                            <span class="group-hover:underline">{{ __('Users') }}</span>
                        </a>
                    @endcan

                    <!-- Authorizations -->
                    @can('admin_access')
                        <a href="{{ route('authorizations.index') }}" class="group block mt-4 text-gray-600 group-hover:text-black">
                            <span class="mr-1">•</span>
                            <span class="group-hover:underline">{{ __('Authorizations') }}</span>
                        </a>
                    @endcan

                    <!-- Audits -->
                    @can('root_access')
                        <a href="{{ route('audits.index') }}" class="group block mt-4 text-gray-600 group-hover:text-black">
                            <span class="mr-1">•</span>
                            <span class="group-hover:underline">{{ __('Audits') }}</span>
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
