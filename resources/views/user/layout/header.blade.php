<nav class="backdrop-blur-lg bg-white/50 fixed w-full z-20 top-0 start-0 border-b border-gray-200" id="navbar">
   <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
         <img src="{{ $identitas_web->logo_company ? asset($identitas_web->logo_company) : asset('/template-user/dist/image/logo.png') }}" class="h-8" alt="{{ $identitas_web->name_company }} Logo">
         <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">{{ $identitas_web->name_company }}</span>
      </a>
      <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
         <button id="dropdownSmallButton" data-dropdown-toggle="dropdownSmall" class="hidden md:inline-flex items-center px-3 py-2 mb-3 me-3 text-sm font-medium text-center text-black rounded-lg md:mb-0 focus:outline-none" type="button">
            <img src="{{ asset('/template-user/dist/image/user.png') }}" class="w-10 h-10" alt="">
            <svg class="w-2 h-2 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="black" viewBox="0 0 10 6">
               <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
            </svg>
         </button>
         @if (Auth::check())
            <div id="dropdownSmall" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
               <div class="px-4 py-3 text-sm text-gray-900">
                  <div title="{{ Auth::user()->name }}">{{ Auth::user()->name }}</div>
                  <div class="font-medium truncate" title="{{ Auth::user()->email }}">{{ Auth::user()->email }}</div>
               </div>
               <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownSmallButton">
                  <li>
                     <a href="{{ route('historyTransaction') }}" class="block px-4 py-2 hover:bg-gray-100">History Transaction</a>
                  </li>
               </ul>
               <div class="py-2">
                  <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign out</a>
               </div>
            </div>
         @else
            <div id="dropdownSmall" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
               <div class="px-4 py-3 text-sm text-gray-900">
                  <div>Guest</div>
                  <div class="font-medium truncate">Guest</div>
               </div>
               <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownSmallButton">
               </ul>
               <div class="py-2">
                  <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign In</a>
               </div>
            </div>
         @endif
         <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-sticky" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
               <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
            </svg>
         </button>
      </div>
      <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
         <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent">
            <li class="block md:hidden">
               @if (Auth::check())
                  <div class="px-4 py-3 text-sm text-gray-900">
                     <div>{{ Auth::user()->name }}</div>
                     <div class="font-medium truncate">{{ Auth::user()->email }}</div>
                  </div>
               @else
                  <div class="px-4 py-3 text-sm text-gray-900">
                     <div>Guest</div>
                     <div class="font-medium truncate">Guest</div>
                  </div>
               @endif
            </li>
            <li>
               <a href="{{ route('home') }}" class="text-base line font-semibold block py-2 px-3 rounded md:bg-transparent md:hover:bg-transparent md:hover:text-[#FA8B02] {{ $menu == 'home' ? 'md:text-[#FA8B02] bg-[#FA8B02] text-white' : 'text-gray-900 hover:bg-gray-100' }} md:p-0">Home</a>
            </li>
            <li>
               <a href="{{ route('userRooms') }}" class="text-base line font-semibold block py-2 px-3 rounded md:bg-transparent md:hover:bg-transparent md:hover:text-[#FA8B02] {{ $menu == 'rooms' ? 'md:text-[#FA8B02] bg-[#FA8B02] text-white' : 'text-gray-900 hover:bg-gray-100' }} md:p-0">Get Rooms</a>
            </li>
            <li>
               <a href="{{ route('userAbout') }}" class="text-base line font-semibold block py-2 px-3 rounded md:bg-transparent md:hover:bg-transparent md:hover:text-[#FA8B02] {{ $menu == 'about' ? 'md:text-[#FA8B02] bg-[#FA8B02] text-white' : 'text-gray-900 hover:bg-gray-100' }} md:p-0">About</a>
            </li>
            <li>
               <a href="{{ route('userSubscriptionUser') }}" class="text-base line font-semibold block py-2 px-3 rounded md:bg-transparent md:hover:bg-transparent md:hover:text-[#FA8B02] {{ $menu == 'subscription' ? 'md:text-[#FA8B02] bg-[#FA8B02] text-white' : 'text-gray-900 hover:bg-gray-100' }} md:p-0">Subscription</a>
            </li>
            <li class="md:hidden">
               @if (Auth::check())
                  <a href="{{ route('historyTransaction') }}" class="text-base line font-semibold block py-2 px-3 rounded md:bg-transparent md:hover:bg-transparent md:hover:text-[#FA8B02] text-gray-900 hover:bg-gray-100">History Transaction</a>
                  <a href="{{ route('logout') }}" class="text-base line font-semibold block py-2 px-3 rounded md:bg-transparent md:hover:bg-transparent md:hover:text-[#FA8B02] text-gray-900 hover:bg-gray-100">Logout</a>
               @else
                  <a href="{{ route('login') }}" class="text-base line font-semibold block py-2 px-3 rounded md:bg-transparent md:hover:bg-transparent md:hover:text-[#FA8B02] text-gray-900 hover:bg-gray-100">Sign In</a>
               @endif
            </li>
         </ul>
      </div>
   </div>
</nav>
