<?php echo $__env->make('partials/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 
<?php echo $__env->make('partials/topBar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<?php echo $__env->make('partials/leftPane', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Showing All Farmers</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/<?php echo e($appName); ?>/dashboard/">Dashboard</a></li>
          <li class="breadcrumb-item">Farmers</li>
          <li class="breadcrumb-item active">All</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-8">
        <div class="card">
              <div class="card-body">
                <h5 class="card-title"></h5>
  
                <!-- Table with stripped rows -->
                <table class="table table-striped datatable">
                  <thead>
                    <tr>
                      <th scope="col">SNo</th>
                      <th scope="col">Full Name</th>
                      <th scope="col">Phone</th>
                      <th scope="col">Status</th>
                      <th scope="col">Options</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $farmers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $farmer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <th scope="row"><?php echo e($loop->iteration); ?></th>
                        <td><img src="<?php echo e($farmer['image_url']); ?>" alt="" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;"> <?php echo e($farmer['fullname']); ?></td>
                        <td><?php echo e($farmer['phone']); ?></td>
                        <td>
                          <?php if($farmer['approved'] == 0): ?>
                              <span class="badge bg-danger">Not Approved</span>
                             <?php else: ?>
                              <span class="badge bg-info">Approved</span>
                          <?php endif; ?>
                        </td>
                        <td>
                          <div class="d-flex">
                              <a href="?action=view&id=<?php echo e($farmer['id']); ?>" class="btn btn-primary btn-sm mx-1 p-1"><i class="bi bi-eye"></i></a>
                              <a href="?action=delete&id=<?php echo e($farmer['id']); ?>" class="btn btn-danger btn-sm mx-1 p-1"><i class="bi bi-trash3"></i></a>
                            </div>
                        </td>
                      </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                    
                  </tbody>
                </table>
                <!-- End Table with stripped rows -->
  
              </div>
            </div>
        </div>
        <div class="col-lg-4">
          <div style="position: sticky; top: 100px;">
              <div id="view-farmer-info-container">
                  <?php if($action == 'view'): ?>
                    <?php echo $__env->make('viewFarmer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                  <?php endif; ?>
              </div>

          </div>
        </div>

      </div>
    </section>

  </main><!-- End #main -->

  <?php echo $__env->make('partials/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>