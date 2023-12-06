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
               <input type="hidden" name="id_transaction_room" class="form-control" id="id_transaction_room" value="{{ $edit ? $data->id_transaction_room : '' }}">
               <div class="card-body row">
                  <div class="col-12 col-lg-6">
                     <table class="table table-bordered">
                        <tr>
                           <td>Name User</td>
                           <td>{{ $data->user->name }}</td>
                        </tr>
                        <tr>
                           <td>Transaction ID</td>
                           <td>{{ $data->transaction_id }}</td>
                        </tr>
                        <tr>
                           <td>Order ID</td>
                           <td>{{ $data->external_id }}</td>
                        </tr>
                        <tr>
                           <td>Gross Amount</td>
                           <td>Rp. {{ number_format($data->amount, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                           <td>Payment Type</td>
                           <td>{{ $data->payment_type }}</td>
                        </tr>
                        <tr>
                           <td>Transaction Status</td>
                           <td>{{ $data->status }}</td>
                        </tr>
                     </table>
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

      $.ajax({
         url: "{{ route('transactionRoomStore') }}",
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
   $('#room_id').select2({
      placeholder: '.:: Search Room ::.',
      ajax: {
         url: '{{ route('otherCariRoom') }}',
         dataType: 'json',
         delay: 250,
         processResults: function(data) {
            return {
               results: $.map(data, function(item) {
                  return {
                     text: `${item.name_room}`,
                     id: item.id_room
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
