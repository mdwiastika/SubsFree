<!DOCTYPE html>
<html lang="en">

<head>
   <meta name="csrf-token" content="{{ csrf_token() }}" />
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- Favicon icon -->
   <link rel="icon" type="image/png" sizes="16x16" href="{{ $identitas_web->logo_situs ? asset('/' . $identitas_web->logo_situs) : asset('/template-admin/dist/img/favicon.png') }}">
   <title>{{ $identitas_web->nama_situs }} | {{ $title }}</title>

   <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
   <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="{{ asset('template-admin/plugins/fontawesome-free/css/all.min.css') }}">
   <!-- icheck bootstrap -->
   <link rel="stylesheet" href="{{ asset('template-admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
   <!-- Theme style -->
   <link rel="stylesheet" href="{{ asset('template-admin/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page" style="background-color: #F6FAF7; font-family: 'Poppins';">
   <div class="login-box">
      {{-- <div class="login-logo">
                <a href="" class="text-white"><b>MaMi</b></a>
            </div> --}}
      <!-- /.login-logo -->
      <div class="card" style="border-radius: 25px; box-shadow: -10px 36px 38px rgba(72, 149, 110, 0.03), -3px 9px 21px rgba(80, 101, 90, 0.04), 0px 0px 0px rgba(0, 0, 0, 0.1);">
         <div class="card-body login-card-body text-center" style="border-radius: 10px; padding:30px;">
            <form method="post" class="form-login">
               <div style="display:flex; margin-bottom: 8px; padding:10px; justify-content:space-between;">
                  <a href="{{ route('dashboard') }}">
                     <img src="{{ $identitas_web->logo_situs ? asset('/' . $identitas_web->logo_situs) : asset('/template-admin/dist/img/favicon.png') }}" alt="AdminLTE Logo" class="img-circle elevation-1" style="opacity: .8; width:20px">
                     <span class="brand-text font-weight-light" style="color: #A2A2A2;">
                        @php
                           $tulisan_logo = explode(' ', $identitas_web->nama_situs);
                           foreach ($tulisan_logo as $key => $single_tulisan_logo) {
                               if ($key == 0) {
                                   echo "<b style='color:#107AAE'>$single_tulisan_logo</b>";
                               } else {
                                   echo "$single_tulisan_logo";
                               }
                           }
                        @endphp
                     </span>
                  </a>
                  <div>
                     <img src="{{ asset('template-admin/dist/img/custom/indonesia.png') }}" alt="Bahasa Indonesia" class="img-circle elevation-1" style="opacity: .8; width:15px; margin-right:1px;">
                     <span>ID</span>
                  </div>
               </div>
               <p style="margin-bottom: 2px; font-size:30px; font-weight:bold; color:#394D6F;">Login</p>
               <p style="margin-bottom: 40px; color:#A8A8A8;">Masuk ke Web {{ $identitas_web->nama_situs }}
               </p>
               <div class="input-group mb-3">
                  <input type="email" name="email" class="form-control" placeholder="Alamat Email" required>
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <div style="background-color: #4EF19A; border-radius: 50px; width: 21px; height: 21px;">
                           <span class="fas fa-check" style="color: white; font-size:9px;"></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="mb-4">
                  <input type="password" name="password" class="form-control" placeholder="Kata Sandi" required>
                  {{-- <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div> --}}
               </div>
               <div class="row mb-4">
                  <!-- /.col -->
                  <div class="col-lg-12 mb-2">
                     <button type="submit" class="btn btn-block btn-login" style="background-color: #4EF19A; border:1px solid #D1D8E0; color:white;">Masuk</button>
                  </div>
                  {{-- <div class="col-lg-12">
                                <a href="{{route('dashboard')}}" class="btn btn-block" style="background-color: #FC6969; border:1px solid #D1D8E0; color:white;">Lewati Login</a>
                            </div> --}}
                  <!-- /.col -->
               </div>
            </form>
         </div>
         <!-- /.login-card-body -->
      </div>
   </div>
   <!-- /.login-box -->

   <!-- jQuery -->
   <script src="{{ asset('template-admin/plugins/jquery/jquery.min.js') }}"></script>
   <!-- Bootstrap 4 -->
   <script src="{{ asset('template-admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
   <!-- AdminLTE App -->
   <script src="{{ asset('template-admin/dist/js/adminlte.min.js') }}"></script>

   <!-- custom -->
   <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
   <script src="{{ asset('vendors/sweetalert/sweetalert2.js') }}"></script>

   <!-- End custom js for this page-->
   <script type="text/javascript">
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
   </script>
   <script type="text/javascript">
      function kosong() {
         swal('Whoops!!', 'Fitur Belum Bisa Digunakan', 'warning')
      }
   </script>
   <script type="text/javascript">
      @if (session()->has('status'))
         swal("Done", '{{ session('status') }}', '{{ session('type') }}');
      @endif
      // console.log(`@{{ session('status') }}`);
      $('.form-login').submit(function(e) {
         e.preventDefault();
         var button = $('.btn-login');
         var data = $('.form-login').serialize();
         button.html('Loading...').attr('disabled', true);
         $.post("{{ route('postLogin') }}", data).done(function(data) {
            button.html('Login').removeAttr('disabled');
            // $('.form-login').validate(data.result, 'has-error');
            if (data.status == 'success') {
               window.location.replace("{{ route('dashboard') }}");
            } else if (data.status == 'error' || data.status == 'warning') {
               swal('Maaf', data.message, data.status);
            } else {
               button.animateCss('shake');
            }
         }).fail(function() {
            swal("MAAF !", "Terjadi Kesalahan, Silahkan Ulangi Kembali !!", "warning");
            button.html('Login').removeAttr('disabled');
         });
      });
   </script>
</body>

</html>
