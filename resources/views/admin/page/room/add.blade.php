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
               <input type="hidden" name="id_room" class="form-control" id="id_room" value="{{ $edit ? $data->id_room : '' }}">
               <div class="card-body row">
                  <div class="form-group col-12 col-lg-6">
                     <label for="category_room_id">Category Room</label>
                     <select name="category_room_id" class="form-control d-block" id="category_room_id">
                        @if ($edit)
                           <option value="{{ $data->category_room_id }}">{{ $data->category_room->name_category_room }}</option>
                        @endif
                     </select>
                  </div>
                  <div class="form-group col-12 col-lg-6">
                     <label for="user_id">User</label>
                     <select name="user_id" class="form-control d-block" id="user_id">
                        @if ($edit)
                           <option value="{{ $data->user_id }}">{{ $data->user->name }}</option>
                        @endif
                     </select>
                  </div>
                  <div class="form-group col-12 col-md-6">
                     <label for="name_room">Name</label>
                     <input type="text" name="name_room" class="form-control" id="name_room" value="{{ $edit ? $data->name_room : '' }}" placeholder="Name Room">
                  </div>
                  <div class="form-group col-12 col-md-6">
                     <label for="level_room">Level Room</label>
                     <select name="level_room" id="level_room" class="form-control">
                        <option value="">-- Select Level --</option>
                        <option value="Class 1" {{ $edit ? ($data->level_room == 'Class 1' ? 'selected' : '') : '' }}>Class 1</option>
                        <option value="Class 2" {{ $edit ? ($data->level_room == 'Class 2' ? 'selected' : '') : '' }}>Class 2</option>
                        <option value="Class 3" {{ $edit ? ($data->level_room == 'Class 3' ? 'selected' : '') : '' }}>Class 3</option>
                     </select>
                  </div>
                  <div class="form-group col-12">
                     <label for="photo_room">Photo Room</label>
                     <input type="file" class="form-control" multiple name="photo_room[]" onchange="readURL(this)" accept=".png,.jpg,.jpeg">
                     @if ($edit)
                        @foreach (unserialize(base64_decode($data->photo_room)) as $single_photo_room)
                           <input type="hidden" name="old_photo_room" value="{{ $data->photo_room }}">
                           <img id="gambar_photo_room" src="{{ $edit ? ($data->photo_room ? asset('/' . $single_photo_room) : 'http://placehold.it/180') : 'http://placehold.it/180' }}" class="mt-4 rounded-lg block" style="width: 200px; height: 150px; object-fit: cover;" alt="your image" />
                        @endforeach
                     @endif
                  </div>
                  <div class="form-group col-12 col-md-6">
                     <label for="location_room">Location Room</label>
                     <textarea name="location_room" class="form-control" placeholder="Location Room" id="location_room" cols="30" rows="10">{{ $edit ? $data->location_room : '' }}</textarea>
                  </div>
                  <div class="form-group col-12 col-md-6">
                     <label for="description_room">Description Room</label>
                     <textarea name="description_room" placeholder="Description Room" class="form-control" id="description_room" cols="30" rows="10">{{ $edit ? $data->description_room : '' }}</textarea>
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
         url: "{{ route('roomStore') }}",
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
   $('#category_room_id').select2({
      placeholder: '.:: Search Category Room ::.',
      ajax: {
         url: '{{ route('otherCariCategoryRoom') }}',
         dataType: 'json',
         delay: 250,
         processResults: function(data) {
            return {
               results: $.map(data, function(item) {
                  return {
                     text: `${item.name_category_room}`,
                     id: item.id_category_room
                  }
               })
            };
         },
         cache: true
      }
   });
   $('#user_id').select2({
      placeholder: '.:: Search User ::.',
      ajax: {
         url: '{{ route('otherCariUser') }}',
         dataType: 'json',
         delay: 250,
         processResults: function(data) {
            return {
               results: $.map(data, function(item) {
                  return {
                     text: `${item.name}`,
                     id: item.id
                  }
               })
            };
         },
         cache: true
      }
   });
</script>
