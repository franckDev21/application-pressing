<aside id="sidebar"
    class="fixed hidden z-20 h-full top-0 left-0 pt-16 lg:flex flex-shrink-0 flex-col w-64 transition-width duration-75"
    aria-label="Sidebar">
    <div class="relative flex-1 flex flex-col min-h-0 border-r border-gray-200 bg-white pt-0">
        <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
            <div class="flex-1 px-3 bg-white divide-y space-y-1">
                <ul class="space-y-2 pb-2">
                    <li>
                        <form action="#" method="GET" class="lg:hidden">
                            <label for="mobile-search" class="sr-only">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                        </path>
                                    </svg>
                                </div>
                                <input type="text" name="email" id="mobile-search"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  focus:ring-cyan-600 block w-full pl-10 p-2.5"
                                    placeholder="Search">
                            </div>
                        </form>
                    </li>
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="text-base text-gray-900 font-normal rounded-lg flex items-center p-2 hover:bg-gray-100 group {{ request()->routeIs('dashboard') ? 'bg-gray-100':'' }}">
                            <svg class="w-6 h-6 text-gray-500 group-hover:text-gray-900 transition duration-75 {{ request()->routeIs('dashboard') ? 'text-gray-900':'' }}"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                            </svg>
                            <span class="ml-3">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.index') }}"
                            class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ request()->routeIs('client.index') || request()->routeIs('client.create') ? 'bg-gray-100':'' }}">
                            <i class="las la-user text-3xl font-extrabold"></i>
                            <span class="ml-3 flex-1 whitespace-nowrap">Gestion des clients</span>
                        </a>
                    </li>
                    <li x-data="{ open: false }" class="cursor-pointer">
                        <span @click="open = ! open"
                            class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ request()->routeIs('commande.index') || request()->routeIs('commande.create') ? 'bg-gray-100':'' }}">
                            <i class="las la-shipping-fast text-3xl"></i>
                            <span class="ml-3 flex-1 whitespace-nowrap">Commandes</span>
                            
                        </span>
                        <ul x-show="open" class="-mt-2 pt-1 rounded-md bg-gray-100 pb-2">
                            <li  class="flex mt-2 items-center justify-end w-full">
                                <i class="las la-list text-2xl"></i>
                                <a href="{{ route('commande.index') }}" class="py-2 px-4 rounded-md inline-block hover:bg-white mr-2 {{ request()->routeIs('commande.index') ? 'bg-white':'' }}" >liste des commandes</a>
                            </li>
                            <li  class="flex mt-2 items-center justify-end w-full">
                                <i class="las la-plus-circle text-2xl"></i>
                                <a href="{{ route('commande.create') }}" class="py-2 px-4 rounded-md inline-block hover:bg-white mr-2 {{ request()->routeIs('commande.create') ? 'bg-white':'' }}" >Nouvelle commande</a>
                            </li>
                        </ul>
                    </li>
                    <li x-data="{ open: false }" class="cursor-pointer">
                        <span @click="open = ! open"
                            class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ request()->routeIs('fournisseur.index') || request()->routeIs('fournisseur.create') || request()->routeIs('produit.index') ? 'bg-gray-100':'' }}">
                            <i class="las la-store-alt text-3xl"></i>
                            <span class="ml-3 flex-1 whitespace-nowrap">Stock</span>
                            
                        </span>
                        <ul x-show="open" class="-mt-2 pt-1 rounded-md bg-gray-100 pb-2">
                            <li  class="flex mt-2 items-center justify-between pl-5 w-full">
                                <i class="las la-atom text-2xl""></i>
                                <a href="{{ route('produit.index') }}" class="py-2 px-4 rounded-md inline-block hover:bg-white mr-2 {{ request()->routeIs('produit.index') ? 'bg-white':'' }}" >Produit en stock</a>
                            </li>
                            <li  class="flex mt-2 items-center justify-between pl-5 w-full">
                                <i class="las la-clipboard-list text-2xl"></i>
                                <a href="{{ route('appro.index')  }}" class="py-2 px-4 rounded-md inline-block hover:bg-white mr-2 {{ request()->routeIs('commande.create') ? 'bg-white':'' }}" >Historique produit</a>
                            </li>
                            <li  class="flex mt-2 items-center justify-between pl-5 w-full">
                                <i class="las la-people-carry text-2xl"></i>
                                <a href="{{ route('fournisseur.index') }}" class="py-2 px-4 rounded-md inline-block hover:bg-white mr-2 {{ request()->routeIs('fournisseur.index') ? 'bg-white':'' }}" >Fournisseurs</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('caisse.index') }}"
                            class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group ">
                            <i class="las la-hand-holding-usd text-4xl"></i>
                            <span class="ml-3 flex-1 whitespace-nowrap">Caisse</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://demo.themesberg.com/windster/authentication/sign-in/"
                            class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group ">
                            <i class="las la-cog text-3xl"></i>
                            <span class="ml-3 flex-1 whitespace-nowrap">Options</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</aside>
