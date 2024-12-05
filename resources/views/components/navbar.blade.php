<nav class="bg-gray-800" x-data="{ isOpen: false, activeMenu: 'dashboard' }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="shrink-0">
                    <img class="size-8" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="#" :class="{'bg-gray-900': activeMenu === 'dashboard', 'text-white': activeMenu === 'dashboard', 'text-gray-300': activeMenu !== 'dashboard'}"
                            @click="activeMenu = 'dashboard'"
                            class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-700">Dashboard</a>
                        <a href="#" :class="{'bg-gray-900': activeMenu === 'team', 'text-white': activeMenu === 'team', 'text-gray-300': activeMenu !== 'team'}"
                            @click="activeMenu = 'team'"
                            class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-700">Team</a>
                        <a href="#" :class="{'bg-gray-900': activeMenu === 'projects', 'text-white': activeMenu === 'projects', 'text-gray-300': activeMenu !== 'projects'}"
                            @click="activeMenu = 'projects'"
                            class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-700">Projects</a>
                        <a href="#" :class="{'bg-gray-900': activeMenu === 'calendar', 'text-white': activeMenu === 'calendar', 'text-gray-300': activeMenu !== 'calendar'}"
                            @click="activeMenu = 'calendar'"
                            class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-700">Calendar</a>
                        <a href="#" :class="{'bg-gray-900': activeMenu === 'reports', 'text-white': activeMenu === 'reports', 'text-gray-300': activeMenu !== 'reports'}"
                            @click="activeMenu = 'reports'"
                            class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-700">Reports</a>
                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    <div class="relative ml-3">
                        <div>
                            <button type="button" @click="isOpen = !isOpen" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="absolute -inset-1.5"></span>
                                <span class="sr-only">Open user menu</span>
                                <img class="size-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                            </button>
                        </div>

                        <div  
                            x-show="isOpen"
                            x-transition:enter="transition ease-out duration-100 transform"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75 transform"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="-mr-2 flex md:hidden">
                <button @click="isOpen = !isOpen" type="button" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" aria-controls="mobile-menu" :aria-expanded="isOpen.toString()">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>

                    <svg :class="{'hidden': isOpen, 'block': !isOpen }" class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>

                    <svg :class="{'block': isOpen, 'hidden': !isOpen }" class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="isOpen" id="mobile-menu" class="md:hidden">
        <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
            <a href="#" :class="{'bg-gray-900': activeMenu === 'dashboard', 'text-white': activeMenu === 'dashboard', 'text-gray-300': activeMenu !== 'dashboard'}"
                @click="activeMenu = 'dashboard'"
                class="block rounded-md px-3 py-2 text-base font-medium hover:bg-gray-700">Dashboard</a>
            <a href="#" :class="{'bg-gray-900': activeMenu === 'team', 'text-white': activeMenu === 'team', 'text-gray-300': activeMenu !== 'team'}"
                @click="activeMenu = 'team'"
                class="block rounded-md px-3 py-2 text-base font-medium hover:bg-gray-700">Team</a>
            <a href="#" :class="{'bg-gray-900': activeMenu === 'projects', 'text-white': activeMenu === 'projects', 'text-gray-300': activeMenu !== 'projects'}"
                @click="activeMenu = 'projects'"
                class="block rounded-md px-3 py-2 text-base font-medium hover:bg-gray-700">Projects</a>
            <a href="#" :class="{'bg-gray-900': activeMenu === 'calendar', 'text-white': activeMenu === 'calendar', 'text-gray-300': activeMenu !== 'calendar'}"
                @click="activeMenu = 'calendar'"
                class="block rounded-md px-3 py-2 text-base font-medium hover:bg-gray-700">Calendar</a>
            <a href="#" :class="{'bg-gray-900': activeMenu === 'reports', 'text-white': activeMenu === 'reports', 'text-gray-300': activeMenu !== 'reports'}"
                @click="activeMenu = 'reports'"
                class="block rounded-md px-3 py-2 text-base font-medium hover:bg-gray-700">Reports</a>
        </div>
    </div>
</nav>
