<div class="container-fluid">
   <div class="row">
      <!-- left column -->
      <div class="col-md-12">
         <!-- general form elements -->
         <div class="card card-primary">
            <div class="card-header">
               <h3 class="card-title">Form {{ $edit ? 'Ubah' : 'Tambah' }} {{ $title }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-data" method="post">
               <input type="hidden" name="id" class="form-control" id="id" value="{{ $edit ? $data->id : '' }}">
               <div class="card-body row">
                  <div class="form-group col-12 col-md-6">
                     <label for="nama_lengkap">Nama Lengkap</label>
                     <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" value="{{ $edit ? $data->nama_lengkap : '' }}" placeholder="Nama Lengkap">
                  </div>
                  <div class="form-group col-12 col-md-6">
                     <label for="username">Username</label>
                     <input type="text" name="username" class="form-control" id="username" value="{{ $edit ? $data->username : '' }}" placeholder="Username">
                  </div>
                  <div class="form-group col-12 col-md-6">
                     <label for="email">Email</label>
                     <input type="text" name="email" class="form-control" id="email" value="{{ $edit ? $data->email : '' }}" placeholder="Email">
                  </div>
                  <div class="form-group col-12 col-md-6">
                     <label for="no_wa">NO. WA</label>
                     <input type="text" name="no_wa" class="form-control" id="no_wa" value="{{ $edit ? $data->no_wa : '' }}" placeholder="NO. WA">
                  </div>
                  <div class="form-group col-12 col-md-6">
                     <label for="level_user">Level</label>
                     <select name="level_user" id="level_user" class="form-control">
                        <option value="" selected disabled>.:: Pilih Level ::.</option>
                        @if (Auth::user()->level_user == 'Super Admin')
                           <option value="Admin" {{ $edit ? ($data->level_user == 'Admin' ? 'selected' : '') : '' }}>
                              Admin
                           </option>
                        @endif
                        <option value="Pengguna" {{ $edit ? ($data->level_user == 'Pengguna' ? 'selected' : '') : '' }}>
                           Pengguna
                        </option>
                     </select>
                  </div>
                  <div class="form-group col-12 col-md-6">
                     <label for="password">Password {{ $edit ? '(Isi jika ingin merubah password)' : '' }}</label>
                     <input type="text" name="password" class="form-control" id="password" value="{{ $edit ? '' : '' }}" placeholder="Password">
                  </div>
               </div>
               <!-- /.card-body -->

               <div class="card-footer">
                  <a href="javascript:void(0)" class="btn btn-warning" onclick="kembali()">Kembali</a>
                  @if (!$show)
                     <button type="submit" class="btn btn-primary btn-simpan">Simpan</button>
                  @endif
               </div>
            </form>
         </div>
         <!-- /.card -->

      </div>
      <!--/.col (left) -->
   </div>
   <!-- /.row -->
</div><!-- /.container-fluid -->

<script>
   if ("{{ $show }}") {
      $('form *').prop('disabled', true)
   }

   function kembali() {
      $('.other-page').html('');
      $('.main-layer').show();
   }

   function error_validate(message) {
      swal("MAAF !", message, "warning");
      $('.btn-simpan').html('Simpan').removeAttr('disabled');
   }

   $('.btn-simpan').click((e) => {
      e.preventDefault();
      $('.btn-simpan').html('Proses Simpan').attr('disabled', true);
      var data = new FormData($('.form-data')[0]);
      var id = $('input[name=id]').val();
      var nama = $('input[name=nama]').val();
      var username = $('input[name=username]').val();
      var email = $('input[name=email]').val();
      var password = $('input[name=password]').val();
      var level_user = $('#level_user').val();

      $.ajax({
         url: "{{ route('usersStore') }}",
         type: 'POST',
         data: data,
         async: true,
         cache: false,
         contentType: false,
         processData: false,
         success: function(data) {
            if (data.status == 'success') {
               swal('Berhasil', data.message, 'success');
               kembali()
               datagrid.reload();
            } else {
               return error_validate(`${data.message}`);
            }
         }
      }).fail(function() {
         return error_validate('Terjadi Kesalahan, Silahkan Ulangi Kembali !!');
      });
   })
</script>
