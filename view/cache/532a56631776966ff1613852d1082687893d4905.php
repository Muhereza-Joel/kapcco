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
        <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add New Zone</h5>

              <!-- Vertical Form -->
              <form class="row g-3">
                <div class="col-12">
                  <label for="branch-name" class="form-label">Branch Name</label>
                  <input type="text" class="form-control p-1" id="branch-name">
                </div>
                <div class="col-12">
                  <label for="branch-location" class="form-label">Branch Location</label>
                  <input type="text" class="form-control p-1" id="branch-location">
                </div>

                <div class="col-12">
                  <label for="branch-location" class="form-label">Branch Location</label>
                  <select name="" id="branch-location" class="form-control p-1">
                    <option value="" >No brach selected</option>
                  </select>
                  
                </div>
               
                
                <div class="text-left">
                  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                  
                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>
        </div>
        
        <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Showing All Zones</h5>

              <!-- Table with stripped rows -->
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Zone Name</th>
                    <th scope="col">Zone Location</th>
                    <th scope="col">Branch</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Brandon Jacob</td>
                    <td>Designer</td>
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
                    <td>Dynamic Division Officer </td>
                    <td class="text-truncate">BDG</td>
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

  <?php echo $__env->make('partials/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>