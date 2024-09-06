
<div class="min-h-full">
  <nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
     
        <!-- Hlavní navigační menu - normální obrazovka -->
        <div class="ml-10 flex h-12 items-center justify-between text-white">

        <?php $current_page = basename($_SERVER['REQUEST_URI'], ".php"); ?>

            <div class="flex">
                <a href="{{ route('uvod') }}" @if ($current_page === 'uvod' ) class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white"
                      @else class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white"
                      @endif >Úvod</a>

                <!-- Dropdown menu pečovatelky -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>Pečovatelky</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('carers.index')">
                            {{ __('Seznam') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('daytimes.index')">
                            {{ __('Podrobný přehled') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('doctors.index')">
                            {{ __('Návštěvy u lékaře') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('carers.create')">
                            {{ __('Nový záznam') }}
                        </x-dropdown-link>


                    </x-slot>
                </x-dropdown>

                <!-- Dropdown menu klienti -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>Klienti</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('clients.index')">
                            {{ __('Seznam') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('clients.create')">
                            {{ __('Nový záznam') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            </div>
            <div>
                <!-- Dropdown Uživatel -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
  </nav>
</div>
