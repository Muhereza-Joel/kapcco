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
        <div class="col-lg-4">
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
        
        <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Showing All Branches</h5>

              <!-- Table with stripped rows -->
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Branch Name</th>
                    <th scope="col">Branch Location</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Brandon Jacob</td>
                    <td>Designer</td>
                    <td><span class="badge bg-success">open</span></td>
                    <td>
                      <a href="#" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></a>
                      <a href="#" class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Bridie Kessler</td>
                    <td>Developer</td>
                    <td><span class="badge bg-success">open</span></td>
                    <td>
                    <a href="#" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></a>
                      <a href="#" class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Ashleigh Langosh</td>
                    <td>Finance</td>
                    <td><span class="badge bg-success">open</span></td>
                    <td>
                    <a href="#" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></a>
                      <a href="#" class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">4</th>
                    <td>Angus Grady</td>
                    <td>HR</td>
                    <td><span class="badge bg-success">open</span></td>
                    <td>
                      <a href="#" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></a>
                      <a href="#" class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">5</th>
                    <td>Raheem Lehner</td>
                    <td>Dynamic Division Officer</td>
                    <td><span class="badge bg-success">open</span></td>
                    <td>
                      <a href="#" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></a>
                      <a href="#" class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i></a>
                    </td>
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

      $('#create-branch-form').submit(function(e){

        e.preventDefault();

        if(this.checkValidity() === true){

          let formData = $(this).serialize();
  
          $.ajax({
            method:'post',
            url: '/kapcco/dashboard/farmers/add/',
            data: formData,
            success: function(response){
              if(response.status === 200){
                $('#add-branch-success-alert').removeClass('d-none');
                $('#add-branch-success-alert').addClass('show');
                $('#add-branch-success-alert span').text(response.message);
    
                setTimeout(function(){
                  // window.location.reload();
                }, 2000)
  
              }
            },
            error: function(){}
          })
        }

      })

    })
  </script>