@include('partials/header')
 
@include('partials/topBar');

@include('partials/leftPane');

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Zones</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/{{$appName}}/dashboard/">Dashboard</a></li>
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
                      <div class="d-flex">
                        <a href="#" class="btn btn-primary btn-sm p-1"><i class="bi bi-pencil-square"></i></a>
                        <a href="#" class="btn btn-danger btn-sm mx-1 p-1"><i class="bi bi-trash3"></i></a>
                      </div>
                    </td>
                  </tr>
                  
                  
                  
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>
        </div>


        <div class="col-lg-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add New Zone</h5>

              <!-- Vertical Form -->
              <form class="row g-3">
                <div class="col-12">
                  <label for="branch-name" class="form-label">Zone Name</label>
                  <input type="text" class="form-control p-1" id="branch-name">
                </div>
                <div class="col-12">
                  <label for="branch-location" class="form-label">Zone Location</label>
                  <input type="text" class="form-control p-1" id="branch-location">
                </div>

                <div class="col-12">
                  <label for="branch-location" class="form-label">Parent Branch</label>
                  <select name="" id="branch-location" class="form-control p-1">
                    <option value="" >No branch selected</option>
                  </select>
                  
                </div>
               
                
                <div class="text-left">
                  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                  
                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>
        </div>
    
       
      </div>
    </section>

  </main><!-- End #main -->

  @include('partials/footer')