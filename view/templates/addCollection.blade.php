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
            <div class="card">
              <div class="card-body">
                <div class="card-title">Farmers under selected store</div>
                <table id="farmers-to-allocate-table" class="table table-striped">
                      
                      <thead>
                        <tr>
                          <th>
                            <div class="icon">
                              <i class="bi bi-check-square-fill"></i> 
                            </div>

                          </th>
                          <th scope="col">Full Name</th>
                      </tr>
                      </thead>
                      <tbody>                 
                          <tr> 
                            <td><input type="checkbox" class="row-select" value="1"></td>                        
                            <td>Muhereza Joel</td> 
                          </tr>
                      </tbody>
                    </table>
              </div>
            </div>
          </div>
          <div class="col-lg-5"></div>
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

          // Add new options based on the response data
          $.each(data.stores, function (key, value) {
            $('#parent-store-drop-down').append('<option value="' + value.id + '">' + value.zone_name + '</option>');
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