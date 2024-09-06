<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Seznam klientů') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                <ul role="list" class="divide-y divide-gray-100">
    @foreach ($clients as $client)
    <li class="flex justify-between gap-x-6 py-5">
    <div class="flex min-w-0 gap-x-4">
      <div class="min-w-0 flex-auto">
        <p class="text-lg font-semibold leading-6 text-gray-900"> {{$client->first_name}} {{$client->last_name}}   </p>
      </div>
    </div>
    <div class="sm:flex sm:flex-col sm:items-end">
      <p class="text-sm leading-6 text-gray-900">

        <a href="{{ route('clients.edit', $client) }}">
            <button class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Upravit
            </button>
        </a>  

      </p>    
    </div>
  </li>
  @endforeach
  </ul>                               
                                


                </div>
            </div>
        </div>
    </div>
</x-app-layout>

