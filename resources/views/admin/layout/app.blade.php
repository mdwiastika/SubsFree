<!DOCTYPE html>
<html lang="en">

<head>
   <meta name="csrf-token" content="{{ csrf_token() }}" />
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
   <!-- Favicon icon -->
   <link rel="icon" type="image/x-icon" sizes="16x16" href="{{ $identitas_web->logo_situs ? asset('/' . $identitas_web->logo_situs) : asset('/template-admin/dist/img/favicon.png') }}">

   <title>{{ $identitas_web->name_company }} | {{ $title }}</title>

   <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
   <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="{{ asset('template-admin/plugins/fontawesome-free/css/all.min.css') }}">
   <!-- Theme style -->
   <link rel="stylesheet" href="{{ asset('template-admin/dist/css/adminlte.min.css') }}">

   <!-- custom -->
   <link rel="stylesheet" href="{{ asset('vendors/select2/select2.min.css') }}">
   <link rel="stylesheet" href="{{ asset('vendors/sweetalert/sweetalert.css') }}">
   <link rel="stylesheet" href="{{ asset('/vendors/datepicker/bootstrap-datetimepicker.min.css') }}">
   <link rel="stylesheet" href="{{ asset('/userpage/plugins/themify/css/themify-icons.css') }}">
   <link rel="stylesheet" href="{{ asset('/template-admin/plugins/daterangepicker/daterangepicker.css') }}">
   <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   </link>
   {{-- <link href="{{asset('template-admin/dist/css/style.min.css')}}" rel="stylesheet"> --}}
   <style>
      :root {
         --primary-web: #FA8B02;
      }

      html,
      body {
         font-family: 'Poppins';
      }

      .required_field {
         color: red;
      }

      .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active,
      .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
         background-color: transparent;
         color: var(--primary-web);
      }

      .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active:hover,
      .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active:hover {
         background-color: rgba(0, 0, 0, 0.1);
      }

      [class*=sidebar-light-] .nav-sidebar>.nav-item>.nav-link.active {
         color: var(--primary-web);
         box-shadow: none;
      }

      [class*=sidebar-light-] .nav-sidebar>.nav-item>.nav-link {
         color: #878787;
      }

      /* Admin Start */
      .anak-judul {
         font-weight: 100;
         font-size: 15px;
         color: #878787;
         margin: 5px 0 10px 0;
      }

      .judul {
         font-size: 28px;
         font-weight: bold;
         margin: 0;
      }

      .btn {
         border-radius: 20px;
         padding: 6px 20px;
      }

      /* Dtagrid Start */
      .table thead th {
         background-color: #fff !important;
      }

      #paging li a {
         /* background-color: #5f76e8; */
         background-color: #eee;
         padding: 10px 20px;
         border-radius: 10px;
         /* color: #fff; */
         color: #000;
         text-decoration: none;
      }

      #paging li a:hover {
         background-color: #d3d3d3;
      }

      #paging li.active a {
         background-color: #97A6F4;
         padding: 10px 20px;
         border-radius: 10px;
         color: #fff;
         text-decoration: none;
      }

      #paging li.disabled a {
         background-color: #eee;
         padding: 10px 20px;
         border-radius: 10px;
         color: #000;
         text-decoration: none;
      }

      #paging li {
         padding: 2px;
      }

      /* Datagrid End */

      /* Button Start */
      .btn-primary {
         /* background-color: white;
        color:#0500FF;
        box-shadow: rgb(149 157 165 / 45%) 0px 0px 20px 0px; */
         background-color: #0500FF;
         color: white;
         border: none;
         font-weight: 600;
         letter-spacing: 1px;
      }

      .btn-warning {
         /* background-color: white;
        color:#FFB800;
        box-shadow: rgb(149 157 165 / 45%) 0px 0px 20px 0px; */
         background-color: #FFB800;
         color: white;
         border: none;
         font-weight: 600;
         letter-spacing: 1px;
      }

      .btn-success {
         /* background-color: white;
        color:#68EA65;
        box-shadow: rgb(149 157 165 / 45%) 0px 0px 20px 0px; */
         background-color: #68EA65;
         color: white;
         border: none;
         font-weight: 600;
         letter-spacing: 1px;
      }

      .btn-danger {
         /* background-color: white;
        color:#FC6969;
        box-shadow: rgb(149 157 165 / 45%) 0px 0px 20px 0px; */
         background-color: #FC6969;
         color: white;
         border: none;
         font-weight: 600;
         letter-spacing: 1px;
      }

      .btn-info {
         /* background-color: white;
        color:#97A6F4;
        box-shadow: rgb(149 157 165 / 45%) 0px 0px 20px 0px; */
         background-color: #97A6F4;
         color: white;
         border: none;
         font-weight: 600;
         letter-spacing: 1px;
      }

      .btn-info-outline {
         /* background-color: white;
        color:#97A6F4;
        box-shadow: rgb(149 157 165 / 45%) 0px 0px 20px 0px; */
         background-color: white;
         outline: 1.5px solid #97A6F4;
         color: #97A6F4;
         border: none;
         font-weight: 600;
         letter-spacing: 1px;
      }

      .btn-dark {
         /* background-color: white;
        color:#2b2c33;
        box-shadow: rgb(149 157 165 / 45%) 0px 0px 20px 0px; */
         background-color: #2b2c33;
         color: white;
         border: none;
         font-weight: 600;
         letter-spacing: 1px;
      }

      /* Button End */
      /* Another Button Start */
      .btn-shadow {
         box-shadow: rgb(149 157 165 / 46%) 0px 11px 18px 0px;
      }

      #btn-add {
         box-shadow: rgb(149 157 165 / 46%) 0px 11px 18px 0px;
         background-color: #97A6F4;
         color: white;
      }

      #btn-detail {
         background-color: white;
         color: #FFB800;
         box-shadow: rgb(149 157 165 / 45%) 0px 0px 20px 0px;
      }

      #btn-edit {
         background-color: white;
         color: #0500FF;
         box-shadow: rgb(149 157 165 / 45%) 0px 0px 20px 0px;
      }

      #btn-delete {
         background-color: white;
         color: #FC6969;
         box-shadow: rgb(149 157 165 / 45%) 0px 0px 20px 0px;
      }

      .img-bukti {
         width: 120px;
         height: 80px;
         border-radius: 5%;
         object-fit: cover;
      }

      .img-show {
         width: 240px;
         height: 160px;
         border-radius: 10%;
         object-fit: cover;
         display: block;
      }

      .img-show-cover {
         width: 240px;
         border-radius: 10%;
         object-fit: cover;
         display: block;
      }

      .img-show-cover-v2 {
         object-fit: cover;
         display: block;
      }

      .img-show-portrait {
         width: 200px;
         height: 350px;
         border-radius: 5%;
         object-fit: cover;
         display: block;
      }

      .img-icon {
         width: 50px;
         height: 50px;
         border-radius: 5%;
         object-fit: cover;
         display: block;
      }

      .img-show-large {
         width: 240px;
         height: 160px;
         border-radius: 10%;
         object-fit: contain;
         display: block;
      }

      /* Another Button End */

      .ui-datepicker-calendar {
         display: none;
      }

      ​
      /* Admin End */
   </style>

   @yield('css')
