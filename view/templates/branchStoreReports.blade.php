@php
use Carbon\Carbon;
@endphp
@include('partials/header')

@include('partials/topBar');

@include('partials/leftPane');

<main id="main" class="main">
  <div id="loading-overlay">
    <div id="loading-indicator"></div>
  </div>
  <div class="d-flex">
    <div class="pagetitle w-50">
      <h1>Reports</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/{{$appName}}/dashboard/">Dashboard</a></li>
          <li class="breadcrumb-item">Collections</li>
          <li class="breadcrumb-item active">Reports</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="w-50 text-end">
      <div class="text-end"><button id="exportPdfBtn" class="btn btn-primary btn-sm">Export To Pdf</button></div>

    </div>

  </div>

  <section class="section">
    <div class="row g-1">
      <div class="col-lg-3">
        @include('selectBranchAndStore')
        @include('farmerCollectionTable')
      </div>
      <div class="col-lg-9">

        <div class="card" style="position: sticky; top: 50px">
          <div class="card-body">
            <div id="report-header" class="card-title fw-bold">Showing last {{count($lastCollections)}} collections.</div>
            <table class="table table-striped datatable" id="reports-table">
              <thead>
                <tr>

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
                  <td>{{ \Carbon\Carbon::parse($collection['created_at'])->format('d-m-Y') }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="pdfModalLabel">PDF Preview</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <iframe id="pdfIframe" width="100%" height="500px" frameborder="0"></iframe>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

</main><!-- End #main -->

@include('partials/footer')

<script>
  $(document).ready(function() {

    var selectedFarmers = [];
    var maxSelection = 1;
    var selectedStore;
    var selectedBranch;
    var datatable = $('#reports-table.datatable');
    var selectedOption = 'branch';
    var farmerId;


    $('#parent-branch-drop-down').on('change', function() {
      $('#farmers-to-allocate-table tbody').empty();
      selectedFarmers = [];
      selectedOption = 'branch';

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
            var createdAt = new Date(value.created_at);
            var formattedDate = (createdAt.getDate() < 10 ? '0' : '') + createdAt.getDate() + '-' +
              ((createdAt.getMonth() + 1) < 10 ? '0' : '') + (createdAt.getMonth() + 1) + '-' +
              createdAt.getFullYear();
            $('#reports-table tbody').append(
              '<tr>' +

              '<td>' + '<img width="40px" height="40px" class="rounded-circle mx-3" src = "' + value.image_url + '"></td>' +
              '<td>' + value.branch_name + '</td>' +
              '<td>' + value.zone_name + '</td>' +
              '<td>' + value.product_type + '</td>' +
              '<td>' + value.unit_price + '</td>' +
              '<td>' + value.quantity + '</td>' +
              '<td>' + value.total_amount + '</td>' +
              '<td>' + (value.payed == 1 ? '<span class="badge bg-dark">Payed</span>' : '<span class="badge bg-danger">Not Payed</span>') + '</td>' +
              '<td>' + formattedDate + '</td>' +
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
      selectedOption = 'store'

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
            var createdAt = new Date(value.created_at);
            var formattedDate = (createdAt.getDate() < 10 ? '0' : '') + createdAt.getDate() + '-' +
              ((createdAt.getMonth() + 1) < 10 ? '0' : '') + (createdAt.getMonth() + 1) + '-' +
              createdAt.getFullYear();
            $('#reports-table tbody').append(
              '<tr>' +

              '<td>' + '<img width="40px" height="40px" class="rounded-circle mx-3" src = "' + value.image_url + '"></td>' +
              '<td>' + value.branch_name + '</td>' +
              '<td>' + value.zone_name + '</td>' +
              '<td>' + value.product_type + '</td>' +
              '<td>' + value.unit_price + '</td>' +
              '<td>' + value.quantity + '</td>' +
              '<td>' + value.total_amount + '</td>' +
              '<td>' + (value.payed == 1 ? '<span class="badge bg-dark">Payed</span>' : '<span class="badge bg-danger">Not Payed</span>') + '</td>' +
              '<td>' + formattedDate + '</td>' +
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
      farmerId = $(this).val();

      if (this.checked) {
        if (selectedFarmers.length >= maxSelection) {
          this.checked = false;
          alert('You can only fetch recods for one farmer per selection.');
        } else {
          selectedFarmers.push(farmerId);
          selectedOption = 'farmer';
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
            var createdAt = new Date(value.created_at);
            var formattedDate = (createdAt.getDate() < 10 ? '0' : '') + createdAt.getDate() + '-' +
              ((createdAt.getMonth() + 1) < 10 ? '0' : '') + (createdAt.getMonth() + 1) + '-' +
              createdAt.getFullYear();

            $('#reports-table tbody').append(
              '<tr>' +

              '<td>' + '<img width="40px" height="40px" class="rounded-circle mx-3" src = "' + value.image_url + '"></td>' +
              '<td>' + value.branch_name + '</td>' +
              '<td>' + value.zone_name + '</td>' +
              '<td>' + value.product_type + '</td>' +
              '<td>' + value.unit_price + '</td>' +
              '<td>' + value.quantity + '</td>' +
              '<td>' + value.total_amount + '</td>' +
              '<td>' + (value.payed == 1 ? '<span class="badge bg-dark">Payed</span>' : '<span class="badge bg-danger">Not Payed</span>') + '</td>' +
              '<td>' + formattedDate + '</td>' +
              '</tr>'
            );
          });

          $('#report-header').text('Collection data for seleted farmer under the selected branch and store')
          hideLoadingOverlay();

        }
      })
    }

    $('#exportPdfBtn').click(function() {
      switch (selectedOption) {
        case 'branch':
          fetchData('branch', {
            branch_id: selectedBranch
          })
          break;
        case 'store':
          fetchData('store', {
            store_id: selectedStore
          })
          break;
        case 'farmer':
          fetchData('farmer', {
            branch_id: selectedBranch,
            store_id: selectedStore,
            farmer_id: farmerId
          })
          break;
        default:
          console.error('Invalid selected option');
          return;
      }
    })

    function fetchData(selectedOption, requestData) {
      var url;

      switch (selectedOption) {
        case 'branch':
          url = `/kapcco/reports/pdf/branch-collections/?branch_id=${selectedBranch}`;
          break;
        case 'store':
          url = `/kapcco/reports/pdf/store-collections/?store_id=${selectedStore}`;
          break;
        case 'farmer':
          url = `/kapcco/reports/pdf/farmer-collections/?branch=${selectedBranch}&store=${selectedStore}&farmer_id=${farmerId}`;
          break;
        default:
          console.error('Invalid selected option');
          return;
      }

      $.ajax({
        url: url,
        method: 'post',
        processData: false,
        contentType: false,
        success: function(response) {

          var pdfData = response;

          $("#pdfIframe").attr("src", "data:application/pdf;base64," + pdfData);

          // Open the Bootstrap modal
          $("#pdfModal").modal("show");
        },
        error: function(xhr, status, error) {
          console.error("Error:", error);
        }
      });

    }


  });
</script>