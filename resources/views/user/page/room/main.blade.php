@extends('user.layout.app')
@section('content')
   <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
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
   <section id="hero" class="hero w-full h-screen max-h-screen bg-cover lg:aspect-video bg-no-repeat flex justify-center items-center flex-col p-2 hover:bg-blend-darken bg-gradient-to-t from-white/90 to-white/100" style=" background-image: url({{ asset('/template-user/dist/image/banner-room.png') }})">
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
            <div class=" mt-2 relative bg-white/60 backdrop-blur-sm flex justify-center items-center p-0 px-4 rounded-full w-full">
               <svg xmlns="http://www.w3.org/2000/svg" class="fill-white" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                  <path d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192H400V448c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V192z" />
               </svg>
               <input name="start_date" type="text" id="start_date" class="bg-transparent border-0 placeholder-white focus:border-0 focus:ring-0 text-white md:py-3" placeholder="Start Date" readonly>
            </div>
            <div class=" mt-2 relative bg-white/60 backdrop-blur-sm flex justify-center items-center p-0 px-4 rounded-full w-full">
               <svg xmlns="http://www.w3.org/2000/svg" class="fill-white" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                  <path d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192H400V448c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V192z" />
               </svg>
               <input name="end_date" type="text" id="end_date" class="bg-transparent border-0 placeholder-white focus:border-0 focus:ring-0 text-white md:py-3" placeholder="End Date" readonly>
            </div>
         </div>
         <div class="mt-2 flex justify-center">
            <button type="submit" class="bg-[#FA8B02] text-white py-2 px-5 text-base md:text-lg font-bold uppercase rounded-full">Search
               <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-auto inline-block" viewBox="0 0 24 24">
                  <path
                     d="M18.031 16.6168L22.3137 20.8995L20.8995 22.3137L16.6168 18.031C15.0769 19.263 13.124 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2C15.968 2 20 6.032 20 11C20 13.124 19.263 15.0769 18.031 16.6168ZM16.0247 15.8748C17.2475 14.6146 18 12.8956 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18C12.8956 18 14.6146 17.2475 15.8748 16.0247L16.0247 15.8748ZM12.1779 7.17624C11.4834 7.48982 11 8.18846 11 9C11 10.1046 11.8954 11 13 11C13.8115 11 14.5102 10.5166 14.8238 9.82212C14.9383 10.1945 15 10.59 15 11C15 13.2091 13.2091 15 11 15C8.79086 15 7 13.2091 7 11C7 8.79086 8.79086 7 11 7C11.41 7 11.8055 7.06167 12.1779 7.17624Z"
                     fill="rgba(255,255,255,1)"></path>
               </svg>
            </button>
         </div>
      </form>
   </section>
   <section id="rooms" class="grid gap-4 grid-cols-1 relative -top-10 container mx-auto md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
      <div class="max-w-sm bg-white border border-gray-200 rounded-xl shadow p-3">
         <a href="#" class="">
            <img class="rounded-xl aspect-video bg-cover" src="{{ asset('template-user/dist/image/bg-about.png') }}" alt="" />
         </a>
         <div class="py-5 px-2">
            <div class="flex justify-between items-center">
               <h3 class="flex-none w-52 text-lg">Jos & Hanny Villa</h3>
               <span class="text-[#FA8B02] font-semibold">Class 1</span>
            </div>
            <p class="mb-3 font-normal text-gray-700">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
            <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300">
               Read more
               <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
               </svg>
            </a>
         </div>
      </div>

   </section>
@endsection
@section('js')
   <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
   <script>
      var end_picker;
      var start_date_input = document.getElementById('start_date');
      var end_date_input = document.getElementById('end_date');
      let today = new Date();
      let minDate = new Date(today);
      minDate.setDate(today.getDate() + 1);
      var start_picker = new Pikaday({
         field: start_date_input,
         minDate: minDate,
         format: 'D/M/YYYY',
         toString(date, format) {
            const day = date.getDate();
            const month = date.getMonth() + 1;
            const year = date.getFullYear();
            return `${day}/${month}/${year}`;
         },
         parse(dateString, format) {
            const parts = dateString.split('/');
            const day = parseInt(parts[0], 10);
            const month = parseInt(parts[1], 10) - 1;
            const year = parseInt(parts[2], 10);
            return new Date(year, month, day);
         }
      });
   </script>
   <script>
      function formatDate(date) {
         var day = ("0" + date.getDate()).slice(-2);
         var month = ("0" + (date.getMonth() + 1)).slice(-2);
         var year = date.getFullYear();
         return year + "-" + month + "-" + day;
      }
      $('#start_date').on('change', function() {
         if ($('#start_date').val()) {
            $('#end_date').attr('disabled', false);
            let value_now = $('#start_date').val();
            var date_parts = value_now.split("/");
            let min_date = new Date(date_parts[2], date_parts[1] - 1, date_parts[0]);
            let max_date = new Date(date_parts[2], date_parts[1] - 1, date_parts[0]);
            min_date.setDate(min_date.getDate() + 1);
            max_date.setDate(max_date.getDate() + 10);
            if (end_picker) {
               end_picker.setDate('');
               end_picker.setMinDate(min_date)
               end_picker.setMaxDate(max_date)
            } else {
               end_picker = new Pikaday({
                  field: end_date_input,
                  minDate: min_date,
                  maxDate: max_date,
                  format: 'D/M/YYYY',
                  toString(date, format) {
                     const day = date.getDate();
                     const month = date.getMonth() + 1;
                     const year = date.getFullYear();
                     return `${day}/${month}/${year}`;
                  },
                  parse(dateString, format) {
                     const parts = dateString.split('/');
                     const day = parseInt(parts[0], 10);
                     const month = parseInt(parts[1], 10) - 1;
                     const year = parseInt(parts[2], 10);
                     return new Date(year, month, day);
                  }
               });
            }
         }
      });
   </script>
@endsection
