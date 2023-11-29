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
                     <label for="level_user">Level</label>
                     <select name="level_user" id="level_user" class="form-control">
                        <option value="" selected disabled>-- Select Level --</option>
                        @if (Auth::user()->level_user == 'Super Admin')
                           <option value="Admin" {{ $edit ? ($data->level_user == 'Admin' ? 'selected' : '') : '' }}>
                              Admin
                           </option>
                        @endif
                        <option value="Partner" {{ $edit ? ($data->level_user == 'Partner' ? 'selected' : '') : '' }}>
                           Partner
                        </option>
                        <option value="Regular" {{ $edit ? ($data->level_user == 'Regular' ? 'selected' : '') : '' }}>
                           Regular
                        </option>
                     </select>
                  </div>
                  <div class="form-group col-12 col-md-6">
                     <label for="level_subscription">Subcription User</label>
                     <select name="level_subscription" id="level_subscription" class="form-control">
                        <option value="">-- Select Subcription --</option>
                        <option value="Class 1" {{ $edit ? ($data->level_subscription == 'Class 1' ? 'selected' : '') : '' }}>Class 1</option>
                        <option value="Class 2" {{ $edit ? ($data->level_subscription == 'Class 2' ? 'selected' : '') : '' }}>Class 2</option>
                        <option value="Class 3" {{ $edit ? ($data->level_subscription == 'Class 3' ? 'selected' : '') : '' }}>Class 3</option>
                     </select>
                  </div>
                  <div class="form-group col-12 col-md-6">
                     <label for="status_user">Status User</label>
                     <select name="status_user" id="status_user" class="form-control">
                        <option value="">-- Select Status --</option>
                        <option value="Active" {{ $edit ? ($data->status_user == 'Active' ? 'selected' : '') : '' }}>Active</option>
                        <option value="Non-Active" {{ $edit ? ($data->status_user == 'Non-Active' ? 'selected' : '') : '' }}>Non-Active</option>
                     </select>
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
