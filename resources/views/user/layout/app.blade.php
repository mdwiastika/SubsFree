<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="shortcut icon" href="{{ $identitas_web->logo_company ? asset($identitas_web->logo_company) : asset('/template-user/dist/image/logo.png') }}" type="image/x-icon">
   <title>{{ $identitas_web->name_company }} | {{ $title }}</title>
   <link rel="preconnect" href="https://fonts.googleapis.com" />
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet" />
   <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
   @vite(['resources/css/app.css', 'resources/js/app.js'])
   <style>
      .loader {
         width: 68px;
         height: 68px;
         margin: auto;
         position: relative;
      }

      .loader:before {
         content: '';
         width: 68px;
         height: 5px;
         background: #FA8B0250;
         position: absolute;
         top: 80px;
         left: 0;
         border-radius: 50%;
         animation: shadow324 0.5s linear infinite;
      }

      .loader:after {
         content: '';
         width: 100%;
         height: 100%;
         background: #FA8B02;
         position: absolute;
         top: 0;
         left: 0;
         border-radius: 4px;
         animation: jump7456 0.5s linear infinite;
      }

      @keyframes jump7456 {
         15% {
            border-bottom-right-radius: 3px;
         }

         25% {
            transform: translateY(9px) rotate(22.5deg);
         }

         50% {
            transform: translateY(18px) scale(1, .9) rotate(45deg);
            border-bottom-right-radius: 40px;
         }

         75% {
            transform: translateY(9px) rotate(67.5deg);
         }

         100% {
            transform: translateY(0) rotate(90deg);
         }
      }

      @keyframes shadow324 {

         0%,
         100% {
            transform: scale(1, 1);
         }

         50% {
            transform: scale(1.2, 1);
         }
      }
   </style>
</head>

<body class="font-sans overflow-hidden">
   <div class="bg-white/100 absolute left-0 right-0 z-50 h-full flex justify-center items-center" id="loader">
      <div class="loader"></div>
   </div>
   @include('user.layout.header')
   @yield('content')
   @include('user.layout.footer')
   <script src="{{ asset('template-admin/plugins/jquery/jquery.min.js') }}"></script>
   <script src="{{ asset('vendors/sweetalert/sweetalert2.js') }}"></script>
   <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
   @yield('js')
   <script>
      $(document).ready(function() {
         setTimeout(() => {
            $('#loader').addClass('hidden');
            $('body').removeClass('overflow-hidden');
         }, 500);
      });
   </script>
</body>

</html>
