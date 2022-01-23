<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-jet-application-mark class="block h-10 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @hasrole('Verified')
{{--                    <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">--}}
{{--                        {{ __('Dashboard') }}--}}
{{--                    </x-jet-nav-link>--}}
                        @hasanyrole('Grocer|Administrator|Super-Admin')
                            <x-jet-nav-link href="{{ route('purchases.index') }}" :active="request()->routeIs('purchases.index')">
                                {{ __('Purchases') }}
                            </x-jet-nav-link>
                        @hasanyrole('Administrator|Super-Admin')
                            <x-jet-nav-link href="{{ route('control.markets.inventories') }}" :active="request()->routeIs('control.markets.inventories')">
                                {{ __('Inventories') }}
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('control.markets.settlements') }}" :active="request()->routeIs('control.markets.settlements')">
                                {{ __('Settlements') }}
                            </x-jet-nav-link>
                        @endhasanyrole
                            <x-jet-nav-link href="{{ route('warehouse.shipments') }}" :active="request()->routeIs('warehouse.shipments')">
                                {{ __('Shipments') }}
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('monitor.sales') }}" :active="request()->routeIs('monitor.sales')">
                                {{ __('Sales') }}
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('monitor.inventories') }}" :active="request()->routeIs('monitor.inventories')">
                                {{ __('Inventories') }}
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('monitor.orders') }}" :active="request()->routeIs('monitor.orders')">
                                {{ __('Orders') }}
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('monitor.expired') }}" :active="request()->routeIs('monitor.expired')">
                                {{ __('Expired') }}
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('warehouse.requirements') }}" :active="request()->routeIs('warehouse.requirements')">
                                {{ __('Requirements') }}
                            </x-jet-nav-link>
                        @endhasanyrole
                        @hasanyrole('Seller|Manager')
                            <x-jet-nav-link href="{{ route('market.index') }}" :active="request()->routeIs('market.index')">
                                {{ __('Market') }}
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('market.sales') }}" :active="request()->routeIs('market.sales')">
                                {{ __('Sales') }}
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('market.inventory') }}" :active="request()->routeIs('market.inventory')">
                                {{ __('Inventory') }}
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('market.orders') }}" :active="request()->routeIs('market.orders')">
                                {{ __('Orders') }}
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('market.expired') }}" :active="request()->routeIs('market.expired')">
                                {{ __('Expired') }}
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('market.requests') }}" :active="request()->routeIs('market.requests')">
                                {{ __('Requests') }}
                            </x-jet-nav-link>
                        @endhasanyrole
                    @endhasrole
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ml-3 relative">
                        <x-jet-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-jet-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-jet-dropdown-link>
                                    @endcan

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Team Switcher -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Switch Teams') }}
                                    </div>

                                    @foreach (Auth::user()->allTeams() as $team)
                                        <x-jet-switchable-team :team="$team" />
                                    @endforeach
                                </div>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
{{--                                                                        <span class="bg-gray-500 inline-flex items-center">--}}
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->username }}" />
                                @endif

                                <span class="px-2 font-bold inline-flex items-center">
                                        {{ Auth::user()->first_name }}
                                    <br/>
                                        {{ Auth::user()->roles()->pluck('name')[0] == 'Verified' ? Auth::user()->roles()->pluck('name')[1] : Auth::user()->roles()->pluck('name')[0] }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                </span>
{{--                                                                    </span>--}}
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-jet-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-jet-responsive-nav-link>
            @hasrole('Verified')
                @hasanyrole('Grocer|Administrator|Super-Admin')
                <x-jet-responsive-nav-link href="{{ route('purchases.index') }}" :active="request()->routeIs('purchases.index')">
                    {{ __('Purchases') }}
                </x-jet-responsive-nav-link>
                    @hasanyrole('Administrator|Super-Admin')
                    <x-jet-responsive-nav-link href="{{ route('control.markets.inventories') }}" :active="request()->routeIs('control.markets.inventories')">
                        {{ __('Inventories') }}
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('control.markets.settlements') }}" :active="request()->routeIs('control.markets.settlements')">
                        {{ __('Settlements') }}
                    </x-jet-responsive-nav-link>
                    @endhasanyrole
                <x-jet-responsive-nav-link href="{{ route('warehouse.shipments') }}" :active="request()->routeIs('warehouse.shipments')">
                    {{ __('Shipments') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('monitor.sales') }}" :active="request()->routeIs('monitor.sales')">
                    {{ __('Sales') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('monitor.inventories') }}" :active="request()->routeIs('monitor.inventories')">
                    {{ __('Inventories') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('monitor.orders') }}" :active="request()->routeIs('monitor.orders')">
                    {{ __('Orders') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('monitor.expired') }}" :active="request()->routeIs('monitor.expired')">
                    {{ __('Expired') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('warehouse.requirements') }}" :active="request()->routeIs('warehouse.requirements')">
                    {{ __('Requirements') }}
                </x-jet-responsive-nav-link>
                @endhasanyrole
                @hasanyrole('Seller|Manager')
                <x-jet-responsive-nav-link href="{{ route('market.index') }}" :active="request()->routeIs('market.index')">
                    {{ __('Market') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('market.sales') }}" :active="request()->routeIs('market.sales')">
                    {{ __('Sales') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('market.inventory') }}" :active="request()->routeIs('market.inventory')">
                    {{ __('Inventory') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('market.orders') }}" :active="request()->routeIs('market.orders')">
                    {{ __('Orders') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('market.expired') }}" :active="request()->routeIs('market.expired')">
                    {{ __('Expired') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('market.requests') }}" :active="request()->routeIs('market.requests')">
                    {{ __('Requests') }}
                </x-jet-responsive-nav-link>
                @endhasanyrole
            @endhasrole
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="flex-shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-jet-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-jet-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-jet-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-jet-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-jet-responsive-nav-link>
                    @endcan

                    <div class="border-t border-gray-200"></div>

                    <!-- Team Switcher -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @foreach (Auth::user()->allTeams() as $team)
                        <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</nav>
