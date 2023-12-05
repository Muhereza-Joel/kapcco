@include('partials/header')

@include('partials/topBar');

@include('partials/leftPane');

<main id="main" class="main">
  <div id="loading-overlay">
    <div id="loading-indicator"></div>
  </div>
  <div class="pagetitle">
    <h1>Reports</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/{{$appName}}/dashboard/">Dashboard</a></li>
        <li class="breadcrumb-item">Collections</li>
        <li class="breadcrumb-item active">Reports</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row g-3">
      <div class="col-lg-4">
        @include('selectBranchAndStore')
        @include('farmerCollectionTable')
      </div>
      <div class="col-lg-8">

        <div class="card" style="position: sticky; top: 50px">
          <div class="card-body">
            <div id="report-header" class="card-title fw-bold">Showing last {{count($lastCollections)}} collections.</div>
            <table class="table table-striped datatable" id="reports-table">
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
                </tr>
                @endforeach
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  </section>

</main><!-- End #main -->

@include('partials/footer')

<script>
  $(document).ready(function() {

    var selectedFarmers = [];
    var maxSelection = 1;
    var selectedStore;
    var selectedBranch;
    var datatable = $('#reports-table.datatable');
    

    $('#parent-branch-drop-down').on('change', function() {
      $('#farmers-to-allocate-table tbody').empty();
      selectedFarmers = [];

      selectedBranch = $(this).val();

      showLoadingOverlay();

      $.ajax({
        url: '/kapcco/dashboard/zones/get-zones-by-id/',
        method: 'GET',
        data: {
          branch_id: selectedBranch
        },
        success: function(data) {

          $('#parent-store-drop-down').empty();
          $('#parent-store-drop-down').append('<option >Select Store</option>');


          $.each(data.stores, function(key, value) {
            $('#parent-store-drop-down').append('<option value="' + value.id + '">' + value.zone_name + '</option>');
          });

          $('#reports-table tbody').empty();

          $.each(data.collections, function(key, value) {
            $('#reports-table tbody').append(
              '<tr>' +
              '<td><input type="checkbox" class="row-select" value="' + value.user_id + '"></td>' +
              '<td>' + '<img width="40px" height="40px" class="rounded-circle mx-3" src = "' + value.image_url + '"></td>' +
              '<td>' + value.branch_name + '</td>' +
              '<td>' + value.zone_name + '</td>' +
              '<td>' + value.product_type + '</td>' +
              '<td>' + value.unit_price + '</td>' +
              '<td>' + value.quantity + '</td>' +
              '<td>' + value.total_amount + '</td>' +
              '<td>' + (value.payed == 1 ? '<span class="badge bg-dark">Payed</span>' : '<span class="badge bg-danger">Not Payed</span>') + '</td>' +
              '</tr>'
            );
          });

          $('#report-header').text('Collection data for seleted branch.')
          hideLoadingOverlay();

          
        },
        error: function(error) {
          hideLoadingOverlay();
          console.log('Error fetching data:', error);
        }
      });
    });

    $('#parent-store-drop-down').on('change', function() {

      selectedStore = $(this).val();
      selectedFarmers = [];

      showLoadingOverlay();

      $.ajax({
        url: '/kapcco/dashboard/zones/get-farmers-by-store-id/',
        method: 'GET',
        data: {
          store_id: selectedStore
        },
        success: function(data) {

          $('#farmers-to-allocate-table tbody').empty();

          $.each(data.farmers, function(key, value) {
            $('#farmers-to-allocate-table tbody').append(
              '<tr>' +
              '<td><input type="checkbox" class="row-select" value="' + value.user_id + '"></td>' +
              '<td>' + '<img width="40px" height="40px" class="rounded-circle mx-3" src = "' + value.image_url + '">' + value.fullname + '</td>' +
              '</tr>'
            );
          });

          $('#reports-table tbody').empty();

          $.each(data.collections, function(key, value) {
            $('#reports-table tbody').append(
              '<tr>' +
              '<td><input type="checkbox" class="row-select" value="' + value.user_id + '"></td>' +
              '<td>' + '<img width="40px" height="40px" class="rounded-circle mx-3" src = "' + value.image_url + '"></td>' +
              '<td>' + value.branch_name + '</td>' +
              '<td>' + value.zone_name + '</td>' +
              '<td>' + value.product_type + '</td>' +
              '<td>' + value.unit_price + '</td>' +
              '<td>' + value.quantity + '</td>' +
              '<td>' + value.total_amount + '</td>' +
              '<td>' + (value.payed == 1 ? '<span class="badge bg-dark">Payed</span>' : '<span class="badge bg-danger">Not Payed</span>') + '</td>' +
              '</tr>'
            );
          });

          $('#report-header').text('Collection data for seleted branch and store.')
          hideLoadingOverlay();
         
         ;
        },
        error: function(error) {
          console.log('Error fetching data:', error);
          hideLoadingOverlay();
        }
      });
    });


    $('#farmers-to-allocate-table tbody').on('change', 'input.row-select', function() {
      var farmerId = $(this).val();

      if (this.checked) {
        if (selectedFarmers.length >= maxSelection) {
          this.checked = false;
          alert('You can only fetch recods for one farmer per selection.');
        } else {
          selectedFarmers.push(farmerId);
          getSelectedFarmerCollections(selectedBranch, selectedStore, farmerId);
        }
      } else {
        selectedFarmers = selectedFarmers.filter(function(id) {
          return id !== farmerId;
        });
      }
    });

    function getSelectedFarmerCollections(branch, store, farmerId) {
      showLoadingOverlay();
      $.ajax({
        url: '/kapcco/dashboard/zones/get-farmers-collections/',
        method: 'GET',
        data: {
          branch: branch,
          store: store,
          farmer_id: farmerId
        },

        success: function(data) {
          $('#reports-table tbody').empty();

          $.each(data.collections, function(key, value) {
            $('#reports-table tbody').append(
              '<tr>' +
              '<td><input type="checkbox" class="row-select" value="' + value.user_id + '"></td>' +
              '<td>' + '<img width="40px" height="40px" class="rounded-circle mx-3" src = "' + value.image_url + '"></td>' +
              '<td>' + value.branch_name + '</td>' +
              '<td>' + value.zone_name + '</td>' +
              '<td>' + value.product_type + '</td>' +
              '<td>' + value.unit_price + '</td>' +
              '<td>' + value.quantity + '</td>' +
              '<td>' + value.total_amount + '</td>' +
              '<td>' + (value.payed == 1 ? '<span class="badge bg-dark">Payed</span>' : '<span class="badge bg-danger">Not Payed</span>') + '</td>' +
              '</tr>'
            );
          });

          $('#report-header').text('Collection data for seleted farmer under the selected branch and store')
          hideLoadingOverlay();

        }
      })
    }


  });
</script>