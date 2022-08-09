<nav class="bg-white border-b border-gray-200 fixed z-30 w-full">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex w-2/3 items-center justify-start">
                <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar"
                    class="lg:hidden mr-2 text-gray-600 hover:text-gray-900 cursor-pointer p-2 hover:bg-gray-100 focus:bg-gray-100 focus:ring-2 focus:ring-gray-100 rounded">
                    <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            ></path>
                    </svg>
                    <svg id="toggleSidebarMobileClose" class="w-6 h-6 hidden" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
            
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            ></path>
                    </svg>
                </button>
                <a href="/" class="text-xl font-bold flex items-center lg:ml-2.5">
                    <blockquote class="font-bold italic text-center flex justify-between items-center text-gray-600">
                        <span class="before:block before:absolute before:-inset-2 before:-skew-y-3 before:bg-cyan-500 relative inline-block">
                            <span class="relative text-white pr-1">Clean</span>
                        </span>
                        <span class="pl-3">pressing</span>
                    </blockquote>
                </a>

                <form action="#" method="GET" class="hidden lg:block lg:pl-32 w-full">
                    <label for="topbar-search" class="sr-only">Search</label>
                    
                </form>

            </div>
            <div class="flex items-center">
                <button id="toggleSidebarMobileSearch" type="button"
                    class="lg:hidden text-gray-500 hover:text-gray-900 hover:bg-gray-100 p-2 rounded-lg">
                    <span class="sr-only">Search</span>
                    </svg>
                </button>
                
                <div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
                    <div @click="open = ! open" class="w-10 cursor-pointer relative h-10 border-2 border-cyan-500 rounded-full bg-gray-100">
                        
                    </div>
                
                    <div x-show="open"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute z-50 mt-2  rounded-md shadow-lg -left-[150%] -mr-4 max-w-lg w-auto"
                            style="display: none;"
                            @click="open = false">
                        <div class="rounded-md ring-1 ring-black ring-opacity-5 bg-gray-100 py-2">
                            <a href="" class="text-center text-cyan-400 hover:underline transition-all font-bold w-full block ">mon profil</a>
                            <span class="h-[1px] w-full bg-cyan-50 my-2 block"></span>
                            <form class="inline" method="POST" action="{{ route('logout') }}">
                                @csrf
            
                                <button type="submit"
                                    class="hidden sm:inline-flex ml-5 text-cyan-500 border-cyan-500 border-2 bg-white hover:bg-gray-700 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-1 text-center items-center mr-3">
                                    Logout 
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                
                
            </div>
        </div>
    </div>
</nav>
