<aside class="main-sidebar sidebar-light-primary" style="box-shadow: rgb(149 157 165 / 20%) 0px 0px 25px;">
   <!-- Brand Logo -->
   <a href="{{ route('dashboard') }}" class="brand-link" style="border: none;">
      <img src="{{ $identitas_web->logo_company ? asset('/' . $identitas_web->logo_company) : asset('/template-admin/dist/img/favicon.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-1" style="opacity: .8">
      <span class="brand-text font-weight-light" style="color: #A2A2A2; font-size:15px;">
         @php
            $tulisan_logo = explode(' ', $identitas_web->name_company);
            foreach ($tulisan_logo as $key => $single_tulisan_logo) {
                if ($key == 0) {
                    echo "<b style='color:#107AAE'>$single_tulisan_logo</b>";
                } else {
                    echo "$single_tulisan_logo";
                }
            }
         @endphp
      </span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="border: none;">
         <div class="image">
            @if (Auth::check())
               <img src="{{ asset('/template-admin/dist/img/user.png') }}" class="" style="border-radius: 50%; width: 2.3rem; height: 2.3rem" alt="User Image">
            @else
               <img src="{{ asset('/template-admin/dist/img/user.png') }}" class="" style="border-radius: 50%; width: 2.3rem; height: 2.3rem" alt="User Image">
            @endif
         </div>
         <div class="info">
            @if (Auth::check())
               <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            @else
               <a href="#" class="d-block">Tamu</a>
            @endif
         </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
               <a href="{{ route('dashboard') }}" class="nav-link {{ $menu == 'dashboard' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-landmark"></i>
                  <p>Dashboard</p>
               </a>
            </li>
            @if (Auth::check())
               @if (in_array(Auth::user()->level_user, ['Super Admin', 'Admin']))
                  <li class="nav-header">DATA MASTER</li>
                  <li class="nav-item">
                     <a href="{{ route('users') }}" class="nav-link {{ $menu == 'user' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Pengguna</p>
                     </a>
                  </li>
               @endif
            @endif
         </ul>
      </nav>
      <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
</aside>
