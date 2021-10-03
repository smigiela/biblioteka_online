<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img style="height: 8vh"
                             src="https://i.ibb.co/FsmWnWM/kisspng-vector-graphics-book-stock-illustration-logo-research-vector-book-transparent-amp-png-clipar.png">
                    </a>
                </div>

                <!-- Navigation Links -->

                @if(\Illuminate\Support\Facades\Auth::user()->hasRole(['user', 'admin']))
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('dashboard.catalogOfBooks')"
                                    :active="request()->routeIs('dashboard.catalogOfBooks')">
                            {{ __('Katalog') }}
                        </x-nav-link>
                    </div>
                @endif

                @if(\Illuminate\Support\Facades\Auth::user()->hasRole(['user', 'admin']))
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('cart')"
                                    :active="request()->routeIs('cart')">
                            {{ __('Koszyk') }}
                        </x-nav-link>
                    </div>
                @endif

                @if(\Illuminate\Support\Facades\Auth::user()->hasRole(['user', 'admin']))
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('order')"
                                    :active="request()->routeIs('order')">
                            {{ __('Zamówienia') }}
                        </x-nav-link>
                    </div>
                @endif

                @if(\Illuminate\Support\Facades\Auth::user()->hasRole(['admin']))
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('dashboard.adminPanel')"
                                    :active="request()->routeIs('dashboard.adminPanel')">
                            {{ __('Panel Administratora') }}
                        </x-nav-link>
                    </div>
                @endif
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        @if(\Illuminate\Support\Facades\Auth::user()->hasRole(['admin']))
                        <form method="GET" action="{{ route('dashboard.adminPanel') }}">
                            @csrf

                            <x-dropdown-link :href="route('dashboard.adminPanel')"
                                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Panel Administratora') }}
                            </x-dropdown-link>
                        </form>
                        @endif

                        <form method="GET" action="{{ route('dashboard') }}">
                            @csrf

                            <x-dropdown-link :href="route('dashboard')"
                                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Konto') }}
                            </x-dropdown-link>
                        </form>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Wyloguj') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>


                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        @if(\Illuminate\Support\Facades\Auth::user()->hasRole(['user', 'admin']))
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('dashboard.catalogOfBooks')" :active="request()->routeIs('dashboard.catalogOfBooks')">
                    {{ __('Katalog') }}
                </x-responsive-nav-link>
            </div>
        @endif

        @if(\Illuminate\Support\Facades\Auth::user()->hasRole(['user', 'admin']))
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('cart')" :active="request()->routeIs('cart')">
                    {{ __('Koszyk') }}
                </x-responsive-nav-link>
            </div>
        @endif

        @if(\Illuminate\Support\Facades\Auth::user()->hasRole(['user', 'admin']))
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('order')" :active="request()->routeIs('order')">
                    {{ __('Zamówienia') }}
                </x-responsive-nav-link>
            </div>
        @endif

        @if(\Illuminate\Support\Facades\Auth::user()->hasRole(['admin']))
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('dashboard.adminPanel')" :active="request()->routeIs('dashboard.adminPanel')">
                    {{ __('Panel Administratora') }}
                </x-responsive-nav-link>
            </div>
        @endif

    <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                                           onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
