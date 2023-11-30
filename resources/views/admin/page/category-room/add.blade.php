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
               <input type="hidden" name="id_category_room" class="form-control" id="id_category_room" value="{{ $edit ? $data->id_category_room : '' }}">
               <div class="card-body row">
                  <div class="form-group col-12 col-md-6">
                     <label for="name_category_room">Name</label>
                     <input type="text" name="name_category_room" class="form-control" id="name_category_room" value="{{ $edit ? $data->name_category_room : '' }}" placeholder="Name Category Room">
                  </div>
                  <div class="form-group col-12 col-md-6">
                     <label for="icon_category_room">Icon Category Room</label>
                     <input type="file" class="form-control" name="icon_category_room" onchange="readURL(this)" accept=".png,.jpg,.jpeg">
                     @if ($edit)
                        @if ($data->icon_category_room)
                           <input type="hidden" id="old_icon_category_room" value="{{ $data->icon_category_room }}" name="old_icon_category_room">
                           <img src="{{ asset($data->icon_category_room) }}" class="img-show mt-2" alt="">
                        @endif
                     @endif
                  </div>
               </div>
               <!-- /.card-body -->

               <div class="card-footer">
                  <a href="javascript:void(0)" class="btn btn-warning" onclick="kembali()">Back</a>
                  @if (!$show)
                     <button type="submit" class="btn btn-primary btn-simpan">Save</button>
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
      swal("Sorry !", message, "warning");
      $('.btn-simpan').html('Save').removeAttr('disabled');
   }

   $('.btn-simpan').click((e) => {
      e.preventDefault();
      $('.btn-simpan').html('Proses Save').attr('disabled', true);
      var data = new FormData($('.form-data')[0]);
      var id = $('input[name=id]').val();
      var nama = $('input[name=nama]').val();
      var username = $('input[name=username]').val();
      var email = $('input[name=email]').val();
      var password = $('input[name=password]').val();
      var level_user = $('#level_user').val();

      $.ajax({
         url: "{{ route('categoryRoomStore') }}",
         type: 'POST',
         data: data,
         async: true,
         cache: false,
         contentType: false,
         processData: false,
         success: function(data) {
            if (data.status == 'success') {
               swal('Success', data.message, 'success');
               kembali()
               datagrid.reload();
            } else {
               return error_validate(`${data.message}`);
            }
         }
      }).fail(function() {
         return error_validate('An Error Occurred, Please Try Again !!');
      });
   })
</script>
