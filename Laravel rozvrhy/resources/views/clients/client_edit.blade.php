@php
use Illuminate\Support\Carbon;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Změnit údaje') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                   
                    <!-- Formulář jméno a adresa -->
                   
                   <form method="POST" action="{{ route('clients.update', $client) }}">
                        @csrf
                        @method('patch')
                        <!-- Jméno a příjmení -->
                        <div class="border-b border-gray-900/10 pb-12">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Osobní údaje</h2>
                            

                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-3">
                                    <label for="first_name" class="block text-sm font-medium leading-6 text-gray-900">Jméno</label>
                                    <div class="mt-2">
                                        <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $client->first_name) }}" required class="block w-96 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="last_name" class="block text-sm font-medium leading-6 text-gray-900">Příjmení</label>
                                    <div class="mt-2">
                                        <input type="text" name="last_name" id="last_name" autocomplete="family-name" value="{{ old('last_name', $client->last_name) }}" required class="block w-96 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                            </div>

                            <div class="sm:col-span-3 mt-10" >
                                    <label for="note" class="block text-sm font-medium leading-6 text-gray-900">Poznámka - nepovinné</label>
                                    <div class="mt-2">
                                        <input type="text" name="note" id="note" autocomplete="given-name" value="{{ old('note', $client->note) }}" class="block w-96 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                            </div>
                            <div class="sm:col-span-3 mt-10" >                  
                                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                                <x-input-error :messages="$errors->get('note')" class="mt-2" />
                            </div>
                            <div class="mt-6 flex items-center justify-end gap-x-6">
                                    <a class="text-sm font-semibold leading-6 text-gray-800" href="{{ route('clients.index') }}">{{ __('Zrušit') }}</a>
            
                                    <x-primary-button class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ __('Uložit') }}</x-primary-button>
                            </div>
                        </div>
                    </form>
                    
                    <!-- Adresa -->
                  
                    <form method="POST" action="{{ route('addresses.store') }}">
                    @csrf
                    
                    


                        <div class="border-b border-gray-900/10 pb-12 pt-12">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Adresa</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">Zadejte adresu bydliště.</p>

                            <div class="mt-10 flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0">
                                    <div class="col-span-1 sm:col-span-2">
                                        <label for="street" class="block w-72 text-sm font-medium text-gray-700">Ulice</label>
                                        <input type="text" name="street" id="street"  @if (isset($address)) value=" {{ $address->street }}" @endif required  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    </div>
                                    <div class="col-span-1 sm:col-span-1">
                                        <label for="house_number" class="block w-24 text-sm font-medium text-gray-700">Č. popisné</label>
                                        <input type="text" name="house_number" id="house_number" @if (isset($address)) value=" {{ $address->house_number }}" @endif required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    </div>
                                    <div class="col-span-1 sm:col-span-1">
                                        <label for="approx_number" class="block w-24 text-sm font-medium text-gray-700">Č. orientační</label>
                                        <input type="text" name="approx_number" id="approx_number" @if (isset($address)) value=" {{ $address->approx_number }}" @endif required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    </div>
                                    <div class="col-span-1 sm:col-span-1">
                                        <label for="city" class="block w-72 text-sm font-medium text-gray-700">Město</label>
                                        <input type="text" name="city" id="city" @if (isset($address)) value=" {{ $address->city }}" @endif required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    </div>
                                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                                    <input type="hidden" name="form_name" value="client">
                            </div>
                            <div>
                                <x-input-error :messages="$errors->get('street')" class="mt-2" />
                                <x-input-error :messages="$errors->get('house_number')" class="mt-2" />
                                <x-input-error :messages="$errors->get('approx_number')" class="mt-2" />
                                <x-input-error :messages="$errors->get('city')" class="mt-2" />
                            </div>
                            @if (!isset($address))
                            <div class="mt-6 flex items-center justify-end gap-x-6">
                                    <a class="text-sm font-semibold leading-6 text-gray-800" href="{{ route('clients.index') }}">{{ __('Zrušit') }}</a>
            
                                    <x-primary-button class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ __('Uložit') }}</x-primary-button>
                            </div>
                            <!-- Zde přidat else pro tlačítko smazání adresy -->
                            @endif
                        </div>    
                        

                    </form>
                    <!-- konec formuláře adresa -->


                </div>
            </div>
        </div>
    </div>
</x-app-layout>

