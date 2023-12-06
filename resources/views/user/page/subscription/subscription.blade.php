@extends('user.layout.app')
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
@section('content')
   <section class="h-screen w-full flex justify-center items-center flex-col">
      @csrf
      <h2 class="text-lg">{{ $message }}</h2>
      <button id="pay-button" class="{{ $subscription_valid ? 'hidden' : '' }} bg-[#FA8B02] px-4 py-1 rounded-full text-white text-lg lg:text-xl lg:py-2 lg:px-6 font-semibold flex justify-center items-center">Pay Now&nbsp;&nbsp;<svg class="fill-white inline" xmlns="http://www.w3.org/2000/svg" height="16" width="18"
            viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
            <path d="M64 32C28.7 32 0 60.7 0 96v32H576V96c0-35.3-28.7-64-64-64H64zM576 224H0V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V224zM112 352h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm112 16c0-8.8 7.2-16 16-16H368c8.8 0 16 7.2 16 16s-7.2 16-16 16H240c-8.8 0-16-7.2-16-16z" />
         </svg>
      </button>
   </section>
@endsection
@section('js')
   <script type="text/javascript">
      // For example trigger on button clicked, or any time you need
      var payButton = document.getElementById('pay-button');
      payButton.addEventListener('click', function() {
         // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
         window.snap.pay('{{ $snap_token }}', {
            onSuccess: function(result) {
               swal({
                  title: "Success",
                  text: 'Success Payment Membership',
                  type: "success",
                  showCancelButton: false,
                  cancelButtonText: 'Cancel',
                  confirmButtonText: 'Okayy!'
               }).then((result) => {
                  window.location.replace("{{ route('userSubscriptionUser') }}");
               });
            },
            onPending: function(result) {
               swal({
                  title: "Pending",
                  text: 'Pending Status Payment Membership',
                  type: "warning",
                  showCancelButton: false,
                  cancelButtonText: 'Cancel',
                  confirmButtonText: 'Okayy!'
               }).then((result) => {
                  window.location.replace("{{ route('userSubscriptionUser') }}");
               });
            },
            onError: function(result) {
               swal({
                  title: "Error",
                  text: 'Failed Payment Membership',
                  type: "error",
                  showCancelButton: false,
                  cancelButtonText: 'Cancel',
                  confirmButtonText: 'Huu!'
               }).then((result) => {
                  window.location.replace("{{ route('userSubscriptionUser') }}");
               });
            },
            onClose: function() {
               swal({
                  title: "Redirect",
                  text: 'Redirect on Subscription Menu',
                  type: "info",
                  showCancelButton: false,
                  cancelButtonText: 'Cancel',
                  confirmButtonText: 'Okayy!'
               }).then((result) => {
                  window.location.replace("{{ route('userSubscriptionUser') }}");
               });
            }
         })
      });
   </script>
@endsection
