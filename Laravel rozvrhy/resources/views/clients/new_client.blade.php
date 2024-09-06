<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nový záznam') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                   
                    <!-- Formulář jméno a adresa -->
                   
                   <form method="POST" action="{{ route('clients.store') }}">
                        @csrf
                        <!-- Jméno a příjmení -->
                        <div class="border-b border-gray-900/10 pb-12">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Osobní údaje</h2>
                            

                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-3">
                                    <label for="first_name" class="block text-sm font-medium leading-6 text-gray-900">Jméno</label>
                                    <div class="mt-2">
                                        <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required class="block w-96 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="last_name" class="block text-sm font-medium leading-6 text-gray-900">Příjmení</label>
                                    <div class="mt-2">
                                        <input type="text" name="last_name" id="last_name" autocomplete="family-name" value="{{ old('last_name') }}" required class="block w-96 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                            </div>

                            <div class="sm:col-span-3 mt-10" >
                                    <label for="note" class="block text-sm font-medium leading-6 text-gray-900">Poznámka - nepovinné</label>
                                    <div class="mt-2">
                                        <input type="text" name="note" id="note" autocomplete="given-name" value="{{ old('note') }}" class="block w-96 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                            </div>
                            <div class="sm:col-span-3 mt-10" >                  
                                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                                <x-input-error :messages="$errors->get('note')" class="mt-2" />
                            </div>
                            
                            <div class="mt-6 flex items-center justify-end gap-x-6">
                                    <a class="text-sm font-semibold leading-6 text-gray-800" href="{{ route('clients.create') }}">{{ __('Zrušit') }}</a>
            
                                    <x-primary-button class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ __('Uložit') }}</x-primary-button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
