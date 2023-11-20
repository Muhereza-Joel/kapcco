<?php echo $__env->make('partials/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 
<?php echo $__env->make('partials/topBar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<?php echo $__env->make('partials/leftPane', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add New Collection</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/<?php echo e($appName); ?>/dashboard/">Dashboard</a></li>
          <li class="breadcrumb-item">Collections</li>
          <li class="breadcrumb-item active">Add New</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <form id="add-collection-form" class="row g-3 needs-validation my-3" novalidate>
        <div class="row">
          <div class="col-lg-3">

            <?php echo $__env->make('season', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('selectBranchAndStore', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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

  <?php echo $__env->make('partials/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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


    // Attach an event listener to the "Stores" dropdown
    $('#parent-store-drop-down').on('change', function () {
      // Get the selected store ID
      var selectedStore = $(this).val();

      // Perform an Ajax request to fetch data for the selected store
      $.ajax({
        url: '/kapcco/dashboard/zones/get-farmers-by-store-id/', // Replace with the actual server endpoint
        method: 'GET',
        data: { store_id: selectedStore },
        success: function (data) {
          // Clear existing rows in the table body
          $('#farmers-to-allocate-table tbody').empty();

          // Add new rows based on the response data
          $.each(data.farmers, function (key, value) {
            $('#farmers-to-allocate-table tbody').append(
              '<tr>' +
                '<td><input type="checkbox" class="row-select" value="' + value.user_id + '"></td>' +
                '<td>' + '<img src='+value.image_url+"'/>" + value.fullname + '</td>' +
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