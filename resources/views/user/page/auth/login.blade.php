<!DOCTYPE html>
<html lang="en">

<head>
   <meta name="csrf-token" content="{{ csrf_token() }}" />
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="icon" type="image/x-icon" sizes="16x16" href="{{ $identitas_web->logo_company ? asset($identitas_web->logo_company) : asset('/template-user/dist/image/logo.png') }}">
   <title>{{ $identitas_web->name_company }} | Form Login</title>
   @vite(['resources/css/app.css', 'resources/js/app.js'])
   <link rel="preconnect" href="https://fonts.googleapis.com" />
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet" />
</head>

<body class="bg-white h-screen flex items-center">
   <form class="flex h-auto justify-center items-center container mx-auto shadow-lg w-full lg:max-w-[1100px] p-5 gap-4 form-submit">
      <div class="h-screen lg:h-[75vh] w-full items-start bg-white rounded-lg">
         <img src="{{ $identitas_web->logo_company ? asset($identitas_web->logo_company) : asset('/template-user/dist/image/logo.png') }}" class="w-10 mb-3 mt-7 md:mt-4 lg:mt-2" alt="" />
         <h2 class="text-4xl text-center font-bold">Login Account</h2>
         <p class="text-[#9B9B9B] text-center mt-2">Don't have an account yet? <a href="{{ route('register') }}" class="text-blue-600">sign up now</a></p>
         <div>
            <div class="p-4 text-[#9B9B9B]">
               <label for="email">Email</label>
               <input type="email" required name="email" id="email" class="p-1 focus:outline-none border-b border-x-0 border-t-0 block border-[#9B9B9B] w-full" />
            </div>
            <div class="p-4 text-[#9B9B9B]">
               <label for="password">Password</label>
               <input type="password" required name="password" id="password" class="p-1 focus:outline-none border-b border-x-0 border-t-0 block border-[#9B9B9B] w-full" />
            </div>
            <button type="submit" class="bg-[#FA8B02] rounded-lg px-5 py-2 w-full text-white form-login" id="btn-next-form-2">Login</button>
         </div>
      </div>
      <img src="{{ asset('/template-user/dist/image/login-banner.png') }}" class="hidden lg:block h-[75vh] w-auto" alt="" />
   </form>


   <script src="{{ asset('template-admin/plugins/jquery/jquery.min.js') }}"></script>
   <script src="{{ asset('vendors/sweetalert/sweetalert2.js') }}"></script>
   <script type="text/javascript">
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
   </script>
   <script>
      @if (session()->has('status'))
         swal("Done", '{{ session('status') }}', '{{ session('type') }}');
      @endif
      $('.form-submit').submit(function(e) {
         e.preventDefault();
         var button = $('.btn-login');
         var data = $('.form-submit').serialize();
         button.html('Loading...').attr('disabled', true);
         $.post("{{ route('postLogin') }}", data).done(function(data) {
            button.html('Login').removeAttr('disabled');
            if (data.status == 'success') {
               if (data.data.level_user == 'Regular') {
                  window.location.replace("{{ route('home') }}");
               } else {
                  window.location.replace("{{ route('dashboard') }}");
               }
            } else if (data.status == 'error' || data.status == 'warning') {
               swal('Maaf', data.message, data.status);
            } else {
               button.animateCss('shake');
            }
         }).fail(function() {
            swal("Sorry !", "An Error Occurred, Please Try Again !!", "warning");
            button.html('Login').removeAttr('disabled');
         });
      });
   </script>
</body>

</html>
