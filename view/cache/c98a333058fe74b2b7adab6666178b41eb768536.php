<?php echo $__env->make('partials/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('partials/topBar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<?php echo $__env->make('partials/leftPane', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Manage Collections</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/<?php echo e($appName); ?>/dashboard/">Dashboard</a></li>
        <li class="breadcrumb-item">Manage Collections</li>
        <li class="breadcrumb-item active">Settings</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row g-1">
      <div class="col-lg-3 tour-step-1">

        <?php echo $__env->make('season', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


        <div class="card">
          <div class="card-body">
            <div class="card-title">Set Season of Collection</div>
            <div class="alert alert-warning alert-dismissible fade show p-1" role="alert">
              <i class="bi bi-exclamation-triangle me-1"></i>
              You can only set new dates of the season if the on going season has ended

            </div>
            <div id="add-season-success-alert" class="alert alert-success alert-dismissible fade d-none p-1" role="alert">
              <i class="bi bi-check-circle me-1"></i>
              <span></span>

            </div>
            <form id="season-form" novalidate class="row g-3 needs-validation">
              <div class="form-group">
                <label for="start-date">Start Date of Season</label>
                <input type="text" id="start-date" required class="form-control mt-2" placeholder="Choose start date" name="start-date">
                <div class="invalid-feedback">Please choose start date</div>
              </div>
              <div class="form-group mt-2">
                <label for="start-date">End Date of Season</label>
                <input type="text" id="end-date" required class="form-control mt-2" placeholder="Choose end date" name="end-date">
                <div class="invalid-feedback">Please choose end date</div>
              </div>
              <div class="my-2 tour-step-2">
                <?php if(!isset($currentSeason['id']) || $currentSeason['id'] === null): ?>
                <button type="submit" class="btn btn-primary btn-sm" id="set-season">Set current season</button>
                <?php else: ?>
                <button type="submit" class="btn btn-primary btn-sm" id="set-season" disabled>Set current season</button>
                <?php endif; ?>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card">
          <div class="card-body">
            <div class="card-title tour-step-3">Set Prices for the current season</div>
            <form id="price-scales-form" novalidate class="row g-3 needs-validation">
              <div id="add-scale-success-alert" class="alert alert-success alert-dismissible fade d-none p-1" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                <span></span>

              </div>
              <div class="form-group my-1">
                <label for="product-name">Product Name</label>
                <input name="product-name" type="text" class="form-control my-1" value="Coffee" required readonly>
                <?php if($currentSeason): ?>
                <input name="current-season-id" type="hidden" class="form-control my-1" value="<?php echo e($currentSeason['id']); ?>" required>
                <?php endif; ?>
                <div class="invalid-feedback">Please provide product name</div>
              </div>
              <div class="form-control mt-2 tour-step-4">
                <label for="product-type">Product Type</label>
                <select name="product-type" id="product-type" class="form-control" required>
                  <option value="">Select product type</option>
                  <option value="Parchment">Parchment</option>
                  <option value="Kiboko">Kiboko</option>
                  <option value="Red Cherry">Red Cherry</option>
                  <option value="FAQ">FAQ</option>
                </select>
                <div class="invalid-feedback">Please select coffee type</div>
              </div>
              <div class="form-group mt-2 tour-step-5">
                <label for="unit-price">Unit Price per Kilogram</label>
                <input name="unit-price" id="unit-price" type="number" class="form-control my-1" required>
                <div class="invalid-feedback">Please enter unit price</div>
              </div>

              <div class="my-2">
                <button type="submit" class="btn btn-primary btn-sm tour-step-6">Save Price Data</button>
              </div>

            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Price summary for the current season</h5>
            <div class="alert alert-info alert-dismissible fade show p-1" role="alert">

              These prices only apply to the current season, you have to set new prices when you start a new season
              Entering new prices updates the existing prices if previously added.
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
  </section>

</main><!-- End #main -->

<?php echo $__env->make('partials/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script>
  $(document).ready(function() {
    $("#start-date").datepicker({
      minDate: new Date(),
    })

    $("#end-date").datepicker({
      minDate: new Date(),
      maxDate: "+5M"
    })

    $("#season-form").submit(function(e) {
      e.preventDefault();

      if (this.checkValidity() === true) {
        let formData = $(this).serialize();

        $.ajax({
          method: 'post',
          url: '/kapcco/dashboard/colllections/add-season/',
          data: formData,
          success: function(response) {
            $('#add-season-success-alert').removeClass('d-none');
            $('#add-season-success-alert').addClass('show');
            $('#add-season-success-alert span').text(response.message);

            setTimeout(function() {
              window.location.reload();
            }, 2000)

          },
          error: function() {}

        })
      }

    })

    $("#price-scales-form").submit(function(e) {
      e.preventDefault();

      if (this.checkValidity() === true) {
        let formData = $(this).serialize();

        $.ajax({
          method: 'post',
          url: '/kapcco/dashboard/colllections/set-price-scale/',
          data: formData,
          success: function(response) {
            $('#add-scale-success-alert').removeClass('d-none');
            $('#add-scale-success-alert').addClass('show');
            $('#add-scale-success-alert span').text(response.message);

            setTimeout(function() {
              window.location.reload();
            }, 2000)

          },
          error: function() {}
        })
      }
    })

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

    $("#time-remaining").text('Remaining time: ' + days + ' days.')

  })
</script>

<script>
  const tour = new Shepherd.Tour({
    useModalOverlay: true,
    defaultStepOptions: {
      classes: 'shadow-md bg-purple-dark',
      scrollTo: true
    }
  });

  tour.addStep({
    id: 'step-0',
    text: '<h4><strong>Hello <?php echo e($username); ?>, Take a brief tour on how you will manage seasons and price scales for your store</strong></h4> <h6>I will guide you through a few steps to achieve this task</h6>',
    buttons: [{
      text: 'No, I already no',
      action: tour.cancel,
      classes: 'shepherd-button-secondary',
    }, {
      text: 'Yeah, Lets Start',
      action: tour.next,
    }],
  });

  tour.addStep({
    id: 'step-1',
    text: 'To record collections, set the current season if there is no season which is running. <br/> <strong>Please note that all collections are tracked basing on the current and passed seasons</strong>',
    attachTo: {
      element: 'div.tour-step-1', // Target the element you want to highlight
      on: 'bottom',
    },
    buttons: [{
      text: 'Back',
      action: tour.back,
      classes: 'shepherd-button-secondary',
    }, {
      text: 'Next',
      action: tour.next,
    }],
  });

  tour.addStep({
    id: 'step-2',
    text: 'Use this button to save the start date and end date of the new season, Note that you can only set the season once until the end date has passed. That is when you will be able to set the new season again..',
    attachTo: {
      element: 'div.tour-step-2', // Target the element you want to highlight
      on: 'bottom',
    },
    buttons: [{
      text: 'Back',
      action: tour.back,
      classes: 'shepherd-button-secondary',
    }, {
      text: 'Next',
      action: tour.next,
    }],
  });

  tour.addStep({
    id: 'step-3',
    text: 'Always set price scales for the products your store recieves. Note that setting new price scales for a product will update its scale for that season.',
    attachTo: {
      element: 'div.tour-step-3', // Target the element you want to highlight
      on: 'bottom',
    },
    buttons: [{
      text: 'Back',
      action: tour.back,
      classes: 'shepherd-button-secondary',
    }, {
      text: 'Next',
      action: tour.next,
    }],
  });

  tour.addStep({
    id: 'step-4',
    text: 'Use this dropdown to select the product then provide the unit price for the product.',
    attachTo: {
      element: 'div.tour-step-4', // Target the element you want to highlight
      on: 'bottom',
    },
    buttons: [{
      text: 'Back',
      action: tour.back,
      classes: 'shepherd-button-secondary',
    }, {
      text: 'Next',
      action: tour.next,
    }],
  });

  tour.addStep({
    id: 'step-5',
    text: 'Enter the unit price here. Note that this price is only used in the current season, when you start a new season, you have to set a new unit price',
    attachTo: {
      element: 'div.tour-step-5', // Target the element you want to highlight
      on: 'bottom',
    },
    buttons: [{
      text: 'Back',
      action: tour.back,
      classes: 'shepherd-button-secondary',
    }, {
      text: 'Next',
      action: tour.next,
    }],
  });

  tour.addStep({
    id: 'step-6',
    text: 'Click this button to save the scale. It will be used when recording collections against this product',
    attachTo: {
      element: 'button.tour-step-6', // Target the element you want to highlight
      on: 'bottom',
    },
    buttons: [{
      text: 'Back',
      action: tour.back,
      classes: 'shepherd-button-secondary',
    }, {
      text: 'Next',
      action: tour.next,
    }],
  });

  tour.addStep({
    id: 'step-7',
    text: '<h4><strong>Alright <?php echo e($username); ?>, I hope you have understood all the steps to mange seasons and scales</strong></h4> Note that depending on your role, your the only person who can set seasons and scales, always pay attension to what you are doing.',
    buttons: [{
      text: 'Back',
      action: tour.back,
      classes: 'shepherd-button-secondary',
    }, {
      text: 'Got It',
      action: function() {
        setCookie('manageCollectionTourFinished', 'true', 7); // Set cookie with expiry of 7 days
        tour.complete();
      },
    }],
  });


  


  document.addEventListener('DOMContentLoaded', function() {
    if (getCookie('manageCollectionTourFinished') === 'true') {
      tour.cancel();
    } else {
      tour.start();
    }
  });
</script>