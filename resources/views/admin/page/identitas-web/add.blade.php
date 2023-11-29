@extends('admin.layout.app')
@section('content')
   <div class="container-fluid main-layer">
      <div class="col-12">
         <h2 class="ms-3">Form Edit {{ $title }}</h2>
         <div class="card ms-2">
            <div class="card-body">
               <div class="tab-content">
                  <div class="tab-pane show active" id="input-types-preview">
                     <div class="row">
                        <div class="">
                           <form class="row form-data" method="POST" enctype="multipart/form-data">
                              <input type="hidden" name="id_identitas_web" class="form-control" id="id_identitas_web" value="{{ $edit ? $data->id_identitas_web : '' }}">
                              <div class="row col-12">
                                 <h4 class="col-12">Informasi Website</h4>
                                 <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                       <label for="nama_situs" class="form-label">Nama Situs</label>
                                       <input value="{{ $edit ? $data->nama_situs : '' }}" type="text" id="nama_situs" name="nama_situs" class="form-control" placeholder="Nama Situs">
                                    </div>
                                 </div>
                                 <div class="mb-3 col-lg-6">
                                    <label class="form-label" for="no_wa_perusahaan">No. WA Perusahaan</label>
                                    <input type="text" class="form-control" value="{{ $edit ? $data->no_wa_perusahaan : '' }}" id="no_wa_perusahaan" name="no_wa_perusahaan" data-toggle="input-mask" data-mask-format="(00) 0000-0000-0000" placeholder="No. WA Perusahaan">
                                    <span class="font-13 text-muted">e.g "(62) xxxx-xxxx-xxxx"</span>
                                 </div>
                                 <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                       <label for="email_perusahaan" class="form-label">Email Perusahaan</label>
                                       <input value="{{ $edit ? $data->email_perusahaan : '' }}" type="text" id="email_perusahaan" name="email_perusahaan" class="form-control" placeholder="Email Perusahaan">
                                    </div>
                                 </div>
                                 <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                       <label for="no_telepon_perusahaan" class="form-label">No Telepon Perusahaan</label>
                                       <input value="{{ $edit ? $data->no_telepon_perusahaan : '' }}" type="text" id="no_telepon_perusahaan" name="no_telepon_perusahaan" class="form-control" placeholder="No Telepon Perusahaan">
                                    </div>
                                 </div>
                                 <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                       <label for="primary" class="form-label">Primary</label>
                                       <input value="{{ $edit ? $data->primary : '' }}" type="color" id="primary" name="primary" class="form-control" placeholder="Primary">
                                    </div>
                                 </div>
                                 <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                       <label for="dark" class="form-label">Dark</label>
                                       <input value="{{ $edit ? $data->dark : '' }}" type="color" id="dark" name="dark" class="form-control" placeholder="Dark">
                                    </div>
                                 </div>
                                 <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                       <label for="deskripsi_perusahaan" class="form-label">Deskripsi Perusahaan</label>
                                       <textarea name="deskripsi_perusahaan" class="form-control" id="deskripsi_perusahaan" cols="10" rows="5" placeholder="Deskripsi Perusahaan">{{ $edit ? $data->deskripsi_perusahaan : '' }}</textarea>
                                    </div>
                                 </div>
                                 <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                       <label for="slogan_perusahaan" class="form-label">Slogan Perusahaan</label>
                                       <textarea name="slogan_perusahaan" class="form-control" id="slogan_perusahaan" cols="10" rows="5" placeholder="Slogan Perusahaan">{{ $edit ? $data->slogan_perusahaan : '' }}</textarea>
                                    </div>
                                 </div>
                                 <div class="col-12">
                                    <div class="mb-5">
                                       <label for="alamat_perusahaan" class="form-label">Alamat Perusahaan</label>
                                       <textarea name="alamat_perusahaan" class="form-control" id="alamat_perusahaan" cols="10" rows="5" placeholder="Alamat Perusahaan">{{ $edit ? $data->alamat_perusahaan : '' }}</textarea>
                                    </div>
                                 </div>
                                 <hr class="bg-info w-100" style="height: 1px">
                                 <h4 class="col-12">Social Media</h4>

                                 <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                       <label for="facebook_perusahaan" class="form-label">Facebook</label>
                                       <input value="{{ $edit ? $data->facebook_perusahaan : '' }}" type="text" id="facebook_perusahaan" name="facebook_perusahaan" class="form-control" placeholder="Facebook">
                                    </div>
                                 </div>
                                 <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                       <label for="twitter_perusahaan" class="form-label">Twitter</label>
                                       <input value="{{ $edit ? $data->twitter_perusahaan : '' }}" type="text" id="twitter_perusahaan" name="twitter_perusahaan" class="form-control" placeholder="Twitter">
                                    </div>
                                 </div>
                                 <div class="col-12 col-lg-6">
                                    <div class="mb-2">
                                       <label for="instagram_perusahaan" class="form-label">Instagram</label>
                                       <input value="{{ $edit ? $data->instagram_perusahaan : '' }}" type="text" id="instagram_perusahaan" name="instagram_perusahaan" class="form-control" placeholder="Instagram">
                                    </div>
                                 </div>
                                 <hr class="bg-info w-100" style="height: 1px">
                                 <h4 class="col-12 mt-2">Gambar</h4>
                                 <div class="col-12">
                                    <div class="mb-3">
                                       <label for="logo_situs" class="form-label">Logo Situs</label>
                                       <input type="file" onchange="readURL(this)" accept=".png,.jpg,.jpeg" id="logo_situs" name="logo_situs" class="form-control">
                                       @if ($edit)
                                          <input type="hidden" id="old_logo_situs" value="{{ $data->logo_situs }}" name="old_logo_situs">
                                          <img src="{{ asset($data->logo_situs) }}" class="img-show-mini mt-2" alt="">
                                       @endif
                                    </div>
                                 </div>
                              </div>
                              <div class="col-8 col-lg-4">
                                 <button type="submit" class="btn btn-danger btn-simpan {{ $show ? 'd-none' : '' }}">Simpan</button>
                              </div>
                           </form>
                        </div>
                     </div>
                     <!-- end row-->
                  </div> <!-- end preview-->
               </div> <!-- end tab-content-->
            </div> <!-- end card-body -->
         </div> <!-- end card -->
      </div>
   </div>
   <div class="col-12 other-page"></div>
   <div class="col-12 modal-dialog"></div>
@endsection
@section('js')
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
            url: "{{ route('identitasWebStore') }}",
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
