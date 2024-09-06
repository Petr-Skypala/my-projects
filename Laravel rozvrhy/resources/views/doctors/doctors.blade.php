
@php
use Illuminate\Support\Carbon;
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Návštěvy u lékaře') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 mb-7">

 
                <table class="">

                    <tr>
                        <th class="text-left">Jméno</th>
                        <th class="text-left">Den</th>
                        <th class="text-left">Čas od</th>
                        <th class="text-left">Čas do</th>
                    </tr>
                    
                    @foreach ($doctors as $doctor)                   
                        <tr class="border-b border-gray-900/10 h-10 py-10"  >
                            <td style="width: 10em"><b><a href="{{ route('carers.edit', $doctor->carer) }}" class="hover:text-blue-800">{{$doctor->carer->first_name }}  {{$doctor->carer->last_name }}</a></b> </td>
                            <td style="width: 5em">{{$doctor->day }} </td>
                            <td style="width: 4em"> {{ Carbon::parse($doctor->from)->format('H:i') }}</td>
                            <td style="width: 4em"> {{ Carbon::parse($doctor->to)->format('H:i') }}</td>    
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
                                            <input name="info" type="hidden" value="info">
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
               

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

