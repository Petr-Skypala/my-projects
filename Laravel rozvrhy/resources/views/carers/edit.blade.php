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
                   
                   <form method="POST" action="{{ route('carers.update', $carer) }}">
                        @csrf
                        @method('patch')
                        <!-- Jméno a příjmení -->
                        <div class="mb-4 border-b border-gray-900/10 ">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Osobní údaje</h2>
                            

                            <div class="mt-10 grid grid-cols-2">
                                <div class="col-span">
                                    <label for="first_name" class="mt-3 block text-sm font-medium leading-6 text-gray-900">Jméno</label>
                                    <div class="mt-2">
                                        <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $carer->first_name) }}" required class="block w-96 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="col-span">
                                    <label for="last_name" class="mt-3 block text-sm font-medium leading-6 text-gray-900">Příjmení</label>
                                    <div class="mt-2">
                                        <input type="text" name="last_name" id="last_name" autocomplete="family-name" value="{{ old('last_name', $carer->last_name) }}" required class="block w-96 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                            
                                <div class="col-span mt-10" >
                                        <label for="weekly_hours" class="mt-3 block text-sm font-medium leading-6 text-gray-900">Týdenní úvazek</label>
                                        <div class="mt-2">
                                            <input type="number" name="weekly_hours" id="weekly_hours" autocomplete="given-name" value="{{ old('weekly_hours', $carer->weekly_hours) }}" required class="block w-96 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                </div>
                            </div>
                            
                            <div class="col-span mt-10" >                  
                                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                                <x-input-error :messages="$errors->get('weekly_hours')" class="mt-2" />
                            </div>
                            <div class="mt-6 mb-4 flex items-center gap-x-6">
                                    <a class="text-sm font-semibold leading-6 text-gray-800" href="{{ route('carers.index') }}">{{ __('Zrušit') }}</a>
            
                                    <x-primary-button class="ml-3 rounded-md bg-indigo-600 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ __('Uložit') }}</x-primary-button>
                            </div>
                        </div>
                    </form>
                    
                    <!-- Adresa -->
                  
                    <form method="POST" action="{{ route('addresses.store') }}">
                    @csrf

                        <div class="border-b border-gray-900/10">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Adresa</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">Zadejte adresu bydliště.</p>

                            <div class="mt-10 mb-4 grid grid-cols-2">
                                <div class="col-span">
                                    <label for="street" class="mt-3 block text-sm font-medium leading-6 text-gray-900">Ulice</label>
                                    <input type="text" name="street" id="street"  @if (isset($address)) value=" {{ $address->street }}" @endif required  class="block w-96 rounded border-0 py-1.5 text-gray-900 shadow ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                                </div>
                                <div class="col-span">
                                    <label for="house_number" class="mt-3 block text-sm font-medium leading-6 text-gray-900">Č. popisné</label>
                                    <input type="text" name="house_number" id="house_number" @if (isset($address)) value=" {{ $address->house_number }}" @endif required class="block w-96 rounded border-0 py-1.5 text-gray-900 shadow ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                                </div>
                                <div class="col-span">
                                    <label for="approx_number" class="mt-3 block text-sm font-medium leading-6 text-gray-900">Č. orientační</label>
                                    <input type="text" name="approx_number" id="approx_number" @if (isset($address)) value=" {{ $address->approx_number }}" @endif required class="block w-96 rounded border-0 py-1.5 text-gray-900 shadow ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                                </div>
                                <div class="col-span">
                                    <label for="city" class="mt-3 block text-sm font-medium leading-6 text-gray-900">Město</label>
                                    <input type="text" name="city" id="city" @if (isset($address)) value=" {{ $address->city }}" @endif required class="block w-96 rounded border-0 py-1.5 text-gray-900 shadow ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                                </div>
                                <input type="hidden" name="carer_id" value="{{ $carer->id }}">
                                <input type="hidden" name="form_name" value="carer">
                            </div>
                            <div>
                                <x-input-error :messages="$errors->get('street')" class="mt-2" />
                                <x-input-error :messages="$errors->get('house_number')" class="mt-2" />
                                <x-input-error :messages="$errors->get('approx_number')" class="mt-2" />
                                <x-input-error :messages="$errors->get('city')" class="mt-2" />
                            </div>
                            @if (!isset($address))
                            <div class="mt-6 mb-4 flex items-center">
                                    <a class="text-sm font-semibold leading-6 text-gray-800" href="{{ route('carers.index') }}">{{ __('Zrušit') }}</a>
            
                                    <x-primary-button class="ml-3 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ __('Uložit') }}</x-primary-button>
                            </div>
                            <!-- Zde přidat else pro tlačítko smazání adresy -->
                            @endif
                        </div>    

                    </form>
                    <!-- konec formuláře adresa -->

                    <!-- Rozdělení obrazovky na dva sloupce -->
                <div class="border-b border-gray-900/10 pb-12 pt-12">                     
                <div class="mt-10 grid grid-cols-2 gap-10">

                    <!-- Formulář pro pracovní dobu -->
                    <div class="mt-4 col-span-1 border-r border-gray-900/10">
                        <form method="POST"  action="{{ route('daytimes.store') }}"  >
                        @csrf
                        
                           
                                <h2 class="text-base font-semibold leading-7 text-gray-900">Pracovní doba</h2>
                                <p class="mt-1 mb-3 text-sm leading-6 text-gray-600">Zadejte pracovní dobu od - do a také denní úvazek v hodinách.</p>
                                
                                <table class="mt-4">
                                    <tr>
                                    <th style="width: 5em"><label for="street">Den</label></th>
                                    <th><label for="house_number" >Čas od</label></th>
                                    <th><label for="approx_number" >Čas do</label></th>
                                    <th><label for="city" >Denní úvazek</label></th>
                                    </tr>


                                @for ($i = 0; $i < 5; $i++)

                                    <tr>
                                        <td style="width: 5em"><span class="font-semibold mt-2 me-2 w-11 text-gray-900">{{ $days[$i] }}</span></td>
                                        <td><input type="time" name="daytimes[{{ $i }}][from]"  @if (isset($days_hours[$i])) value="{{  $days_hours[$i]->from }}" @endif required class="  w-32 border-gray-300 rounded shadow"></td>
                                        <td><input type="time" name="daytimes[{{ $i }}][to]"  @if (isset($days_hours[$i])) value="{{  $days_hours[$i]->to }}" @endif required class=" w-32 border-gray-300 rounded shadow"></td>
                                        <td><input type="number" name="daytimes[{{ $i }}][day_hours]" @if (isset($days_hours[$i]))  value="{{ old('daytimes.' . $i . '.day_hours', $days_hours[$i]->day_hours) }}" @endif required class="w-16 border-gray-300 rounded shadow"></td>
                                    </tr>

                                    <!-- Identifikace dne podle pole z kontroleru day_en -->
                                    <input type="hidden" name="daytimes[{{ $i }}][day]"  value="{{ $day_en[$i] }}" required class=" block w-24 border-gray-300 rounded-md shadow-sm">
                                    <!-- Identifikace pečovatelky podle id -->
                                    <input type="hidden" name="daytimes[{{ $i }}][carer_id]" value="{{ $carer->id }}">


                                @endfor
                                </table>     

                                @for ($i = 0; $i < 5; $i++)
                                <div>
                                    <x-input-error :messages="$errors->get('daytimes.' . $i . '.day')" class="mt-2" />
                                    <x-input-error :messages="$errors->get('daytimes.' . $i . '.from')" class="mt-2" />
                                    <x-input-error :messages="$errors->get('daytimes.' . $i . '.to')" class="mt-2" />
                                    <x-input-error :messages="$errors->get('daytimes.' . $i . '.day_hours')" class="mt-2" />
                                </div>
                                @endfor

                                

                                <div class="mt-4 mb-4 p-5 flex items-center">
                                        <a class=" text-sm font-semibold leading-6 text-gray-800" href="{{ route('carers.index') }}">{{ __('Zrušit') }}</a>
                                        <x-primary-button class="rounded bg-indigo-600 ml-3 mr-3 text-sm font-semibold text-white shadowm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-indigo-600">{{ __('Uložit') }}</x-primary-button>
                                </div>

                                

                        </form>
                    </div> <!-- Konec prvního sloupce -->

                    <!-- Druhý sloupec -->
                    <div class="mt-4 col-span-1"> 
                             
                            <form  method="POST"  action="{{ route('doctors.store') }}"  >   
                                @csrf

                                    <h2 class="text-base font-semibold leading-7 text-gray-900">Návštěva lékaře</h2>
                                    <p class="mt-1 text-sm leading-6 text-gray-600">Přehled plánovaných návštěv u lékaře.</p>

                                    <table class="mt-4 table-auto">
                                        <tr>
                                            <th><label for="day" >Den</label></th>
                                            <th><label for="from" ">Čas od</label></th>
                                            <th><label for="to" >Čas do</label></th>
                                        </tr>
                                        <tr>
                                        
                                            <td>
                                                <select id="day" name="day" class="block w-32 border-gray-300 rounded-md shadow-sm sm:max-w-xs sm:text-sm sm:leading-6">
                                                <option value="Mon">Pondělí</option>
                                                <option value="Tue">Úterý</option>
                                                <option value="Wed">Středa</option>
                                                <option value="Thu">Čtvrtek</option>
                                                <option value="Fri">Pátek</option>
                                                </select>
                                            </td>
                                            <td><input type="time" name="from" id="from" required class=" block w-32 border-gray-300 rounded-md shadow-sm"></td>
                                            <td><input type="time" name="to" id="to" required class=" block w-32 border-gray-300 rounded-md shadow-sm"></td>
                                        </tr>
                                    </table>        
                                        
                                        
                                            
                                        
                                        
                                            
                                        
                                        <!-- Identifikace pečovatelky podle id -->
                                        <input type="hidden" name="carer_id" value="{{ $carer->id }}">
                                
                                <div>
                                    <x-input-error :messages="$errors->get('to')" class="mt-2" />
                                </div>
                                <div class="mt-6 mr-5 flex items-center">
                                        <x-primary-button class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ __('Uložit') }}</x-primary-button>
                                </div>
                           
                            </form>

                        <table class="mt-4">
                                @foreach ($doctors as $doctor)
                                <tr>
                                    <td class="font-semibold text-gray-900" style="width: 5em">{{ $doctor->day }}</td>
                                    <td class="font-semibold leading-3 text-gray-900" style="width: 5em">{{ Carbon::parse($doctor->from)->format('H:i') }}</td>
                                    <td class="text-base font-semibold leading-3 text-gray-900" style="width: 5em">{{ Carbon::parse($doctor->to)->format('H:i') }}</td>
                                    <td>
                                    <x-dropdown>
                                    <x-slot name="trigger">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <form method="POST" action="{{ route('doctors.destroy', $doctor) }}">
                                            @csrf
                                            @method('delete')
                                            <x-dropdown-link :href="route('doctors.destroy', $doctor)" onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{ __('Smazat') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                    </x-dropdown>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                    </div> <!-- Konec druhého sloupce -->

                </div> <!-- Konec oddílu sloupců -->
                </div> <!-- Dolní okraj -->





                </div>
            </div>
        </div>
    </div>
</x-app-layout>
