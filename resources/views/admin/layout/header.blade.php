<nav class="main-header navbar navbar-expand" style="background-color:#F7F7FA; border:none;">
   <!-- Left navbar links -->
   <ul class="navbar-nav">
      <li class="nav-item">
         <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
   </ul>

   <!-- Right navbar links -->
   <ul class="navbar-nav ml-auto mr-3">
      <li class="nav-item">
         <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
         </a>
      </li>
      <li class="nav-item">
         <div class="btn-group">
            <button type="button" class="btn btn-info-outline dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class="fas fa-user"></i>
            </button>
            <div class="dropdown-menu">
               @if (Auth::check())
                  <a class="dropdown-item" href="{{ route('myProfile') }}" role="button">
                     My Profile
                  </a>
                  <a class="dropdown-item" onclick="logout()" href="javascript:void(0)" role="button">
                     Logout
                  </a>
               @else
                  <a class="dropdown-item" href="{{ route('login') }}" role="button">
                     Login
                  </a>
               @endif
            </div>
         </div>
      </li>
   </ul>
</nav>
