@extends('user.layout.app')
@section('content')
   <form action="{{ route('createPaymentSubscription') }}" class="h-screen w-full flex justify-center items-center flex-col">
      @csrf
      <img src="{{ asset('/template-user/dist/image/payment.jpg') }}" class="w-[300px] h-auto md:w-[450px] lg:w-[550px] xl:w-[650px]" alt="">
      <button type="submit" class="bg-[#FA8B02] px-4 py-1 rounded-full text-white text-lg lg:text-xl lg:py-2 lg:px-6 font-semibold flex justify-center items-center">Check Subscription&nbsp;&nbsp;<svg class="fill-white inline" xmlns="http://www.w3.org/2000/svg" height="16" width="18"
            viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
            <path d="M64 32C28.7 32 0 60.7 0 96v32H576V96c0-35.3-28.7-64-64-64H64zM576 224H0V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V224zM112 352h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm112 16c0-8.8 7.2-16 16-16H368c8.8 0 16 7.2 16 16s-7.2 16-16 16H240c-8.8 0-16-7.2-16-16z" />
         </svg>
      </button>
   </form>
@endsection
@section('js')
@endsection
