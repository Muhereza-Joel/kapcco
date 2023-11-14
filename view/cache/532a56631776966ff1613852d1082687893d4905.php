<?php echo $__env->make('partials/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 
<?php echo $__env->make('partials/topBar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<?php echo $__env->make('partials/leftPane', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Zones</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/<?php echo e($appName); ?>/dashboard/">Dashboard</a></li>
          <li class="breadcrumb-item">Zones</li>
          <li class="breadcrumb-item active">All</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
    <div class="row">
    <div class="col-lg-9">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Showing All Zones</h5>

              <!-- Table with stripped rows -->
              <table class="table table-striped datatable">
                <thead>
                  <tr>
                    <th scope="col">SNo</th>
                    <th scope="col">Zone Name</th>
                    <th scope="col">Zone Location</th>
                    <th scope="col">Branch</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $zones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <th scope="row"><?php echo e($loop->iteration); ?></th>
                      <td><?php echo e($zone['zone_name']); ?></td>
                      <td><?php echo e($zone['zone_location']); ?></td>
                      <td>
                        <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <?php if($branch['id'] == $zone['parent_branch']): ?>
                           <?php echo e($branch['branch_name']); ?>

                           <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </td>
                      <td><span class="badge bg-success"><?php echo e($zone['status']); ?></span></td>
                      <td>
                        <div class="d-flex">
                          <a href="#" class="btn btn-primary btn-sm p-1"><i class="bi bi-pencil-square"></i></a>
                          <a href="#" class="btn btn-danger btn-sm mx-1 p-1"><i class="bi bi-trash3"></i></a>
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


        <div class="col-lg-3">
          <div style="position: sticky; top: 100px;">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Add New Zone</h5>
  
                <!-- Vertical Form -->
                <form id="add-zone-form" class="row g-3 needs-validation" novalidate>
                <div id="add-zone-success-alert" class="alert alert-success alert-dismissible fade d-none p-1" role="alert">
                      <i class="bi bi-check-circle me-1"></i>
                        <span></span>
              
                    </div>
                  <div class="col-12">
                    <label for="zone-name" class="form-label">Zone Name</label>
                    <input oninput="capitalizeEveryWord(this)" type="text" class="form-control p-1" name="zone-name" id="zone-name" required>
                    <div class="invalid-feedback">Please enter zone name.</div>
                  </div>
                  <div class="col-12">
                    <label for="zone-location" class="form-label">Zone Location</label>
                    <input oninput="capitalizeEveryWord(this)" type="text" class="form-control p-1" name="zone-location" id="zone-location" required>
                    <div class="invalid-feedback">Please enter zone location.</div>
                  </div>
  
                  <div class="col-12">
                    <label for="parent-branch" class="form-label">Parent Branch</label>
                    <select name="parent-branch" id="parent-branch" class="form-control p-1" required>
                      <option value="" >No branch selected</option>
                      <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($branch['id']); ?>"><?php echo e($branch['branch_name']); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <div class="invalid-feedback">Please enter the parent branch.</div>
                    
                  </div>
                 
                  
                  <div class="text-left">
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    
                  </div>
                </form><!-- Vertical Form -->
  
              </div>
            </div>

          </div>
        </div>
    
       
      </div>
    </section>

  </main><!-- End #main -->

  <script>
    function capitalizeFirstLetter(input) {
              input.value = input.value.charAt(0).toUpperCase() + input.value.slice(1);
    }

    function capitalizeEveryWord(input) {
            var words = input.value.split(' ');

            for (var i = 0; i < words.length; i++) {
                words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
            }

            input.value = words.join(' ');
    }
  </script>

  <?php echo $__env->make('partials/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <script>
    $(document).ready(function(){
      $('#add-zone-form').submit(function(e){
        e.preventDefault();

        if(this.checkValidity() === true){
          let formData = $(this).serialize();

          $.ajax({
            method: 'post',
            url: '/kapcco/dashboard/zones/add/',
            data: formData,
            success: function(response){

              $('#add-zone-success-alert').removeClass('d-none');
              $('#add-zone-success-alert').addClass('show');
              $('#add-zone-success-alert span').text(response.message);
                
              setTimeout(function(){
                window.location.reload();
              }, 2000)
            },
            error: function(){}
          })

        }
      })
    })
  </script>