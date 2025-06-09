
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <nav x-data="{ open: false }" class="bg-white text-black tm-barra">
        <!-- Primary Navigation Menu -->
        {{-- fiz uma alteracao na margem, alterei o width no style de 98vw para 100vw, para que ele ocupe a tela toda --}}
        <div class=" mx-auto px-4 sm:px-6 lg:px-8 " style=" padding:0;">
        
            <div class="flex justify-between h-16">
                <div class="shrink-0 flex items-center">
                        <a href="{{ route('telaprincipal') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                        </a>
                </div>
                <div class="flex flex-row">
            
                    <div  class="flex ">
                        <!-- Navigation Links -->
                        <div  class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link href="{{ route('telaprincipal') }}" :active="request()->routeIs('telaprincipal')">
                                {{ __('Inicio') }}
                            </x-nav-link>
                
                            <x-nav-link href="{{ route('consultarvendas') }}" :active="request()->routeIs('consultarvendas')">
                                {{ __('Vendas') }}
                            </x-nav-link>
                             <x-nav-link href="{{ route('criarprato') }}" :active="request()->routeIs('criarprato')">
                                {{ __('Cadastrar Prato') }}
                            </x-nav-link>

                        <div class="relative group inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none transition duration-150 ease-in-out">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="cursor-pointer">
                                    <span class="inline-flex text-black  items-center">
                                        Pedidos
                                    </span></button>
                                </x-slot>
        
                                <x-slot name="content" >
                                    <x-dropdown-link :href="route('cadastrarpedidos')">
                                        {{ __('Cadastrar') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('consultarpedidos')">
                                                {{ __('Consultar') }}
                                    </x-dropdown-link>
                        
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48" >
                            <x-slot name="trigger" >
                                <button  class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md  bg-white  focus:outline-none transition ease-in-out duration-150">
                                    <div>Perfil</div>
                                </button>
                            </x-slot>
                        
                            <x-slot name="content" >
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                                @can('acesso-adm')
                                <x-dropdown-link :href="route('register')">
                                    {{ __('Registrar Usuário') }}
                                </x-dropdown-link>
                                @endcan
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
                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
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
                <x-responsive-nav-link :href="route('telaprincipal')" :active="request()->routeIs('telaprincipal')">
                    {{ __('telaprincipal') }}
                </x-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

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
