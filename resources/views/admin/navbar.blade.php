<nav class="bg-gray-800 border-b border-gray-200 text-white fixed z-30 w-full">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start">
                <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar" class="lg:hidden mr-2 text-gray-600 hover: cursor-pointer p-2 hover:bg-gray-100 focus:bg-gray-100 focus:ring-2 focus:ring-gray-100 rounded">
                    <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <svg id="toggleSidebarMobileClose" class="w-6 h-6 hidden" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
                <a href="#" class="text-xl font-bold flex items-center lg:ml-2.5">
                    <img src="{{ asset('dist/images/logo_bridget_station.png') }}" class="h-8 mr-2" alt="Logo">
                    <span class="self-center whitespace-nowrap">Bridget's Station</span>
                </a>
                <form action="#" method="GET" class="hidden lg:block lg:pl-32">
                    <label for="topbar-search" class="sr-only">Search</label>
                    <div class="mt-1 relative lg:w-64">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input type="text" name="email" id="topbar-search" class="bg-gray-50 border border-gray-300  sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full pl-10 p-2.5" placeholder="Search">
                    </div>
                </form>
            </div>
            <div class="flex items-center">
                <button id="toggleSidebarMobileSearch" type="button" class="lg:hidden text-gray-500 hover: hover:bg-gray-100 p-2 rounded-lg">
                    <span class="sr-only">Search</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div class="hidden lg:flex items-center">
                    <div class="-mb-1">
                        <a href="#" class="text-m flex items-center lg:ml-2.5">
                            @if(Auth::user()->profile_path=="")
                                <div class="relative">
                                    <img class="w-10 h-10 h-8 mr-4 rounded-full" src="{{ asset('dist/images/default.jpg') }}" alt="user-profile">
                                    <span class="bottom-0 left-7 absolute  w-3.5 h-3.5 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
                                </div>
                            @else
                                <?php
                                    $str = Auth::user()->profile_path;
                                    $str = ltrim($str, 'public/');
                                ?>
                                <div class="relative">
                                    <img class="w-10 h-10 h-8 mr-4 rounded-full" src="{{ asset('../storage/'.$str) }}" alt="user-profile">
                                    <span class="bottom-0 left-7 absolute  w-3.5 h-3.5 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
                                </div>
                            @endif
                            <span class="self-center whitespace-nowrap">{{Auth::user()->name}}</span>
                        </a>
                        <!-- <a class="github-button" href="#" data-color-scheme="no-preference: dark; light: light; dark: light;" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star themesberg/windster-tailwind-css-dashboard on GitHub">Star</a> -->
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>