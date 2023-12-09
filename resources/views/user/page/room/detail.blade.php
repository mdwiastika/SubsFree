@extends('user.layout.app')
@section('content')
   <form class="min-h-screen container mx-auto mt-[90px] md:mt-[100px]" id="book-room-form">
      <a href="javascript:void(0);" onclick="window.history.back();" class="pl-6 flex justify-start items-center gap-2 mt-2 lg:mt-8 group transition mb-2 text-lg text-gray-600 max-w-[100px]">
         <svg xmlns="http://www.w3.org/2000/svg" class="fill-gray-600 group-hover:-translate-x-1 transition" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
            <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
         </svg>
         <span class="">Back</span>
      </a>
      <div class="flex flex-col lg:flex-row gap-4 lg:gap-6 p-4">
         <div class="w-full rounded-xl overflow-hidden">
            <img src="{{ asset(unserialize(base64_decode($room->photo_room))[0]) }}" class="rounded-xl w-full max-h-[500px] object-cover" alt="{{ $room->name_room }}">
            <div class="grid grid-cols-3 gap-2 mt-2">
               @foreach (collect(unserialize(base64_decode($room->photo_room)))->slice(1, 3) as $photo_room)
                  <img src="{{ asset($photo_room) }}" class="aspect-square object-cover rounded-xl" alt="{{ $room->name_room }}">
               @endforeach
            </div>
         </div>
         <div class="w-full">
            <h2 class="text-4xl font-bold">{{ $room->name_room }}</h2>
            <p class="text-black/[0.39] mt-2 text-sm">{{ $room->description_room }}</p>
            <div class="fixed bottom-0 left-0 z-20 bg-white/60 backdrop-blur-lg w-full py-4 rounded-t-lg justify-center lg:backdrop-blur-none lg:relative lg:z-0 lg:bg-transparent flex lg:justify-start gap-2 items-center mt-6">
               <button type="submit" class="btn-booking py-2 px-6 rounded-lg bg-[#FA8B02] text-white text-lg font-medium">Book Now</button>
               @php
                  $no_wa = $room->user->no_wa;
                  if (strpos($no_wa, '0') == 0) {
                      $no_wa = '62' . ltrim($no_wa, '0');
                  }
               @endphp
               <a href="https://wa.me/{{ ltrim($no_wa) }}" target="_blank" class="bg-[#DADDEB] text-black rounded-lg py-2 px-6 text-lg">Contact Owner</a>
            </div>
         </div>
      </div>
      <div class="px-4 py-4">
         {{-- <h2 class="text-xl font-semibold">Details Room</h2> --}}
         {{-- <p class="text-black/[0.39] text-sm">{{ $room->description_room }}</p> --}}
      </div>
   </form>
@endsection
@section('js')
   <script>
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
   </script>
   <script>
      function error_validate(message) {
         swal("Sorry !", message, "warning");
         $('.btn-booking').html('Book Now').removeAttr('disabled');
      }
      $('#book-room-form').on('submit', function(e) {
         e.preventDefault();
         $('.btn-booking').html('Process').attr('disabled');
         let data = new FormData();
         data.append('location', "{{ request('location') }}")
         data.append('start_date', "{{ request('start_date') }}")
         data.append('end_date', "{{ request('end_date') }}")
         $.ajax({
            url: `{{ route('userBookingRoomDetail', ['slug_room' => $room->slug_room]) }}`,
            type: 'POST',
            data: data,
            async: true,
            cache: false,
            contentType: false,
            processData: false
         }).done(function(data) {
            if (data.status == 'success') {
               swal({
                  title: "Redirect",
                  text: 'Success Booking, Redirect to History Booking',
                  type: "success",
                  showCancelButton: true,
                  cancelButtonText: 'Cancel',
                  confirmButtonText: 'Yes, Redirect me!'
               }).then((result) => {
                  window.location.replace("{{ route('historyTransaction') }}");
               });
               $('.btn-booking').html('Book Now').removeAttr('disabled');
            } else {
               return error_validate(`${data.message}`);
            }
         }).fail(function(err) {
            swal("Sorry!", err.responseJSON.message, "error");
            $('.btn-booking').html('Book Now').removeAttr('disabled');
         });
      });
   </script>
@endsection
