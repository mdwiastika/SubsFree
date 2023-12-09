<!DOCTYPE html>
<html lang="en">

<head>
   <meta name="csrf-token" content="{{ csrf_token() }}" />
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
   <link rel="icon" type="image/x-icon" sizes="16x16" href="{{ $identitas_web->logo_company ? asset($identitas_web->logo_company) : asset('/template-user/dist/image/logo.png') }}">
   <title>{{ $identitas_web->name_company }} | Form Register</title>
   @vite('resources/css/app.css')
   <link rel="preconnect" href="https://fonts.googleapis.com" />
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet" />
</head>

<body class="bg-white h-screen flex items-center">
   <form class="flex h-auto justify-center items-center container mx-auto shadow-lg w-full lg:max-w-[1100px] p-5 gap-4 form-register">
      <div class="h-screen lg:h-[75vh] w-full items-start bg-white rounded-lg">
         <img src="{{ $identitas_web->logo_company ? asset($identitas_web->logo_company) : asset('/template-user/dist/image/logo.png') }}" class="w-10 mb-3 mt-7 md:mt-4 lg:mt-2" alt="" />
         <h2 class="text-4xl text-center font-bold">Create an Account</h2>
         <p class="text-[#9B9B9B] text-center mt-2">Already signed up? <a href="{{ route('login') }}" class="text-blue-600">Log in</a></p>
         <div id="form-1">
            <div class="p-4 text-[#9B9B9B]">
               <label for="name">Name</label>
               <input type="text" required name="name" id="name" class="p-1 focus:outline-none border-b border-x-0 border-t-0 block border-[#9B9B9B] w-full" />
            </div>
            <div class="p-4 text-[#9B9B9B]">
               <label for="email">Email</label>
               <input type="email" required name="email" id="email" class="p-1 focus:outline-none border-b border-x-0 border-t-0 block border-[#9B9B9B] w-full" />
            </div>
            <div class="p-4 text-[#9B9B9B]">
               <label for="no_wa">No WA</label>
               <input type="number" name="no_wa" required id="no_wa" class="p-1 focus:outline-none border-b border-x-0 border-t-0 block border-[#9B9B9B] w-full" />
            </div>
            <div class="p-4 text-[#9B9B9B]">
               <label for="password">Password</label>
               <input type="password" required name="password" id="password" class="p-1 focus:outline-none border-b border-x-0 border-t-0 block border-[#9B9B9B] w-full" />
            </div>
            <div class="p-4 text-[#9B9B9B]">
               <label for="confirm_password">Confirm Password</label>
               <input type="password" required name="confirm_password" id="confirm_password" class="p-1 focus:outline-none border-b border-x-0 border-t-0 block border-[#9B9B9B] w-full" />
            </div>
            <button type="button" class="bg-[#FA8B02] rounded-lg px-5 py-2 w-full text-white" id="btn-next-form-2">Next</button>
         </div>
         <div class="hidden" id="form-2">
            <div class="p-4 text-[#9B9B9B]">
               <label for="level_user" class="pb-2">What do you want to register us?</label>
               <select name="level_user" class="w-full h-10" id="level_user" required>
                  <option value="">Select roles</option>
                  <option value="Partner">I want to be a partner</option>
                  <option value="Regular">I want to get an online room/house</option>
               </select>
               <div class="hidden mt-4" id="input-partner">
                  <input type="file" accept=".png,.jpg" class="hidden" name="proof_authenticity" id="proof_authenticity" />
                  <div class="h-[100px] w-full p-4 border-dashed border-2 border-[#9B9B9B] mt-5 rounded-xl flex flex-col justify-center items-center" onclick="selectImage()">
                     <img src="{{ asset('/template-user/dist/image/input-file.svg') }}" alt="" class="block" />
                     <button type="button" class="border border-[#CBD0DC] py-1 px-4 rounded-full">Browse File</button>
                  </div>
               </div>
               <div class="hidden mt-4" id="input-regular">
                  <select name="level_subscription" class="w-full h-10 mb-4" id="level_subscription">
                     <option value="">Select Class</option>
                     <option value="Class 1">Class 1</option>
                     <option value="Class 2">Class 2</option>
                     <option value="Class 3">Class 3</option>
                  </select>
                  <div class="flex flex-col gap-3">
                     <div class="border border-[#FA8B02] p-3 rounded-xl">
                        <h2 class="text-lg font-bold">Class 3</h2>
                        <ul>
                           <li class="line-through">- Access First Class</li>
                           <li class="line-through">- Access Second Class</li>
                           <li>- Access Third Class</li>
                        </ul>
                     </div>
                     <div class="border border-[#FA8B02] p-3 rounded-xl">
                        <h2 class="text-lg font-bold">Class 2</h2>
                        <ul>
                           <li class="line-through">- Access First Class</li>
                           <li>- Access Second Class</li>
                           <li>- Access Third Class</li>
                        </ul>
                     </div>
                     <div class="border border-[#FA8B02] p-3 rounded-xl">
                        <h2 class="text-lg font-bold">Class 1</h2>
                        <ul>
                           <li>- Access First Class</li>
                           <li>- Access Second Class</li>
                           <li>- Access Third Class</li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <button type="submit" class="bg-[#FA8B02] rounded-lg px-5 py-2 w-full text-white btn-register" id="btn-next-form-2">Create Account</button>
         </div>
      </div>
      <img src="{{ asset('/template-user/dist/image/daftar-banner.png') }}" class="hidden lg:block h-[75vh] w-auto" alt="" />
   </form>
   <script src="{{ asset('template-admin/plugins/jquery/jquery.min.js') }}"></script>
   <script src="{{ asset('vendors/sweetalert/sweetalert2.js') }}"></script>
   <script type="text/javascript">
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
   </script>
   <script>
      let form1 = document.getElementById("form-1");
      let form2 = document.getElementById("form-2");
      let btn_next_form_2 = document.getElementById("btn-next-form-2");
      let level_user = document.getElementById("level_user");
      let proof_authenticity = document.getElementById("proof_authenticity");
      let input_regular = document.getElementById("input-regular");
      let input_partner = document.getElementById("input-partner");
      btn_next_form_2.addEventListener("click", (ev) => {
         let name = document.getElementById("name");
         let email = document.getElementById("email");
         let no_wa = document.getElementById("no_wa");
         let password = document.getElementById("password");
         let confirm_password = document.getElementById("confirm_password");
         if (!name.value) {
            return swal("Sorry", "Name Must be Filled", "warning");
         }
         if (!email.value) {
            return swal("Sorry", "Email Must be Filled", "warning");
         }
         if (!no_wa.value) {
            return swal("Sorry", "No Wa Must be Filled", "warning");
         }
         if (!password.value) {
            return swal("Sorry", "Password Must be Filled", "warning");
         }
         if (!confirm_password.value) {
            return swal("Sorry", "Confirm Password Must be Filled", "warning");
         }
         if (confirm_password.value != password.value) {
            return swal("Sorry", "Password does not Match");
         }
         form1.classList.add("hidden");
         form2.classList.remove("hidden");
      });
      level_user.addEventListener("change", (ev) => {
         if (ev.target.value == "Partner") {
            input_partner.classList.remove("hidden");
            input_regular.classList.add("hidden");
         } else if (ev.target.value == "Regular") {
            input_regular.classList.remove("hidden");
            input_partner.classList.add("hidden");
         } else {
            input_partner.classList.add("hidden");
            input_regular.classList.add("hidden");
         }
      });

      function selectImage() {
         proof_authenticity.click();
      }
   </script>
   <script>
      @if (session()->has('status'))
         swal("Done", '{{ session('status') }}', '{{ session('type') }}');
      @endif
      $('.form-register').submit(function(e) {
         e.preventDefault();
         var button = $('.btn-register');
         var data = $('.form-register').serialize();
         button.html('Loading...').attr('disabled', true);
         $.post("{{ route('postRegister') }}", data).done(function(data) {
            button.html('Create Account').removeAttr('disabled');
            if (data.status == 'success') {
               swal({
                  title: "Redirect",
                  text: 'Success Create Account. Redirect to Login Form',
                  type: "success",
                  showCancelButton: false,
                  cancelButtonText: 'Cancel',
                  confirmButtonText: 'Yes, Redirect me!'
               }).then((result) => {
                  window.location.replace("{{ route('login') }}");
               });
            } else if (data.status == 'error' || data.status == 'warning') {
               swal('Maaf', data.message, data.status);
               form1.classList.remove("hidden");
               form2.classList.add("hidden");
            } else {
               button.animateCss('shake');
               form1.classList.remove("hidden");
               form2.classList.add("hidden");
            }
         }).fail(function() {
            swal("Sorry !", "An Error Occurred, Please Try Again !!", "warning");
            button.html('Register').removeAttr('disabled');
         });
      });
   </script>
</body>

</html>
