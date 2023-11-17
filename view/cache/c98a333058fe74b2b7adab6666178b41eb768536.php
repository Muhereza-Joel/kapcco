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
      <div class="row">
        <div class="col-lg-3">
          <div class="card">
            <div class="card-body">
              <div class="card-title"></div>
              <div class="alert alert-danger fw-bold">You have not set the current season.</div>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="card-title">Set Season of Collection</div>
              <div class="alert alert-warning alert-dismissible fade show p-1" role="alert">
                <i class="bi bi-exclamation-triangle me-1"></i>
                You can only set the dates of the season only three times in the current season.
                
              </div>
              <form id="season-form" novalidate class="row g-3 needs-validation">
                <div class="form-group">
                  <label for="start-date">Start Date of Season</label>
                  <input type="text" id="start-date" required class="form-control mt-2" placeholder="Choose start date">
                  <div class="invalid-feedback">Please choose start date</div>
                </div>
                <div class="form-group mt-2">
                  <label for="start-date">End Date of Season</label>
                  <input type="text" id="end-date" required class="form-control mt-2" placeholder="Choose end date">
                  <div class="invalid-feedback">Please choose end date</div>
                </div>
                <div class="my-2">
                  <button class="btn btn-primary btn-sm" id="set-season">Set current season</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card">
            <div class="card-body">
              <div class="card-title">Set Prices for the current season</div>
              <form>
                <div class="form-group my-1">
                  <label for="product-name">Product Name</label>
                  <input type="text" class="form-control my-1" value="Coffee">
                </div>
                <div class="form-control mt-2">
                  <label for="product-name">Product Type</label>
                  <select name="" id="product-name" class="form-control">
                    <option value="">Select product type</option>
                    <option value="Parchment">Parchment</option>
                    <option value="Kiboko">Kiboko</option>
                    <option value="Red Cherry">Red Cherry</option>
                    <option value="FAQ">FAQ</option>
                  </select>
                </div>
                <div class="form-group mt-2">
                  <label for="product-name">Unit Price per Kilogram</label>
                  <input type="number" class="form-control my-1">
                </div>

                <div class="my-2">
                  <button class="btn btn-primary btn-sm">Save Price Data</button>
                </div>
                
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Price summary for the current season</h5>

              <!-- Table with stripped rows -->
              <table class="table table-striped table-responsive">
                <thead>
                  <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Type</th>
                    <th scope="col">Unit Price(UGX)</th>
                    <th scope="col">Options</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
               
                    <td>Brandon Jacob</td>
                    <td>Designer</td>
                    <td>28</td>
                    <td>2016-05-25</td>
                  </tr>
                  <tr>
                 
                    <td>Bridie Kessler</td>
                    <td>Developer</td>
                    <td>35</td>
                    <td>2014-12-05</td>
                  </tr>
                  <tr>
                
                    <td>Ashleigh Langosh</td>
                    <td>Finance</td>
                    <td>45</td>
                    <td>2011-08-12</td>
                  </tr>
                  <tr>
                 
                    <td>Angus Grady</td>
                    <td>HR</td>
                    <td>34</td>
                    <td>2012-06-11</td>
                  </tr>
                  <tr>
                  
                    <td>Raheem Lehner</td>
                    <td>Dynamic Division Officer</td>
                    <td>47</td>
                    <td>2011-04-19</td>
                  </tr>
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
    $(document).ready(function(){
      $("#start-date").datepicker({
        minDate: new Date(),
      })

      $("#end-date").datepicker({
        minDate: new Date(),
        maxDate: "+5M"
      }
      )
    })
  </script>