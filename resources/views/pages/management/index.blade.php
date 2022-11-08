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
                    <a href="{{ route('users.index') }}" class="block group mb-4">
                        <p class="text-gray-600 group-hover:text-black duration-200">• <span class="group-hover:underline">Users</span></p>
                        <p class="text-sm text-gray-500 group-hover:text-gray-800 duration-200">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nulla, assumenda nostrum. Minus quaerat ex accusantium doloremque laudantium totam, vero nobis provident ipsa libero illum non, aut, commodi ullam? Sapiente, labore?</p>
                    </a>

                    <a href="{{ route('authorizations.index') }}" class="block group mb-4">
                        <p class="text-gray-600 group-hover:text-black duration-200">• <span class="group-hover:underline">Authorizations</span></p>
                        <p class="text-sm text-gray-500 group-hover:text-gray-800 duration-200">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nulla, assumenda nostrum. Minus quaerat ex accusantium doloremque laudantium totam, vero nobis provident ipsa libero illum non, aut, commodi ullam? Sapiente, labore?</p>
                    </a>

                    <a href="{{ route('audits.index') }}" class="block group">
                        <p class="text-gray-600 group-hover:text-black duration-200">• <span class="group-hover:underline">Audits</span></p>
                        <p class="text-sm text-gray-500 group-hover:text-gray-800 duration-200">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nulla, assumenda nostrum. Minus quaerat ex accusantium doloremque laudantium totam, vero nobis provident ipsa libero illum non, aut, commodi ullam? Sapiente, labore?</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
