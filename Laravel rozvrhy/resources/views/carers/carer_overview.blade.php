<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Seznam pečovatelek') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-gray-900">

                <ul role="list"">
                    @foreach ($carers as $carer)
                    <li>
                        <a href="{{ route('carers.edit', $carer) }}" class="text-lg font-semibold leading-6 text-gray-900"> {{$carer->first_name}} {{$carer->last_name}}  </a>
                    </li>
                    @endforeach
                </ul>                               
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

