<?php echo $__env->make('partials/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('partials/topBar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<?php echo $__env->make('partials/leftPane', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<main id="main" class="main">
  <div class="row">
    <div class="col-lg-4">
      <?php echo $__env->make('season', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

      <div class="card">
        <div class="card-body">
          <div class="card-title">Your Stores</div>
          <div class="alert alert-info p-2">
            All stores assigned to you will appear in the table below, when recording collections,
            your name will be found under these stores.
          </div>
          <table id="assignments-to-drop-table" class="table table-striped">

            <thead>
              <tr>

                <th scope="col">Store Name</th>
                <th scope="col">Parent Branch</th>

              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $assignedStores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($store['zone_name']); ?></td>
                <td><?php echo e($store['branch_name']); ?></td>

              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>
          </table>

        </div>
      </div>
    </div>

    <div class="col-lg-8">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Price summary for the current season</h5>
          <div class="alert alert-info alert-dismissible fade show p-1" role="alert">

            These prices only apply to the current season, new prices will be set when a new season starts.
            Also these prices can change during the season.
          </div>
          <!-- Table with stripped rows -->
          <table class="table table-striped table-responsive">
            <thead>
              <tr>
                <th scope="col">Product</th>
                <th scope="col">Type / Category</th>
                <th scope="col">Unit Price(UGX) /kg</th>

              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $scales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>

                <td><?php echo e($scale['product_name']); ?></td>
                <td><?php echo e($scale['product_type']); ?></td>
                <td><?php echo e($scale['unit_price']); ?></td>

              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            </tbody>
          </table>
          <!-- End Table with stripped rows -->

        </div>
      </div>
    </div>
  </div>
</main><!-- End #main -->


<?php echo $__env->make('partials/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script>
  $(document).ready(function() {
    const seasonEndDate = $("#set-season-end-date").val();

    let startDate = moment(new Date());
    let endDate = moment(seasonEndDate);

    // Calculate the difference in milliseconds
    let duration = moment.duration(endDate.diff(startDate));

    // Format and display the remaining time
    let days = Math.floor(duration.asDays());
    let hours = duration.hours();
    let minutes = duration.minutes();
    let seconds = duration.seconds();

    $("#time-remaining").text('Remaining time: ' + days + ' days and ' + hours + ' hours')
  })
</script>