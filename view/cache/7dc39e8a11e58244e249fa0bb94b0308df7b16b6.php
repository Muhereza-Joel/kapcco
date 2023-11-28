<?php echo $__env->make('partials/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 
<?php echo $__env->make('partials/topBar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<?php echo $__env->make('partials/leftPane', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<main id="main" class="main">

<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/<?php echo e($appName); ?>/dashboard/">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-12">
      <div class="row">

        <!-- Sales Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card sales-card">

            <div class="card-body">
              <h5 class="card-title">All <span>| Branches</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-shop-window"></i>
                </div>
                <div class="ps-3">
                  <h6><?php echo e($branchesTotal); ?></h6>
        

                </div>
              </div>
            </div>

          </div>
        </div><!-- End Sales Card -->

        <!-- Revenue Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card revenue-card">

            <div class="card-body">
              <h5 class="card-title">All <span>| Stores</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-shop-window"></i>
                </div>
                <div class="ps-3">
                  <h6><?php echo e($storesTotal); ?></h6>
                  
                </div>
              </div>
            </div>

          </div>
        </div><!-- End Revenue Card -->

        <!-- Customers Card -->
        <div class="col-xxl-4 col-xl-12">

          <div class="card info-card customers-card">

            <div class="card-body">
              <h5 class="card-title">All <span>| Approved Farmers</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                  <h6><?php echo e($farmersTotal); ?></h6>
                  
                </div>
              </div>

            </div>
          </div>

        </div><!-- End Customers Card -->


      </div>
      <div class="row">
        <div class="col-lg-8">
        <div class="card" style="position: sticky; top: 50px">
                    <div class="card-body">
                        <div id="report-header" class="card-title fw-bold">Showing last <?php echo e(count($lastCollections)); ?> collections.</div>
                        <table class="table table-striped" id="reports-table">
                            <thead>
                                <tr>
                                    <th>
                                    <div class="icon">
                                    <i class="bi bi-check-square-fill"></i>
                                    
                                    </div>
        
                                    </th>
                                    <th scope="col">Client</th>
                                    <th scope="col">Branch</th>
                                    <th scope="col">Store</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $__currentLoopData = $lastCollections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $collection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                  <td><input type="checkbox" class="row-select" value="<?php echo e($collection['id']); ?>"></td>
                                  <td><img width="40px" height="40px" class="rounded-circle mx-3" src = "<?php echo e($collection['image_url']); ?>"></td>
                                  <td><?php echo e($collection['branch_name']); ?></td>
                                  <td><?php echo e($collection['zone_name']); ?></td>
                                  <td><?php echo e($collection['product_type']); ?></td>
                                  <td><?php echo e($collection['unit_price']); ?></td>
                                  <td><?php echo e($collection['quantity']); ?></td>
                                  <td><?php echo e($collection['total_amount']); ?></td>
                                  <td>
                                    <?php if($collection['payed'] == 1): ?>
                                      <span class = "badge bg-dark">Payed</span>
                                      <?php else: ?>
                                         <span class = "badge bg-danger">Not Payed</span>
                                    <?php endif; ?>
                                  </td>
                                </tr>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                    </div>
                </div>
        </div>
        <div class="col-lg-4"></div>
      </div>
    </div><!-- End Left side columns -->

  </div>
</section>

</main><!-- End #main -->

<?php echo $__env->make('partials/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>