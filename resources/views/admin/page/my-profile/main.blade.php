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
                              <input type="hidden" name="level_user" class="form-control" id="level_user" value="{{ $edit ? $data->level_user : '' }}">
                              <input type="hidden" name="level_subscription" class="form-control" id="level_subscription" value="{{ $edit ? $data->level_subscription : '' }}">
                              <input type="hidden" name="status_user" class="form-control" id="status_user" value="{{ $edit ? $data->status_user : '' }}">
                              <div class="card-body row">
                                 <div class="form-group col-12 col-md-6">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{ $edit ? $data->name : '' }}" placeholder="Name">
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
                                    <label for="proof_authenticity">Proof Authenticity (Optional)</label>
                                    <input type="file" class="form-control" name="proof_authenticity" onchange="readURL(this)" accept=".png,.jpg,.jpeg">
                                    @if ($edit)
                                       <input type="hidden" id="old_proof_authenticity" value="{{ $data->proof_authenticity }}" name="old_proof_authenticity">
                                       <img src="{{ asset($data->proof_authenticity) }}" class="img-show mt-2" alt="">
                                    @endif
                                 </div>
                                 <div class="form-group col-12 col-md-6">
                                    <label for="password">Password {{ $edit ? '(Isi jika ingin merubah password)' : '' }}</label>
                                    <input type="text" name="password" class="form-control" id="password" value="{{ $edit ? '' : '' }}" placeholder="Password">
                                 </div>
                              </div>
                              <!-- /.card-body -->

                              <div class="card-footer">
                                 <button type="submit" class="btn btn-primary btn-simpan">Save</button>
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
