@include('partials/header')
 
@include('partials/topBar');

@include('partials/leftPane');

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add New Collection</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/{{$appName}}/dashboard/">Dashboard</a></li>
          <li class="breadcrumb-item">Collections</li>
          <li class="breadcrumb-item active">Add New</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <form id="add-collection-form" class="row g-3 needs-validation my-3" novalidate>
        <div class="row">
          <div class="col-lg-3">

            @include('season')

            @include('selectBranchAndStore')

          </div>
          <div class="col-lg-4">
            @include('farmerCollectionTable')
          </div>
          <div class="col-lg-5">
            <div class="card">
              <div class="card-body">
                <div class="card-title">Collection form</div>
                  <div class="alert alert-info p-1">
                    Select farmers from the list to add collections. Selecting more than one will save the same collection to all of them forexample if the quantity is similar.
                  </div>

                  <small>Collection data</small>
                  <div class="row">
                    <div class="col-sm-6">
                      <div>
                        <label for="product-type" class="fw-bold">Product Type</label>
                        <select name="product-type" id="product-type" class="form-control" required>
                          <option value="">Select product type</option>
                          <option value="Parchment">Parchment</option>
                          <option value="Kiboko">Kiboko</option>
                          <option value="Red Cherry">Red Cherry</option>
                          <option value="FAQ">FAQ</option>
                        </select>
                      <div class="invalid-feedback">Please select coffee type</div>
                    </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="unit-price" class="fw-bold">Unit Price /kg</label>
                        <input type="number" readonly value="" class="form-control" required>
                      </div>
                    </div>
                  </div>

                  <div class="row mt-3">
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label for="quantity" class="fw-bold">Quantity in Kilograms</label>
                          <input type="number"  class="form-control" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                          <label for="total" class="fw-bold">Total Amount</label>
                          <input type="number"  class="form-control" required readonly>
                      </div>
                    </div>
                  </div>

                  <fieldset class="row mb-3 mt-3">
                        <label for="" class="fw-bold">Mark collection as</label>
                          <div class="col-sm-4">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked="">
                              <label class="form-check-label" for="gridRadios1">
                                Payed
                              </label>
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                              <label class="form-check-label" for="gridRadios2">
                                Not payed
                              </label>
                            </div>
                          </div>
                      </fieldset>

                  <button type="submit" class="btn btn-primary btn-sm mt-3">Save Collection data</button>
                  

              </div>
            </div>
          </div>
        </div>

      </form>
    </section>

  </main><!-- End #main -->

  @include('partials/footer')

  <script>
    $(document).ready(function(){

    $('#parent-branch-drop-down').on('change', function () {
    
      var selectedBranch = $(this).val();

      $.ajax({
        url: '/kapcco/dashboard/zones/get-zones-by-id/', 
        method: 'GET',
        data: { branch_id: selectedBranch },
        success: function (data) {
        
          $('#parent-store-drop-down').empty();
           $('#parent-store-drop-down').append('<option value="">Select Store</option>');

         
          $.each(data.stores, function (key, value) {
            $('#parent-store-drop-down').append('<option value="' + value.id + '">' + value.zone_name + '</option>');
          });
        },
        error: function (error) {
          console.log('Error fetching data:', error);
        }
      });
    });


    $('#parent-store-drop-down').on('change', function () {
     
      var selectedStore = $(this).val();

     
      $.ajax({
        url: '/kapcco/dashboard/zones/get-farmers-by-store-id/', 
        method: 'GET',
        data: { store_id: selectedStore },
        success: function (data) {
         
          $('#farmers-to-allocate-table tbody').empty();

          $.each(data.farmers, function (key, value) {
            $('#farmers-to-allocate-table tbody').append(
              '<tr>' +
                '<td><input type="checkbox" class="row-select" value="' + value.user_id + '"></td>' +
                '<td>'+ '<img width="40px" height="40px" class="rounded-circle mx-3" src = "'+value.image_url+'">' + value.fullname + '</td>' +
              '</tr>'
            );
          });
        },
        error: function (error) {
          console.log('Error fetching data:', error);
        }
      });
    });

      
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