@extends('admin.layout.app')

@section('content')
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">{{ $title }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item active">{{ $title }}</li>
               </ol>
            </div><!-- /.col -->
         </div><!-- /.row -->
      </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->

   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            @if (Auth::check() && auth()->user()->level_user != 'Pengguna')
               @if (in_array(Auth::user()->level_user, ['Super Admin', 'Admin']))
                  <div class="col-lg-6 col-12">
                     <!-- small box -->
                     <div class="small-box" style="background-color: #3D3C4C; color: white;">
                        <div class="inner">
                           <h3>Pengguna</h3>
                           <h4>{{ $pengguna_count }}</h4>
                        </div>
                        <div class="icon">
                           <i class="fas fa-users" style="color: white"></i>
                        </div>
                        <a href="{{ route('users') }}" class="small-box-footer">Lihat Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <div class="col-lg-6 col-12">
                     <!-- small box -->
                     <div class="small-box" style="background-color: #f78c00; color: white;">
                        <div class="inner">
                           <h3>Mitra</h3>
                           <h4>{{ $mitra_count }}</h4>
                        </div>
                        <div class="icon">
                           <i class="fas fa-handshake" style="color: white"></i>
                        </div>
                        <a href="{{ route('users') }}" class="small-box-footer">Lihat Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
               @endif
               <div class="col-lg-6 col-12">
                  <!-- small box -->
                  <div class="small-box" style="background-color: #00f70c; color: white;">
                     <div class="inner">
                        <h3>Transaksi</h3>
                        <h4>{{ $transaksi_count }}</h4>
                     </div>
                     <div class="icon">
                        <i class="fas fa-hand-holding-usd" style="color: white"></i>
                     </div>
                     <a href="{{ route('transactionRoom') }}" class="small-box-footer">Lihat Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
               </div>
            @endif
         </div>
         <!-- /.row -->
      </div><!-- /.container-fluid -->
   </section>
   <!-- /.content -->
@endsection
@section('js')
   <script>
      $('.download-cover-qr').click(function() {
         const download_link = document.createElement('a');
         download_link.href = "{{ asset($cover_path) }}";
         download_link.download = 'cover-qrcode.jpg';
         document.body.appendChild(download_link);
         download_link.click();
      })
   </script>
@endsection
