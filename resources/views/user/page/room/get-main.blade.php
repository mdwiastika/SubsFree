@foreach ($rooms as $room)
   <div class="max-w-sm bg-white border border-gray-200 rounded-xl shadow p-3 mx-auto">
      <a href="{{ route('userRoomDetail', ['slug_room' => $room->slug_room, 'location' => request('location'), 'start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" class="">
         <img class="rounded-xl aspect-video object-cover" src="{{ asset(unserialize(base64_decode($room->photo_room))[0]) }}" alt="" />
      </a>
      <a href="{{ route('userRoomDetail', ['slug_room' => $room->slug_room, 'location' => request('location'), 'start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" class="py-5 px-2">
         <div class="flex justify-between items-center">
            <h3 class="flex-none w-52 text-xl font-light truncate" title="{{ $room->name_room }}">{{ $room->name_room }}</h3>
            <span class="text-[#FA8B02] font-normal">{{ $room->level_room }}</span>
         </div>
         <div class="flex items-center justify-start gap-2">
            <div class="max-w-[200px] flex items-center gap-2">
               <svg xmlns="http://www.w3.org/2000/svg" width="13" height="19" viewBox="0 0 15 21" fill="none">
                  <path
                     d="M7.68359 10.4193C7.02055 10.4193 6.38467 10.1559 5.91583 9.68702C5.44699 9.21818 5.18359 8.58229 5.18359 7.91925C5.18359 7.25621 5.44699 6.62032 5.91583 6.15148C6.38467 5.68264 7.02055 5.41925 7.68359 5.41925C8.34663 5.41925 8.98252 5.68264 9.45136 6.15148C9.9202 6.62032 10.1836 7.25621 10.1836 7.91925C10.1836 8.24756 10.1189 8.57265 9.99329 8.87596C9.86766 9.17927 9.68351 9.45487 9.45136 9.68702C9.21921 9.91916 8.94362 10.1033 8.6403 10.2289C8.33699 10.3546 8.0119 10.4193 7.68359 10.4193ZM7.68359 0.91925C5.82708 0.91925 4.0466 1.65675 2.73385 2.9695C1.42109 4.28226 0.683594 6.06274 0.683594 7.91925C0.683594 13.1693 7.68359 20.9193 7.68359 20.9193C7.68359 20.9193 14.6836 13.1693 14.6836 7.91925C14.6836 6.06274 13.9461 4.28226 12.6333 2.9695C11.3206 1.65675 9.54011 0.91925 7.68359 0.91925Z"
                     fill="black" fill-opacity="0.39" />
               </svg>
               <span class="text-black/[0.39] text-sm my-3 truncate" title="{{ $room->location_room }}">{{ $room->location_room }}</span>
            </div>
            <div>|</div>
            <div class="text-sm text-black/[0.39] truncate">
               {{ $room->category_room->name_category_room }}
            </div>
         </div>
         <div class="text-black/[0.50] line-clamp-3">
            {{ $room->description_room }}
         </div>
      </a>
   </div>
@endforeach
