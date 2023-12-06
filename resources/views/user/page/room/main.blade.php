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
   <section id="hero" class="hero w-full h-screen max-h-screen bg-cover lg:aspect-video bg-no-repeat flex justify-center items-center flex-col p-2 hover:bg-blend-darken" style="background-image: url({{ asset('/template-user/dist/image/banner-room.png') }})">
      <h1 class="text-white text-4xl leading-normal text-center font-inter tracking-wide md:text-5xl md:font-thin mb-4 lg:text-6xl xl:text-8xl xl:p-10">The whole world awaits.</h1>
      <form class="block lg:flex justify-center items-center gap-3">
         <div class="mt-2">
            <div class="relative bg-white/60 backdrop-blur-sm flex justify-center items-center p-0 px-4 rounded-full w-full">
               <svg xmlns="http://www.w3.org/2000/svg" class="fill-white" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                  <path d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm306.7 69.1L162.4 380.6c-19.4 7.5-38.5-11.6-31-31l55.5-144.3c3.3-8.5 9.9-15.1 18.4-18.4l144.3-55.5c19.4-7.5 38.5 11.6 31 31L325.1 306.7c-3.2 8.5-9.9 15.1-18.4 18.4zM288 256a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z" />
               </svg>
               <input type="text" class="bg-transparent border-0 placeholder-white focus:border-0 focus:ring-0 text-white md:py-3" name="location" id="location" placeholder="Location">
            </div>
         </div>
         <div class="block md:flex md:gap-2">
            <div class="mt-2 relative bg-white/60 backdrop-blur-sm flex justify-center items-center p-0 px-4 rounded-full w-full">
               <input type="date" onfocus="this.blur()" onclick="this.blur()" class="relative -left-6 md:-left-4 px-10 md:py-3 before:content-['Start Date'] bg-transparent border-0 placeholder-white focus:border-0 focus:ring-0 text-white" name="start_date" id="start_date">
            </div>
            <div class=" mt-2 relative bg-white/60 backdrop-blur-sm flex justify-center items-center p-0 px-4 rounded-full w-full">
               <input type="date" onfocus="this.blur()" onclick="this.blur()" disabled class="relative -left-6 md:-left-4 px-10 md:py-3 before:content-['Start Date'] bg-transparent border-0 placeholder-white focus:border-0 focus:ring-0 text-white" name="end_date" id="end_date">
            </div>
         </div>
         <div class="mt-2 flex justify-center">
            <button type="submit" class="bg-[#FA8B02] text-white py-1 px-3 md:py-3 text-lg font-medium md:text-xl md:font-semibold rounded-full">Search <svg class="inline-block" xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                  <path
                     d="M17.5017 17.5007L13.7632 13.7555L17.5017 17.5007ZM15.835 8.75032C15.835 10.629 15.0887 12.4308 13.7602 13.7592C12.4318 15.0876 10.6301 15.834 8.75136 15.834C6.87266 15.834 5.07091 15.0876 3.74247 13.7592C2.41403 12.4308 1.66772 10.629 1.66772 8.75032C1.66772 6.87162 2.41403 5.06987 3.74247 3.74144C5.07091 2.413 6.87266 1.66669 8.75136 1.66669C10.6301 1.66669 12.4318 2.413 13.7602 3.74144C15.0887 5.06987 15.835 6.87162 15.835 8.75032V8.75032Z"
                     stroke="white" stroke-width="2.00002" stroke-linecap="round" />
               </svg></button>
         </div>
      </form>
   </section>
   <section id="rooms"></section>
@endsection
@section('js')
   <script>
      let today = new Date();
      let minDate = new Date(today);
      minDate.setDate(today.getDate() + 1);

      let format_min_date = formatDate(minDate);
      $('#start_date').attr('min', format_min_date);

      function formatDate(date) {
         var day = ("0" + date.getDate()).slice(-2);
         var month = ("0" + (date.getMonth() + 1)).slice(-2);
         var year = date.getFullYear();
         return year + "-" + month + "-" + day;
      }
      $('#start_date').on('change', function() {
         if ($(this).val()) {
            $('#end_date').attr('disabled', false);
            let min_date = new Date($(this).val());
            let max_date = new Date($(this).val());
            min_date.setDate(min_date.getDate() + 1);
            max_date.setDate(max_date.getDate() + 10);
            $('#end_date').attr('min', formatDate(min_date));
            $('#end_date').attr('max', formatDate(max_date));
         }
      });
   </script>
@endsection
