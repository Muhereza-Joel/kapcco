<?php echo $__env->make('partials/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 
<?php echo $__env->make('partials/topBar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<?php echo $__env->make('partials/leftPane', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Branches</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/<?php echo e($appName); ?>/dashboard/">Dashboard</a></li>
          <li class="breadcrumb-item">Branches</li>
          <li class="breadcrumb-item active">All</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        
        
        <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Showing All Branches</h5>

              <!-- Table with stripped rows -->
              <table class="table table-striped data">
                <thead>
                  <tr>
                    <th scope="col">SNo</th>
                    <th scope="col">Branch Name</th>
                    <th scope="col">Branch Location</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <th scope="row"><?php echo e($loop->iteration); ?></th>
                      <td><?php echo e($branch['branch_name']); ?></td>
                      <td><?php echo e($branch['branch_location']); ?></td>
                      <td><span class="badge bg-success"><?php echo e($branch['status']); ?></span></td>
                      <td>
                        <div class="d-flex">
                        <a href="?action=edit&id=<?php echo e($branch['id']); ?>" class="btn btn-secondary btn-sm p-1"><i class="bi bi-pencil-square"></i></a>
                        <a href="#" class="btn btn-danger btn-sm p-1 mx-1"><i class="bi bi-trash3"></i></a>
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

          <div>
            <div id="update-form-container">
                <!-- begin update form -->
                <?php if($action == 'edit'): ?>
                  <?php echo $__env->make('editBranch', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
                <!-- end update form -->

              </div>

              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Add New Branch</h5>
    
                  <!-- Vertical Form -->
                  <form class="needs-validation" novalidate id="create-branch-form" class="row g-3">
                  <div id="add-branch-success-alert" class="alert alert-success alert-dismissible fade d-none p-1" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                      <span></span>
            
                  </div>
                    <div class="col-12">
                      <label for="branch-name" class="form-label">Branch Name</label>
                      <input oninput="capitalizeEveryWord(this)" name="branch-name" type="text" class="form-control" id="branch-name" placeholder="Enter branch name" required>
                      <div class="invalid-feedback">Please enter the branch name.</div>
                    </div>
                    <div class="col-12">
                      <label for="branch-location" class="form-label">Branch Location</label>
                      <input oninput="capitalizeEveryWord(this)" type="text" name="branch-location" class="form-control" id="branch-location" placeholder="Enter branch location" required>
                      <div class="invalid-feedback">Please enter the branch location.</div>
                    </div>
                    
                    
                    <div class="text-left mt-3">
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

      $('#update-branch-form').submit(function(e){
          event.preventDefault();

          if(this.checkValidity() === true){
            let formData = $(this).serialize();

            $.ajax({
              method: 'post',
              url: '/kapcco/dashboard/farmers/edit/',
              data: formData,
              success: function(response){
                $('#edit-branch-success-alert').removeClass('d-none');
                $('#edit-branch-success-alert').addClass('show');
                $('#edit-branch-success-alert span').text(response.message);

                setTimeout(function(){
                  window.location.reload();
                }, 2000)
              },
              error: function(){}
            })
          }
      })

      $('#create-branch-form').submit(function(e){

        e.preventDefault();

        if(this.checkValidity() === true){

          let formData = $(this).serialize();
  
          $.ajax({
            method:'post',
            url: '/kapcco/dashboard/farmers/add/',
            data: formData,
            success: function(response){
              
                $('#add-branch-success-alert').removeClass('d-none');
                $('#add-branch-success-alert').addClass('show');
                $('#add-branch-success-alert span').text(response.message);
                
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