</head>

<body class="hold-transition sidebar-mini">
   <!-- Site wrapper -->
   <div class="wrapper" style="background-color: #F7F7FA;">
      <!-- Navbar -->
      @include('admin.layout.header')
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      @include('admin.layout.sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="background-color:#F7F7FA;">
         <!-- Content Header (Page header) -->
         @yield('content')
         <!-- /.content-wrapper -->
      </div>

      @include('admin.layout.footer')

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
         <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
   </div>
   <!-- ./wrapper -->

   <!-- jQuery -->
   <script src="{{ asset('template-admin/plugins/jquery/jquery.min.js') }}"></script>

   <!-- Bootstrap 4 -->
   <script src="{{ asset('template-admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
   <!-- AdminLTE App -->
   <script src="{{ asset('template-admin/dist/js/adminlte.min.js') }}"></script>
   <!-- AdminLTE for demo purposes -->
   <script src="{{ asset('template-admin/dist/js/demo.js') }}"></script>

   <!-- custom -->
   <script src="{{ asset('vendors/datagrid/datagrid.js') }}"></script>
   <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
   <script src="{{ asset('vendors/sweetalert/sweetalert2.js') }}"></script>
   <script src="{{ asset('vendors/animate/animate.js') }}"></script>
   <script src="{{ asset('vendors/validate/validate.js') }}"></script>
   <script src="{{ asset('/vendors/datepicker/bootstrap-datetimepicker.min.js') }}"></script>
   <script src="{{ asset('template-admin/plugins/moment/moment.min.js') }}"></script>
   <script src="{{ asset('/template-admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <script type="text/javascript">
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
      @if (!empty(Session::get('message')))
         swal.fire({
            title: "{{ Session::get('title') }}",
            text: "{{ Session::get('message') }}",
            icon: "{{ Session::get('icon') }}",
            timer: 2000,
            showConfirmButton: false
         });
      @endif
      function kosong() {
         swal('Whoops!!', 'Fitur Belum Bisa Digunakan', 'warning')
      }

      function logout() {
         swal({
            title: "Apakah Anda yakin ingin Logout ?",
            text: "",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya, Logout!',
         }).then((result) => {
            if (result.value) {
               window.location.replace("{{ route('logout') }}")
            } else if (result.dismiss === Swal.DismissReason.cancel) {
               //
            }
         });
      }
      //digunakan untuk pengecekan angka (merubah huruf menjadi angka)
      function ubahFormatNumber(v) {
         $(v).val(formatNumber(v.value));
      }

      /* Fungsi formatRupiah untuk inputan */
      function ubahFormat(v) {
         $(v).val(formatRupiah(v.value, "Rp. "));
         $('#pesanan_tempo_1').val($('#dp_pesanan').val());
      }

      /* Fungsi formatRupiah */
      function formatRupiah(angka, prefix) {
         var number_string = angka.toString().replace(/[^,\d]/g, "");
         split = number_string.split(",");
         sisa = split[0].length % 3;
         rupiah = split[0].substr(0, sisa);
         ribuan = split[0].substr(sisa).match(/\d{3}/gi);

         // tambahkan titik jika yang di input sudah menjadi angka ribuan
         if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
         }

         rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
         return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
      }
      @if (in_array(Route::currentRouteName(), ['artikel']))
         CKEDITOR.on("instanceReady", function(event) {
            event.editor.on("beforeCommandExec", function(event) {
               if (event.data.name == "paste") {
                  event.editor._.forcePasteDialog = true;
               }
               if (event.data.name == "pastetext" && event.data.commandData.from == "keystrokeHandler") {
                  event.cancel();
               }
            })
         });
         CKEDITOR.config.allowedContent = true;
      @endif
   </script>

   @yield('js')
</body>

</html>
