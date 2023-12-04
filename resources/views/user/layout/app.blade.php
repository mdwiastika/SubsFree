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
   @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans">
   @include('user.layout.header')
   @yield('content')
   @include('user.layout.footer')
   <script src="{{ asset('template-admin/plugins/jquery/jquery.min.js') }}"></script>
   <script src="{{ asset('vendors/sweetalert/sweetalert2.js') }}"></script>
   @yield('js')
</body>

</html>
