<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  
  <?php if($role == 'Administrator'): ?>
  
  <li class="nav-item">
    <a class="nav-link " href="/<?php echo e($appName); ?>/dashboard/">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li>

  <li class="nav-heading mb-3">Pages</li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="/<?php echo e($appName); ?>/dashboard/add-collection/">
      <i class="bi bi-card-list"></i>
      <span>Add Collection</span>
    </a>
  </li>
  
  
  <li class="nav-item pb-2">
    <a class="nav-link collapsed" href="/<?php echo e($appName); ?>/dashboard/collections/">
      <i class="bi bi-cart"></i>
      <span>Manage Collections</span>
    </a>
  </li>
  
  <li class="nav-item pb-2">
    <a class="nav-link collapsed" href="/<?php echo e($appName); ?>/dashboard/branches/">
      <i class="bi bi-shop-window"></i>
      <span>Branches</span>
    </a>
  </li>
  
  <li class="nav-item pb-2">
    <a class="nav-link collapsed" href="/<?php echo e($appName); ?>/dashboard/zones/">
      <i class="bi bi-shop-window"></i>
      <span>Stores</span>
    </a>
  </li>

  
  <li class="nav-item pb-2">
    <a class="nav-link collapsed" href="/<?php echo e($appName); ?>/dashboard/farmers/">
      <i class="bi bi-people"></i>
      <span>Farmers</span>
    </a>
  </li>
  
  <li class="nav-heading mb-3">Reports</li>

  <li class="nav-item pb-2">
    <a class="nav-link collapsed" href="/<?php echo e($appName); ?>/dashboard/reports/branch-store/">
      <i class="bi bi-shop-window"></i>
      <span>Branch - Store</span>
    </a>
  </li>
  
  <?php endif; ?>

  <?php if($role == 'Farmer'): ?>

  <li class="nav-heading mb-3">Pages</li>

  <li class="nav-item pb-2">
    <a class="nav-link collapsed" href="/kapcco/collections/u/my-collections/">
      <i class="bi bi-shop-window"></i>
      <span>My Collections</span>
    </a>
  </li>

  <li class="nav-item pb-2">
    <a class="nav-link collapsed" href="/kapcco/collections/info/">
      <i class="bi bi-shop-window"></i>
      <span>Collections Info</span>
    </a>
  </li>
  
    <li class="nav-item pb-2">
      <a class="nav-link collapsed" href="/kapcco/auth/user/profile/">
        <i class="bi bi-shop-window"></i>
        <span>My Profile</span>
      </a>
    </li>
  <?php endif; ?>

  



</ul>

</aside><!-- End Sidebar-->