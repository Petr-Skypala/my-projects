<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pečovatelky') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                   
                    <!-- Formulář jméno a adresa -->
                   <form>
                        <!-- Jméno a příjmení -->
                        <div class="border-b border-gray-900/10 pb-12">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Osobní údaje</h2>
                            

                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-3">
                                    <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Jméno</label>
                                    <div class="mt-2">
                                        <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="block w-96 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Příjmení</label>
                                    <div class="mt-2">
                                        <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="block w-96 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                            </div>

                            <div class="sm:col-span-3 mt-10" >
                                    <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Týdenní úvazek</label>
                                    <div class="mt-2">
                                        <input type="number" name="first-name" id="first-name" autocomplete="given-name" class="block w-96 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                            </div>
                        
                        
                            <div class="mt-6 flex items-center justify-end gap-x-6">
                                    <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                            </div>
                        </div>
                    
                    
                    <!-- Adresa -->
                    <div class="border-b border-gray-900/10 pb-12 pt-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Adresa</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">Zadejte adresu bydliště.</p>

                        <div class="mt-10 flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0">
                                <div class="col-span-1 sm:col-span-2">
                                    <label for="address" class="block w-72 text-sm font-medium text-gray-700">Ulice</label>
                                    <input type="text" id="address" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                </div>
                                <div class="col-span-1 sm:col-span-1">
                                    <label for="city" class="block w-24 text-sm font-medium text-gray-700">Č. popisné</label>
                                    <input type="text" id="city" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                </div>
                                <div class="col-span-1 sm:col-span-1">
                                    <label for="state" class="block w-24 text-sm font-medium text-gray-700">Č. orientační</label>
                                    <input type="text" id="state" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                </div>
                                <div class="col-span-1 sm:col-span-1">
                                    <label for="zip" class="block w-72 text-sm font-medium text-gray-700">Město</label>
                                    <input type="text" id="zip" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                </div>
                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                        </div>
                    </div>    



                    </form>
                    <!-- konec formuláře jméno a adresa -->

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
