@include('partials/header')
 
@include('partials/topBar');

@include('partials/leftPane');

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Manage Collections</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/{{$appName}}/dashboard/">Dashboard</a></li>
          <li class="breadcrumb-item">Manage Collections</li>
          <li class="breadcrumb-item active">Settings</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-3">

        @if(!$currentSeason['id'])

          <div class="card">
            <div class="card-body">
              <div class="card-title"></div>
              <div class="alert alert-danger fw-bold">You have not set the current season.</div>
            </div>
          </div>
          @else
          <div class="card">
            <div class="card-body">
              <div class="card-title">Current Season</div>
              <div class="form-group">
                <label for="" class="label fw-bold">Runs From</label>
                <input id="set-season-start-date" type="text" value="{{$currentSeason['start_date']}}" class="form-control text-dark" readonly>
              </div>
              <div class="form-group my-3">
                <label for="" class="label fw-bold">Up To</label>
                <input id="set-season-end-date" type="text" value="{{$currentSeason['end_date']}}" class="form-control text-danger" readonly>
              </div>

              <div id="time-remaining" class="badge bg-dark"></div>
            </div>
          </div>

        @endif

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
                <div class="my-2">
                @if(!$currentSeason['id'])
                <button type="submit" class="btn btn-primary btn-sm" id="set-season">Set current season</button>
                @else
                <button type="submit" class="btn btn-primary btn-sm" id="set-season" disabled>Set current season</button>
                @endif
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card">
            <div class="card-body">
              <div class="card-title">Set Prices for the current season</div>
              <form id="price-scales-form" novalidate class="row g-3 needs-validation">
              <div id="add-scale-success-alert" class="alert alert-success alert-dismissible fade d-none p-1" role="alert">
                      <i class="bi bi-check-circle me-1"></i>
                        <span></span>
              
              </div>
                <div class="form-group my-1">
                  <label for="product-name">Product Name</label>
                  <input name="product-name" type="text" class="form-control my-1" value="Coffee" required>
                  <input name="current-season-id" type="hidden" class="form-control my-1" value="{{$currentSeason['id']}}" required>
                  <div class="invalid-feedback">Please provide product name</div>
                </div>
                <div class="form-control mt-2">
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
                <div class="form-group mt-2">
                  <label for="unit-price">Unit Price per Kilogram</label>
                  <input name="unit-price" id="unit-price" type="number" class="form-control my-1" required>
                  <div class="invalid-feedback">Please enter unit price</div>
                </div>

                <div class="my-2">
                  <button type="submit" class="btn btn-primary btn-sm">Save Price Data</button>
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
                  @foreach($scales as $scale)
                    <tr>
                      
                      <td>{{$scale['product_name']}}</td>
                      <td>{{$scale['product_type']}}</td>
                      <td>{{$scale['unit_price']}}</td>
                      
                    </tr>
                  @endforeach
                  
                  
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  @include('partials/footer')

  <script>
    $(document).ready(function(){
      $("#start-date").datepicker({
        minDate: new Date(),
      })

      $("#end-date").datepicker({
        minDate: new Date(),
        maxDate: "+5M"
      })

      $("#season-form").submit(function(e){
        e.preventDefault();

        if(this.checkValidity() === true){
          let formData = $(this).serialize();

          $.ajax({
            method: 'post',
            url: '/kapcco/dashboard/colllections/add-season/',
            data: formData,
            success: function(response){
              $('#add-season-success-alert').removeClass('d-none');
              $('#add-season-success-alert').addClass('show');
              $('#add-season-success-alert span').text(response.message);
                
              setTimeout(function(){
                window.location.reload();
              }, 2000)

            },
            error: function(){}

          })
        }

      })

      $("#price-scales-form").submit(function(e){
        e.preventDefault();

        if(this.checkValidity() === true){
          let formData = $(this).serialize();

          $.ajax({
            method: 'post',
            url: '/kapcco/dashboard/colllections/set-price-scale/',
            data: formData,
            success: function(response){
              $('#add-scale-success-alert').removeClass('d-none');
              $('#add-scale-success-alert').addClass('show');
              $('#add-scale-success-alert span').text(response.message);
                
              setTimeout(function(){
                window.location.reload();
              }, 2000)

            },
            error: function(){}
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