@include('partials/header')
 
@include('partials/topBar');

@include('partials/leftPane');

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Showing All Farmers</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/{{$appName}}/dashboard/">Dashboard</a></li>
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
                    @foreach($farmers as $farmer)
                      <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td><img src="{{$farmer['image_url']}}" alt="" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;"> {{$farmer['fullname']}}</td>
                        <td>{{$farmer['phone']}}</td>
                        <td>
                          @if($farmer['approved'] == 0)
                              <span class="badge bg-danger">Not Approved</span>
                             @else
                              <span class="badge bg-info">Approved</span>
                          @endif
                        </td>
                        <td>
                          <div class="d-flex">
                              <a href="?action=view&id={{$farmer['id']}}" class="btn btn-primary btn-sm mx-1 p-1"><i class="bi bi-eye"></i></a>
                              <a href="?action=delete&id={{$farmer['id']}}" class="btn btn-danger btn-sm mx-1 p-1"><i class="bi bi-trash3"></i></a>
                            </div>
                        </td>
                      </tr>
                    @endforeach
                    
                    
                  </tbody>
                </table>
                <!-- End Table with stripped rows -->
  
              </div>
            </div>
        </div>
        <div class="col-lg-4">
          <div style="position: sticky; top: 100px;">
              <div id="view-farmer-info-container">
                  @if($action == 'view')
                    @include('viewFarmer')
                  @endif
              </div>

          </div>
        </div>

      </div>
    </section>

  </main><!-- End #main -->

  @include('partials/footer')