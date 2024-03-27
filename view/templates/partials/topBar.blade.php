<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
    <i class="bi bi-list toggle-sidebar-btn"></i>
  <a href="/{{$appName}}/dashboard/" class="logo d-flex align-items-center">
    <span class="badge" style="margin-left: 80%; background-color: #fafafa;">Kapcco Store Management System</span>
  </a>
</div><!-- End Logo -->

<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">


    <li class="nav-item dropdown pe-3">

      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <span class="d-none d-md-block dropdown-toggle pe-2">Hello, {{$username}}</span>
        <img src="{{$avator}}" alt="Profile" class="rounded-circle" width="40px" height="40px" style="object-fit: cover;">
      </a><!-- End Profile Iamge Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
          <span class="text-primary">Signed In As</span>
          <h6>{{$username}}</h6>
         
        <li>
          <hr class="dropdown-divider">
        </li>

        @if($role == 'Administrator')
          <li>
            <a class="dropdown-item d-flex align-items-center" href="/{{$appName}}/auth/user/profile/">
              <i class="bi bi-person"></i>
              <span>My Profile</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
        @endif

        <li>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <i class="bi bi-gear"></i>
            <span>Account Settings</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="/{{$appName}}/auth/sign-out/">
            <i class="bi bi-box-arrow-right"></i>
            <span>Sign Out</span>
          </a>
        </li>

      </ul><!-- End Profile Dropdown Items -->
    </li><!-- End Profile Nav -->

  </ul>
</nav><!-- End Icons Navigation -->

</header><!-- End Header -->