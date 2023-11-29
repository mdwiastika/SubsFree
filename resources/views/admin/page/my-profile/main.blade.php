@extends('admin.layout.app')
@section('content')
   <div class="container-fluid main-layer">
      <div class="col-12">
         <h2 class="ms-3">My Profile</h2>
         <div class="card ms-2">
            <div class="card-body">
               <div class="tab-content">
                  <div class="tab-pane show active" id="input-types-preview">
                     <div class="row">
                        <div class="col-12">
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
                                    <label for="no_wa">No. Wa</label>
                                    <input type="text" name="no_wa" class="form-control" id="no_wa" value="{{ $edit ? $data->no_wa : '' }}" placeholder="No. Wa">
                                 </div>
                                 <input type="hidden" value="{{ $data->level_user }}" name="level_user">
                                 <div class="form-group col-12 col-md-6">
                                    <label for="password">Password {{ $edit ? '(Isi jika ingin merubah password)' : '' }}</label>
                                    <input type="text" name="password" class="form-control" id="password" value="{{ $edit ? '' : '' }}" placeholder="Password">
                                 </div>
                              </div>
                              <!-- /.card-body -->

                              <div class="card-footer">
                                 <button type="submit" class="btn btn-primary btn-simpan">Simpan</button>
                              </div>
                           </form>
                        </div>
                     </div>
                     <!-- end row-->
                  </div> <!-- end preview-->
               </div> <!-- end tab-content-->
            </div> <!-- end card-body -->
         </div> <!-- end card -->
      </div><!-- end col -->
   </div>
   <div class="col-12 other-page"></div>
   <div class="col-12 modal-dialog"></div>
@endsection
@section('js')
   <script src="{{ asset('/template-admin/assets/vendor/jquery-mask-plugin/jquery.mask.min.js') }}"></script>
   <script src="{{ asset('/template-admin/assets/js/app.min.js') }}"></script>
   <script src="{{ asset('/vendors/ckeditor/ckeditor.js') }}"></script>
   <script>
      if ("{{ $show }}") {
         $('form *').prop('disabled', true);
      }

      function readURL(input, id_gambar) {
         if (input.files && input.files[0]) {
            const container_element = input.parentElement;
            const img_elements = container_element.querySelectorAll('img');
            img_elements.forEach(element => {
               container_element.removeChild(element);
            });
            for (let img_arr = 0; img_arr < input.files.length; img_arr++) {
               const oFReader = new FileReader();
               oFReader.readAsDataURL(input.files[img_arr]);
               oFReader.onload = function(oFREvent) {
                  const get_preview = document.createElement("img");
                  get_preview.style.maxHeight = '200px';
                  get_preview.style.objectFit = 'cover';
                  get_preview.style.maxWidth = '200px';
                  get_preview.style.marginTop = '20px';
                  get_preview.style.marginRight = '10px';
                  get_preview.style.borderRadius = '15px';
                  get_preview.src = oFREvent.target.result;
                  container_element.insertBefore(get_preview, input.nextSibling);
               }
            }
         }
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
         ajaxSimpan();
      });

      function ajaxSimpan() {
         var data = new FormData($('.form-data')[0]);

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
                  $('.btn-simpan').html('Simpan').attr('disabled', false);
               } else {
                  return error_validate(`${data.message}`);
               }
            }
         }).fail(function() {
            return error_validate('Terjadi Kesalahan, Silahkan Ulangi Kembali !!');
         });
      }
   </script>>
@endsection
