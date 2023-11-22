<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar" style="background-color: rgb(117, 23, 9);">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="/{{$appName}}/dashboard/">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li>

  @if($role == 'Administrator')
  <li class="nav-heading mb-3">Pages</li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="/{{$appName}}/dashboard/add-collection/">
      <i class="bi bi-card-list"></i>
      <span>Add Collection</span>
    </a>
  </li>
  
  
  <li class="nav-item pb-2">
    <a class="nav-link collapsed" href="/{{$appName}}/dashboard/collections/">
      <i class="bi bi-cart"></i>
      <span>Manage Collections</span>
    </a>
  </li>
  
  <li class="nav-item pb-2">
    <a class="nav-link collapsed" href="/{{$appName}}/dashboard/branches/">
      <i class="bi bi-shop-window"></i>
      <span>Branches</span>
    </a>
  </li>
  
  <li class="nav-item pb-2">
    <a class="nav-link collapsed" href="/{{$appName}}/dashboard/zones/">
      <i class="bi bi-shop-window"></i>
      <span>Stores</span>
    </a>
  </li>

  
  <li class="nav-item pb-2">
    <a class="nav-link collapsed" href="/{{$appName}}/dashboard/farmers/">
      <i class="bi bi-people"></i>
      <span>Farmers</span>
    </a>
  </li>
  
  <li class="nav-heading mb-3">Reports</li>

  <li class="nav-item pb-2">
    <a class="nav-link collapsed" href="/{{$appName}}/dashboard/reports/branch-store/">
      <i class="bi bi-shop-window"></i>
      <span>Branch - Store</span>
    </a>
  </li>
  
  @endif

</ul>

</aside><!-- End Sidebar-->