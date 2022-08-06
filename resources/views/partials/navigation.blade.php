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
                <a href="https://demo.themesberg.com/windster/" class="text-xl font-bold flex items-center lg:ml-2.5">
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
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            ></path>
                    </svg>
                </button>
                
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
</nav>
