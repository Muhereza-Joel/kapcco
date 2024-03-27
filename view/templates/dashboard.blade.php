@include('partials/header')

@include('partials/topBar');

@include('partials/leftPane');

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/{{$appName}}/dashboard/">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">

        <div class="row">

          @if($role == 'Administrator')
          <!-- Sales Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">

              <div class="card-body">
                <h5 class="card-title">All <span>| Branches</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-shop-window"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{$branchesTotal}}</h6>


                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Sales Card -->
          @endif

          @if($role == 'Administrator')
          <!-- Stores Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">

              <div class="card-body">
                <h5 class="card-title">All <span>| Stores</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-shop-window"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{$storesTotal}}</h6>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Stores Card -->
          @endif

          @if($role == 'Administrator')
          <!-- Customers Card -->
          <div class="col-xxl-4 col-xl-12">

            <div class="card info-card customers-card">

              <div class="card-body">
                <h5 class="card-title">All <span>| Approved Farmers</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{$farmersTotal}}</h6>

                  </div>
                </div>

              </div>
            </div>

          </div><!-- End Customers Card -->
          @endif


        </div>
        <div class="row">

          <div class="col-lg-9">

            @if($role == 'Administrator')

            <div class="card" style="position: sticky; top: 50px">
              <div class="card-body">
                <div id="report-header" class="card-title fw-bold">Showing last {{count($lastCollections)}} collections.</div>
                <table class="table table-striped" id="reports-table">
                  <thead>
                    <tr>
                      <th>
                        <div class="icon">
                          <i class="bi bi-check-square-fill"></i>

                        </div>

                      </th>
                      <th scope="col">Client</th>
                      <th scope="col">Branch</th>
                      <th scope="col">Store</th>
                      <th scope="col">Product</th>
                      <th scope="col">Unit Price</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Total</th>
                      <th scope="col">Status</th>
                      <th scope="col">Added On</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($lastCollections as $collection)
                    <tr>
                      <td><input type="checkbox" class="row-select" value="{{$collection['id']}}"></td>
                      <td><img width="40px" height="40px" class="rounded-circle mx-3" src="{{$collection['image_url']}}"></td>
                      <td>{{$collection['branch_name']}}</td>
                      <td>{{$collection['zone_name']}}</td>
                      <td>{{$collection['product_type']}}</td>
                      <td>{{$collection['unit_price']}}</td>
                      <td>{{$collection['quantity']}}</td>
                      <td>{{$collection['total_amount']}}</td>
                      <td>
                        @if($collection['payed'] == 1)
                        <span class="badge bg-dark">Payed</span>
                        @else
                        <span class="badge bg-danger">Not Payed</span>
                        @endif
                      </td>
                      <td>{{$collection['created_at']}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>

              </div>
            </div>

            @endif
          </div>
          <div class="col-lg-4"></div>
        </div>
      </div><!-- End Left side columns -->

    </div>
  </section>

</main><!-- End #main -->

@include('partials/footer')