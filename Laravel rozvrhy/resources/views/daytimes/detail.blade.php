
@php
use Illuminate\Support\Carbon;
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Podrobný přehled') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

 
                <table class="">
                    <thead class="border-b border-gray-900/10">
                        <tr>
                        <th class="text-left">Jméno</th>
                        <th class="text-left">Den</th>
                        <th class="text-left">Čas od</th>
                        <th class="text-left">Čas do</th>
                        <th>Hodin</th>
                        </tr>
                    </thead>

                    <tbody>
                    @php $i = 5; $j=6; @endphp
                    @foreach ($daytimes as $daytime)  
                        
                        @if ($i % 5 == 0)
                        <tr>
                            <td class="w-64"><b><a href="{{ route('carers.edit', $daytime->carer) }}" class="hover:text-blue-800">{{$daytime->carer->first_name }}  {{$daytime->carer->last_name }}</a></b> </td>
                        </tr>    
                        @endif
                        <tr @if ($j % 5 == 0) class="border-b border-gray-900/10" @endif  >
                            <td></td>
                            <td class="w-32">{{$daytime->day }} </td>
                            <td class="w-24 text-left"> {{ Carbon::parse($daytime->from)->format('H:i') }}</td>
                            <td class="w-24 text-left"> {{ Carbon::parse($daytime->to)->format('H:i') }}</td>    
                            <td class="w-24 text-center"> {{$daytime->day_hours }}</td>    
                        </tr>
                        
                    @php $i++; $j++; @endphp
                    @endforeach

                    </tbody>
                </table>
                

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

