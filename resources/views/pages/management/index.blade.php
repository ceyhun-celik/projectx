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
                    @can('root')
                        <a href="{{ route('roles.index') }}" class="block group mb-4">
                            <p class="text-gray-600 group-hover:text-black duration-200">• <span class="group-hover:underline">{{ __('Roles') }}</span></p>
                            <p class="text-sm text-gray-500 group-hover:text-gray-800 duration-200">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nulla, assumenda nostrum. Minus quaerat ex accusantium doloremque laudantium totam, vero nobis provident ipsa libero illum non, aut, commodi ullam? Sapiente, labore?</p>
                        </a>
                    @endcan

                    <!-- Users -->
                    @can('root')
                        <a href="{{ route('users.index') }}" class="block group mb-4">
                            <p class="text-gray-600 group-hover:text-black duration-200">• <span class="group-hover:underline">{{ __('Users') }}</span></p>
                            <p class="text-sm text-gray-500 group-hover:text-gray-800 duration-200">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nulla, assumenda nostrum. Minus quaerat ex accusantium doloremque laudantium totam, vero nobis provident ipsa libero illum non, aut, commodi ullam? Sapiente, labore?</p>
                        </a>
                    @endcan

                    <!-- Authorizations -->
                    @can('root')
                        <a href="{{ route('authorizations.index') }}" class="block group mb-4">
                            <p class="text-gray-600 group-hover:text-black duration-200">• <span class="group-hover:underline">{{ __('Authorizations') }}</span></p>
                            <p class="text-sm text-gray-500 group-hover:text-gray-800 duration-200">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nulla, assumenda nostrum. Minus quaerat ex accusantium doloremque laudantium totam, vero nobis provident ipsa libero illum non, aut, commodi ullam? Sapiente, labore?</p>
                        </a>
                    @endcan

                    @can('root')
                        <a href="{{ route('audits.index') }}" class="block group">
                            <p class="text-gray-600 group-hover:text-black duration-200">• <span class="group-hover:underline">{{ __('Audits') }}</span></p>
                            <p class="text-sm text-gray-500 group-hover:text-gray-800 duration-200">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nulla, assumenda nostrum. Minus quaerat ex accusantium doloremque laudantium totam, vero nobis provident ipsa libero illum non, aut, commodi ullam? Sapiente, labore?</p>
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
