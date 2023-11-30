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
                                 <h4 class="col-12">Website Information</h4>
                                 <div class="col-12">
                                    <div class="mb-3">
                                       <label for="logo_company" class="form-label">Logo Company</label>
                                       <input type="file" onchange="readURL(this)" accept=".png,.jpg,.jpeg" id="logo_company" name="logo_company" class="form-control">
                                       @if ($edit)
                                          <input type="hidden" id="old_logo_company" value="{{ $data->logo_company }}" name="old_logo_company">
                                          <img src="{{ asset($data->logo_company) }}" class="img-show-mini mt-2" alt="">
                                       @endif
                                    </div>
                                 </div>
                                 <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                       <label for="name_company" class="form-label">Name Company</label>
                                       <input value="{{ $edit ? $data->name_company : '' }}" type="text" id="name_company" name="name_company" class="form-control" placeholder="Name Company">
                                    </div>
                                 </div>
                                 <div class="mb-3 col-lg-6">
                                    <label class="form-label" for="no_wa_company">No. WA Company</label>
                                    <input type="text" class="form-control" value="{{ $edit ? $data->no_wa_company : '' }}" id="no_wa_company" name="no_wa_company" data-toggle="input-mask" data-mask-format="(00) 0000-0000-0000" placeholder="No. WA Company">
                                    <span class="font-13 text-muted">e.g "(62) xxxx-xxxx-xxxx"</span>
                                 </div>
                                 <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                       <label for="email_company" class="form-label">Email Company</label>
                                       <input value="{{ $edit ? $data->email_company : '' }}" type="email" id="email_company" name="email_company" class="form-control" placeholder="Email Company">
                                    </div>
                                 </div>
                                 <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                       <label for="video_company" class="form-label">Link Video YT Company</label>
                                       <input value="{{ $edit ? $data->video_company : '' }}" type="text" id="video_company" name="video_company" class="form-control" placeholder="Link Video YT Company">
                                    </div>
                                 </div>
                                 <div class="col-12">
                                    <div class="mb-5">
                                       <label for="address_company" class="form-label">Address Company</label>
                                       <textarea name="address_company" class="form-control" id="address_company" cols="10" rows="5" placeholder="Address Company">{{ $edit ? $data->address_company : '' }}</textarea>
                                    </div>
                                 </div>
                                 <hr class="bg-info w-100" style="height: 1px">
                                 <h4 class="col-12">Social Media</h4>

                                 <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                       <label for="facebook_company" class="form-label">Facebook</label>
                                       <input value="{{ $edit ? $data->facebook_company : '' }}" type="text" id="facebook_company" name="facebook_company" class="form-control" placeholder="Facebook">
                                    </div>
                                 </div>
                                 <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                       <label for="twitter_company" class="form-label">Twitter</label>
                                       <input value="{{ $edit ? $data->twitter_company : '' }}" type="text" id="twitter_company" name="twitter_company" class="form-control" placeholder="Twitter">
                                    </div>
                                 </div>
                                 <div class="col-12 col-lg-6">
                                    <div class="mb-2">
                                       <label for="instagram_company" class="form-label">Instagram</label>
                                       <input value="{{ $edit ? $data->instagram_company : '' }}" type="text" id="instagram_company" name="instagram_company" class="form-control" placeholder="Instagram">
                                    </div>
                                 </div>
                                 <hr class="bg-info w-100" style="height: 1px">
                                 <h4 class="col-12">Banner Homepage</h4>
                                 <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                       <label for="title_banner_company" class="form-label">Title Company</label>
                                       <input value="{{ $edit ? $data->title_banner_company : '' }}" type="text" id="title_banner_company" name="title_banner_company" class="form-control" placeholder="Title Company">
                                    </div>
                                 </div>
                                 <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                       <label for="banner_company" class="form-label">Banner Company</label>
                                       <input type="file" onchange="readURL(this)" accept=".png,.jpg,.jpeg" id="banner_company" name="banner_company" class="form-control">
                                       @if ($edit)
                                          @if ($data->banner_company)
                                             <input type="hidden" id="old_banner_company" value="{{ $data->banner_company }}" name="old_banner_company">
                                             <img src="{{ asset($data->banner_company) }}" class="img-show-mini mt-2" alt="">
                                          @endif
                                       @endif
                                    </div>
                                 </div>
                                 <hr class="bg-info w-100" style="height: 1px">
                                 <h4 class="col-12">Payment/Class</h4>
                                 <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                       <label for="payment_class_1" class="form-label">Class 1</label>
                                       <input value="{{ $edit ? $data->payment_class_1 : '' }}" type="text" id="payment_class_1" name="payment_class_1" class="form-control" placeholder="Class 1">
                                    </div>
                                 </div>
                                 <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                       <label for="payment_class_2" class="form-label">Class 2</label>
                                       <input value="{{ $edit ? $data->payment_class_2 : '' }}" type="text" id="payment_class_2" name="payment_class_2" class="form-control" placeholder="Class 2">
                                    </div>
                                 </div>
                                 <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                       <label for="payment_class_3" class="form-label">Class 3</label>
                                       <input value="{{ $edit ? $data->payment_class_3 : '' }}" type="text" id="payment_class_3" name="payment_class_3" class="form-control" placeholder="Class 3">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-8 col-lg-4">
                                 <button type="submit" class="btn btn-danger btn-simpan {{ $show ? 'd-none' : '' }}">Save</button>
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
         swal("Success !", message, "warning");
         $('.btn-simpan').html('Save').removeAttr('disabled');
      }

      $('.btn-simpan').click((e) => {
         e.preventDefault();
         $('.btn-simpan').html('Proses Save').attr('disabled', true);
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
                  swal('Success', data.message, 'success');
                  $('.btn-simpan').html('Simpan').attr('disabled', false);
               } else {
                  return error_validate(`${data.message}`);
               }
            }
         }).fail(function() {
            return error_validate('An Error Occurred, Please Try Again !!');
         });
      }
   </script>>
@endsection
