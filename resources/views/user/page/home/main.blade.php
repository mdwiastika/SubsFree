@php
   use Carbon\Carbon;
@endphp
@extends('user.layout.app')
@section('content')
   <style>
      input[type="date"]::-webkit-calendar-picker-indicator {
         filter: invert(1);
         position: absolute;
         left: 5px;
      }

      input[type="date"]:disabled {
         color: white;
      }

      @media (min-width: 768px) {
         input[type="date"]::-webkit-calendar-picker-indicator {
            left: 15px;
         }
      }
   </style>
   <section id="hero" class="hero w-full h-screen max-h-screen bg-cover lg:aspect-video bg-no-repeat flex justify-center items-center flex-col p-2 hover:bg-blend-darken" style="background-image: url({{ $identitas_web->banner_company ? asset($identitas_web->banner_company) : asset('/template-user/dist/image/banner.png') }})">
      <h1 class="text-white text-4xl leading-normal text-center font-semibold font-inter tracking-wide md:text-5xl md:font-bold mb-4 lg:text-7xl xl:text-8xl lg:font-bold xl:font-bold xl:p-10" id="title-banner"></h1>
      <div>
         <a href="{{ route('userRooms') }}" class="py-2 px-5 bg-[#FA8B02] rounded-full text-white flex justify-center items-center">
            <span class="text-base md:text-lg uppercase font-bold">Booking Now&nbsp;</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-auto fill-white inline-block" height="16" width="20" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
               <path
                  d="M288 48c0-26.5 21.5-48 48-48h96c26.5 0 48 21.5 48 48V192h40V120c0-13.3 10.7-24 24-24s24 10.7 24 24v72h24c26.5 0 48 21.5 48 48V464c0 26.5-21.5 48-48 48H432 336c-26.5 0-48-21.5-48-48V48zm64 32v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V80c0-8.8-7.2-16-16-16H368c-8.8 0-16 7.2-16 16zm16 80c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V176c0-8.8-7.2-16-16-16H368zM352 272v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H368c-8.8 0-16 7.2-16 16zm176-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H528zM512 368v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V368c0-8.8-7.2-16-16-16H528c-8.8 0-16 7.2-16 16zM224 160c0 6-1 11-2 16c20 14 34 38 34 64c0 45-36 80-80 80H160V480c0 18-15 32-32 32c-18 0-32-14-32-32V320H80c-45 0-80-35-80-80c0-26 13-50 33-64c-1-5-1-10-1-16c0-53 42-96 96-96c53 0 96 43 96 96z" />
            </svg>
         </a>
      </div>
   </section>
   <section id="different-us" class="flex flex-col justify-center items-center px-4 py-6 md:py-10 lg:py-14 container mx-auto lg:flex-row lg:justify-evenly">
      <h2 class="text-3xl md:text-5xl font-bold flex-1 mb-4 lg:mb-0 max-w-[390px] text-left md:text-center">What Make <span class="text-[#FA8B02]">Us Different?</span></h2>
      <p class="flex-1 max-w-[650px] text-gray-600 text-justify">We pride ourselves on offering a diverse and extensive selection of rooms to cater to various preferences and needs. Whether you're looking for a cozy private space or a shared room with vibrant communal vibes, our marketplace has it all.</p>
   </section>
   <section id="features" class="container mx-auto py-6 md:py-10 lg:py-14 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 px-4">
      <div class="shadow-md rounded-md py-3 px-5">
         <div class="bg-[#F1E14C3B] w-16 h-16 rounded-full flex justify-center items-center">
            <div class="bg-[#FA8B02] w-12 h-12 rounded-full flex justify-center items-center">
               <svg xmlns="http://www.w3.org/2000/svg" width="27" height="20" viewBox="0 0 37 30" fill="none">
                  <path
                     d="M31.7349 5.38719H25.7138V4.02975C25.7138 2.91911 25.2769 1.98329 24.4033 1.2223C23.5296 0.461307 22.4553 0.0808105 21.1802 0.0808105H15.0882C13.8132 0.0808105 12.7388 0.461307 11.8652 1.2223C10.9915 1.98329 10.5547 2.91911 10.5547 4.02975V5.38719H4.53355C3.25849 5.38719 2.18413 5.75741 1.31048 6.49783C0.436827 7.23826 0 8.18436 0 9.33613V14.5808C0 15.4446 0.495857 15.8766 1.48757 15.8766V26.4276C1.48757 27.1269 1.79453 27.7439 2.40845 28.2787C3.02237 28.8134 3.73074 29.0808 4.53355 29.0808H31.7349C32.5377 29.0808 33.2461 28.8134 33.86 28.2787C34.4739 27.7439 34.7809 27.1269 34.7809 26.4276V15.8766C35.7726 15.8766 36.2684 15.4446 36.2684 14.5808V9.33613C36.2684 8.18436 35.8316 7.23826 34.958 6.49783C34.0843 5.75741 33.0099 5.38719 31.7349 5.38719ZM13.6007 4.02975C13.6007 3.65953 13.7423 3.35102 14.0257 3.10421C14.309 2.85741 14.6632 2.734 15.0882 2.734H21.1802C21.6052 2.734 21.9594 2.85741 22.2428 3.10421C22.5261 3.35102 22.6678 3.65953 22.6678 4.02975V5.38719H13.6007V4.02975ZM4.53355 26.4276V15.8766H13.6007V19.8255C13.6007 20.5659 13.8958 21.1932 14.4861 21.7074C15.0764 22.2216 15.7966 22.4787 16.6466 22.4787H19.6218C20.4718 22.4787 21.192 22.2216 21.7823 21.7074C22.3726 21.1932 22.6678 20.5659 22.6678 19.8255V15.8766H31.7349V26.4276H4.53355ZM16.6466 19.8255V15.8766H19.6218V19.8255H16.6466ZM33.2225 13.2851H3.04598V9.33613C3.04598 8.43117 3.54184 7.97868 4.53355 7.97868H31.7349C32.7266 7.97868 33.2225 8.43117 33.2225 9.33613V13.2851Z"
                     fill="white" />
               </svg>
            </div>
         </div>
         <h3 class="text-lg font-bold">Experienced</h3>
         <p class="text-gray-600">
            We have 5 years of experience with professional workers who are ready to help you.
         </p>
      </div>
      <div class="shadow-md rounded-md py-3 px-5">
         <div class="bg-[#F1E14C3B] w-16 h-16 rounded-full flex justify-center items-center">
            <div class="bg-[#FA8B02] w-12 h-12 rounded-full flex justify-center items-center">
               <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 33 33" fill="none">
                  <path
                     d="M28.7529 2.36206H20.3516C20.0903 2.36187 19.8397 2.46509 19.6543 2.64917L2.8584 19.4451C2.49064 19.8146 2.28418 20.3148 2.28418 20.8362C2.28418 21.3576 2.49064 21.8577 2.8584 22.2273L10.8565 30.2253C11.226 30.5931 11.7262 30.7996 12.2476 30.7996C12.7689 30.7996 13.2691 30.5931 13.6387 30.2253L30.4277 13.4363C30.6118 13.2509 30.715 13.0002 30.7149 12.739V4.33081C30.7161 4.0725 30.6663 3.81648 30.5682 3.57749C30.4702 3.33851 30.3258 3.12128 30.1435 2.9383C29.9611 2.75532 29.7444 2.61021 29.5057 2.51132C29.2671 2.41242 29.0113 2.3617 28.7529 2.36206V2.36206Z"
                     stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
               </svg>
            </div>
         </div>
         <h3 class="text-lg font-bold">Competitive Price</h3>
         <p class="text-gray-600">
            The prices we offer you are very competitive without reducing the quality of the company's work in the slightest
         </p>
      </div>
      <div class="shadow-md rounded-md py-3 px-5">
         <div class="bg-[#F1E14C3B] w-16 h-16 rounded-full flex justify-center items-center">
            <div class="bg-[#FA8B02] w-12 h-12 rounded-full flex justify-center items-center">
               <svg xmlns="http://www.w3.org/2000/svg" width="28" height="29" viewBox="0 0 44 45" fill="none">
                  <path
                     d="M40.6053 17.7839H29.6053C29.4162 17.7839 29.2615 17.9386 29.2615 18.1277V20.1902C29.2615 20.3792 29.4162 20.5339 29.6053 20.5339H40.6053C40.7943 20.5339 40.949 20.3792 40.949 20.1902V18.1277C40.949 17.9386 40.7943 17.7839 40.6053 17.7839ZM34.8475 23.6277H29.6053C29.4162 23.6277 29.2615 23.7824 29.2615 23.9714V26.0339C29.2615 26.223 29.4162 26.3777 29.6053 26.3777H34.8475C35.0365 26.3777 35.1912 26.223 35.1912 26.0339V23.9714C35.1912 23.7824 35.0365 23.6277 34.8475 23.6277ZM20.5088 13.9382H18.6482C18.3818 13.9382 18.167 14.1531 18.167 14.4195V25.0757C18.167 25.2304 18.24 25.3722 18.3646 25.4625L24.7627 30.1289C24.9775 30.2835 25.2783 30.2406 25.433 30.0257L26.5373 28.5175V28.5132C26.692 28.2984 26.6447 27.9976 26.4299 27.8429L20.9857 23.907V14.4195C20.99 14.1531 20.7709 13.9382 20.5088 13.9382Z"
                     fill="white" />
                  <path
                     d="M34.5813 29.0375H32.0977C31.8571 29.0375 31.6293 29.1621 31.5004 29.3683C30.9547 30.232 30.3188 31.0312 29.5883 31.7617C28.3293 33.0207 26.8641 34.0089 25.2356 34.6964C23.5469 35.4097 21.7551 35.7707 19.9074 35.7707C18.0555 35.7707 16.2637 35.4097 14.5793 34.6964C12.9508 34.0089 11.4856 33.0207 10.2266 31.7617C8.96761 30.5027 7.97933 29.0375 7.29183 27.4089C6.57855 25.7246 6.21761 23.9328 6.21761 22.0808C6.21761 20.2289 6.57855 18.4414 7.29183 16.7527C7.97933 15.1242 8.96761 13.6589 10.2266 12.4C11.4856 11.141 12.9508 10.1527 14.5793 9.46519C16.2637 8.75191 18.0598 8.39097 19.9074 8.39097C21.7594 8.39097 23.5512 8.75191 25.2356 9.46519C26.8641 10.1527 28.3293 11.141 29.5883 12.4C30.3188 13.1304 30.9547 13.9296 31.5004 14.7933C31.6293 14.9996 31.8571 15.1242 32.0977 15.1242H34.5813C34.8778 15.1242 35.0668 14.8148 34.9336 14.5527C32.1321 8.97964 26.4516 5.35738 20.1094 5.28433C10.8239 5.16832 3.11097 12.7695 3.09378 22.0464C3.07659 31.3406 10.609 38.8816 19.9032 38.8816C26.327 38.8816 32.102 35.2464 34.9336 29.6089C35.0668 29.3468 34.8735 29.0375 34.5813 29.0375Z"
                     fill="white" />
               </svg>
            </div>
         </div>
         <h3 class="text-lg font-bold">Flexible Subscription</h3>
         <p class="text-gray-600">
            Enjoy the flexibility of choosing subscription plans that suit your lifestyle. Whether you need short-term arrangements or long-term commitments, our marketplace offers a range of plans to accommodate your unique requirements.
         </p>
      </div>
      <div class="shadow-md rounded-md py-3 px-5">
         <div class="bg-[#F1E14C3B] w-16 h-16 rounded-full flex justify-center items-center">
            <div class="bg-[#FA8B02] w-12 h-12 rounded-full flex justify-center items-center">
               <svg xmlns="http://www.w3.org/2000/svg" width="28" height="29" viewBox="0 0 38 39" fill="none">
                  <path
                     d="M33.242 11.0058C33.2156 10.7397 33.1222 10.4847 32.9705 10.2645C32.8187 10.0444 32.6136 9.86632 32.3743 9.74706L19.7076 3.41372C19.4876 3.30365 19.2451 3.24634 18.9991 3.24634C18.7531 3.24634 18.5105 3.30365 18.2905 3.41372L5.62387 9.74706C5.38522 9.867 5.18071 10.0453 5.02931 10.2653C4.87791 10.4853 4.78452 10.74 4.75779 11.0058C4.74037 11.1752 3.2362 28.0536 18.357 34.778C18.5591 34.8691 18.7782 34.9163 18.9999 34.9163C19.2215 34.9163 19.4407 34.8691 19.6427 34.778C34.7635 28.0536 33.2594 11.1768 33.242 11.0058ZM18.9999 31.5844C8.28229 26.4037 7.77562 15.3473 7.8627 12.1696L18.9999 6.60097L30.1291 12.1664C30.1877 15.3156 29.6098 26.4449 18.9999 31.5844Z"
                     fill="white" />
                  <path d="M17.4163 20.0087L13.7857 16.3781L11.5469 18.6169L17.4163 24.4863L26.4524 15.4503L24.2135 13.2114L17.4163 20.0087Z" fill="white" />
               </svg>
            </div>
         </div>
         <h3 class="text-lg font-bold">Best Material</h3>
         <p class="text-gray-600">
            The material determines the building itself so we recommend that you use the best & quality materials in its class.
         </p>
      </div>
   </section>
   <section id="popular-room" class="container mx-auto py-6 md:py-10 lg:py-14 px-4">
      <div class="flex flex-col items-center lg:flex-row lg:justify-evenly lg:items-center gap-2">
         <div class="flex-1 max-w-[390px] lg:max-w-[450px]">
            <h2 class="text-xl font-light mb-2 text-left md:text-center lg:text-left hidden md:block">Popular destination room</h2>
            <h3 class="text-3xl md:text-5xl font-bold mb-4 lg:mb-6 text-left">Ultimate Travel <span class="text-[#FA8B02]">Experience</span></h3>
            <p class="text-justify text-gray-600">Our user-friendly platform ensures a hassle-free booking experience. From browsing available rooms to making secure payments, we prioritize simplicity and efficiency in every step of the process.</p>
         </div>
         @php
            $date_now = Carbon::now();
            $date_tommorow = $date_now
                ->copy()
                ->addDay()
                ->format('d/m/Y');
            $date_after_tommorow = $date_now
                ->copy()
                ->addDay(2)
                ->format('d/m/Y');
         @endphp
         <div class="swiper w-[300px] h-[450px] md:w-[600px] xl:w-[700px] mt-4 lg:mt-0 m-0">
            <div class="swiper-wrapper">
               <div class="swiper-slide rounded-lg border border-blue-500 flex justify-center items-center p-3 hover:p-0 transition-all duration-300">
                  <div class="rounded-lg overflow-hidden w-full h-full bg-cover py-5 px-3 flex flex-col justify-between bg-slate-600/40 bg-blend-darken" style="background-image: url('{{ asset('/template-user/dist/image/slider/slider1.webp') }}')">
                     <div class="rounded-full py-1 px-3 flex items-center justify-start w-[150px] border border-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="20" viewBox="0 0 16 20" fill="none">
                           <path d="M8 10C6.9 10 6 9.1 6 8C6 6.9 6.9 6 8 6C9.1 6 10 6.9 10 8C10 9.1 9.1 10 8 10ZM14 8.2C14 4.57 11.35 2 8 2C4.65 2 2 4.57 2 8.2C2 10.54 3.95 13.64 8 17.34C12.05 13.64 14 10.54 14 8.2ZM8 0C12.2 0 16 3.22 16 8.2C16 11.52 13.33 15.45 8 20C2.67 15.45 0 11.52 0 8.2C0 3.22 3.8 0 8 0Z" fill="white" />
                        </svg>
                        <span class="text-white">&nbsp;Jakarta</span>
                     </div>
                     <a href="{{ route('userRooms', ['location' => 'Jakarta', 'start_date' => $date_tommorow, 'end_date' => $date_after_tommorow]) }}" class="rounded-full py-1 px-3 flex items-center justify-start w-[150px] border border-white">
                        <span class="text-white">Check-In Now</span>
                     </a>
                  </div>
               </div>
               <div class="swiper-slide rounded-lg border border-blue-500 flex justify-center items-center p-3 hover:p-0 transition-all duration-300">
                  <div class="rounded-lg overflow-hidden w-full h-full bg-cover py-5 px-3 flex flex-col justify-between bg-slate-600/40 bg-blend-darken" style="background-image: url('{{ asset('/template-user/dist/image/slider/slider2.webp') }}')">
                     <div class="rounded-full py-1 px-3 flex items-center justify-start w-[150px] border border-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="20" viewBox="0 0 16 20" fill="none">
                           <path d="M8 10C6.9 10 6 9.1 6 8C6 6.9 6.9 6 8 6C9.1 6 10 6.9 10 8C10 9.1 9.1 10 8 10ZM14 8.2C14 4.57 11.35 2 8 2C4.65 2 2 4.57 2 8.2C2 10.54 3.95 13.64 8 17.34C12.05 13.64 14 10.54 14 8.2ZM8 0C12.2 0 16 3.22 16 8.2C16 11.52 13.33 15.45 8 20C2.67 15.45 0 11.52 0 8.2C0 3.22 3.8 0 8 0Z" fill="white" />
                        </svg>
                        <span class="text-white">&nbsp;Surabaya</span>
                     </div>
                     <a href="{{ route('userRooms', ['location' => 'Surabaya', 'start_date' => $date_tommorow, 'end_date' => $date_after_tommorow]) }}" class="rounded-full py-1 px-3 flex items-center justify-start w-[150px] border border-white">
                        <span class="text-white">Check-In Now</span>
                     </a>
                  </div>
               </div>
               <div class="swiper-slide rounded-lg border border-blue-500 flex justify-center items-center p-3 hover:p-0 transition-all duration-300">
                  <div class="rounded-lg overflow-hidden w-full h-full bg-cover py-5 px-3 flex flex-col justify-between bg-slate-600/40 bg-blend-darken" style="background-image: url('{{ asset('/template-user/dist/image/slider/slider3.jpg') }}')">
                     <div class="rounded-full py-1 px-3 flex items-center justify-start w-[150px] border border-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="20" viewBox="0 0 16 20" fill="none">
                           <path d="M8 10C6.9 10 6 9.1 6 8C6 6.9 6.9 6 8 6C9.1 6 10 6.9 10 8C10 9.1 9.1 10 8 10ZM14 8.2C14 4.57 11.35 2 8 2C4.65 2 2 4.57 2 8.2C2 10.54 3.95 13.64 8 17.34C12.05 13.64 14 10.54 14 8.2ZM8 0C12.2 0 16 3.22 16 8.2C16 11.52 13.33 15.45 8 20C2.67 15.45 0 11.52 0 8.2C0 3.22 3.8 0 8 0Z" fill="white" />
                        </svg>
                        <span class="text-white">&nbsp;Jogjakarta</span>
                     </div>
                     <a href="{{ route('userRooms', ['location' => 'Jogjakarta', 'start_date' => $date_tommorow, 'end_date' => $date_after_tommorow]) }}" class="rounded-full py-1 px-3 flex items-center justify-start w-[150px] border border-white">
                        <span class="text-white">Check-In Now</span>
                     </a>
                  </div>
               </div>
               <div class="swiper-slide rounded-lg border border-blue-500 flex justify-center items-center p-3 hover:p-0 transition-all duration-300">
                  <div class="rounded-lg overflow-hidden w-full h-full bg-cover py-5 px-3 flex flex-col justify-between bg-slate-600/40 bg-blend-darken" style="background-image: url('{{ asset('/template-user/dist/image/slider/slider4.jpg') }}')">
                     <div class="rounded-full py-1 px-3 flex items-center justify-start w-[150px] border border-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="20" viewBox="0 0 16 20" fill="none">
                           <path d="M8 10C6.9 10 6 9.1 6 8C6 6.9 6.9 6 8 6C9.1 6 10 6.9 10 8C10 9.1 9.1 10 8 10ZM14 8.2C14 4.57 11.35 2 8 2C4.65 2 2 4.57 2 8.2C2 10.54 3.95 13.64 8 17.34C12.05 13.64 14 10.54 14 8.2ZM8 0C12.2 0 16 3.22 16 8.2C16 11.52 13.33 15.45 8 20C2.67 15.45 0 11.52 0 8.2C0 3.22 3.8 0 8 0Z" fill="white" />
                        </svg>
                        <span class="text-white">&nbsp;Bali</span>
                     </div>
                     <a href="{{ route('userRooms', ['location' => 'Bali', 'start_date' => $date_tommorow, 'end_date' => $date_after_tommorow]) }}" class="rounded-full py-1 px-3 flex items-center justify-start w-[150px] border border-white">
                        <span class="text-white">Check-In Now</span>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <section id="video-company" class="container mx-auto py-6 md:py-10 lg:py-14 px-4 flex justify-center items-center flex-col lg:flex-row lg:justify-evenly">
      <div>
         <h2 class="text-2xl md:text-3xl font-bold mb-4 lg:mb-6 text-left max-w-[350px] lg:max-w-[400px]"><span class="border-b-4 border-[#FA8B02]">Get Ready</span> to Unwind</h2>
         <p class="text-gray-600 max-w-[390px] lg:max-w-[450px] text-justify">Enjoy the flexibility of choosing subscription plans that suit your lifestyle. Whether you need short-term arrangements or long-term commitments, our marketplace offers a range of plans to accommodate your unique requirements.</p>
      </div>
      <div class="w-[300px] md:w-[560px] xl:w-[700px] flex justify-center rounded-lg overflow-hidden">
         <iframe width="560" height="315" src="{{ $identitas_web->video_company }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
      </div>
   </section>
   <section id="contact" class="py-6 md:py-10 lg:py-14 px-4 flex justify-center items-center flex-col lg:flex-row lg:justify-evenly bg-no-repeat bg-cover h-[400px] bg-gray-600/60 bg-blend-darken gap-3" style="background-image: url('{{ asset('/template-user/dist/image/banner-contact.png') }}')">
      <div class="text-white max-w-[390px] lg:max-w-[450px]">
         <h2 class="text-4xl font-light">Plan your trip with a comfortable room</h2>
         <p class="text-gray-200">Our professional advisors can put together your perfect vacation home</p>
      </div>
      <div>
         <a class="hover:bg-gray-300 hover:text-black transition-all duration-300 py-1 px-3 border rounded-full border-white text-white cursor-pointer" href="https://wa.me/{{ $identitas_web->no_wa_company }}" target="_blank">Contact Us</a>
      </div>
   </section>
@endsection
@section('js')
   <script src="https://unpkg.com/typeit@8.7.1/dist/index.umd.js"></script>
   <script>
      new TypeIt("#title-banner", {
         strings: "{{ $identitas_web->title_banner_company }}",
         speed: 75,
         waitUntilVisible: true,
      }).go();
   </script>
   <script>
      const swiper = new Swiper('.swiper', {
         direction: 'horizontal',
         loop: true,
         speed: 400,
         slidesPerView: 1,
         spaceBetween: 10,
         breakpoints: {
            320: {
               slidesPerView: 1,
               spaceBetween: 20
            },
            480: {
               slidesPerView: 1,
               spaceBetween: 30
            },
            771: {
               slidesPerView: 2,
               spaceBetween: 40
            },
         },
         autoplay: {
            delay: 3500,
         }
      });
   </script>
@endsection
