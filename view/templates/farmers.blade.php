@include('partials/header')

@include('partials/topBar');

@include('partials/leftPane');

<main id="main" class="main">

  <div class="pagetitle d-flex">
    <div class="w-50">
      <h1>Showing All Farmers</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/{{$appName}}/dashboard/">Dashboard</a></li>
          <li class="breadcrumb-item">Farmers</li>
          <li class="breadcrumb-item active">All</li>
        </ol>
      </nav>

    </div>
    <div class="align-self-center w-50" style="display: flex; justify-content: right;">
      <button id="approve-btn" class="btn btn-primary btn-sm" style="display: none;">Approve selected farmers</button>
    </div>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-8">
        <div class="card" style="position: sticky; top: 70px;">
          <div class="card-body">
            <h5 class="card-title"></h5>

            <!-- Table with stripped rows -->
            <table id="farmers-table" class="table table-striped datatable">
              <thead>
                <tr>
                  <th>
                    <div class="icon">
                      <!-- <i class="bi bi-check-square-fill"></i> -->

                    </div>

                  </th>
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
                  <th>
                    @if($farmer['approved'] == 0 && $action == "")
                    <input type="checkbox" class="row-select" value="{{$farmer['farmer_id']}}">
                    @endif
                  </th>
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

                      @if($farmer['approved'] == '1')
                      <a href="/kapcco/dashboard/farmers/u/?action=allocate-store&id={{$farmer['id']}}" class="btn btn-success btn-sm mx-1 p-1"><i class="bi bi-shop-window"></i></a>
                      <a href="/kapcco/dashboard/farmers/u/?action=drop-store-allocation&id={{$farmer['id']}}" class="btn btn-danger btn-sm mx-1 p-1"><i class="bi bi-shop-window"></i></a>
                      @endif
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
          <div class="assign-stores-container">
            @if($action == 'allocate-store')
            @include('assignStore')

            @endif

            @if($action == 'drop-store-allocation')
            <div class="card">
              <div class="card-body">
                <div class="card-title">Drop Store Allocation</div>

                <div class="d-flex justify-content-center mb-3">
                  <img src="{{$userDetails['image_url']}}" class="rounded-circle" alt="" width="150px" height="150px" style="object-fit: cover; border: 3px solid #fff;">
                </div>

                <div class="row px-2">
                  <div class="col-lg-5 col-md-5 label fw-bold ">Full Name</div>
                  <div class="col-lg-7 col-md-7 form-control mb-2">{{$userDetails['fullname']}}</div>
                </div>
                @if(count($assignedStores) > 0)

                <div class="alert alert-warning p-1">
                  You have to assign this farmer new stores if you delete these assignments,
                  else you will not be able to record collections this farmer
                </div>
                <div id="alert-assignment-drop-success" class="alert alert-success d-none p-1">
                  <span></span>
                </div>

                <div id="farmer-to-drop-assignments" class="d-none">{{$userDetails['user_id']}}</div>
                <div class="card"><button id="drop-assignment-btn" class="btn btn-danger btn-sm " style="display: none;">Drop Assignments</button></div>

                <table id="assignments-to-drop-table" class="table table-striped">

                  <thead>
                    <tr>
                      <th>
                        <div class="icon">
                          <i class="bi bi-check-square-fill"></i>
                        </div>
                      </th>

                      <th scope="col">Store Name</th>
                      <th scope="col">Parent Branch</th>

                    </tr>
                  </thead>
                  <tbody>
                    @foreach($assignedStores as $store)
                    <tr>
                      <td>
                        <input type="checkbox" class="row-select" value="{{$store['assignment_id']}}">
                      </td>
                      <td>{{$store['zone_name']}}</td>
                      <td>{{$store['branch_name']}}</td>

                    </tr>
                    @endforeach

                  </tbody>
                </table>

                @else
                <div class="alert alert-info p-2">You have not assigned this farmer any stores.
                  <strong>You cannot record collections for farmers who do not have stores assigned to them</strong>
                </div>

                @endif
              </div>
            </div>
            @endif

          </div>
          <div id="view-farmer-info-container">

            @if($action == 'view')
            @include('viewFarmer')
            @endif
          </div>

        </div>
      </div>

    </div>
    <!-- Bootstrap Modal for Confirmation -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <div>
              <h6 class="fw-bold">Confirm Approve Action</h6>
            </div>
          </div>
          <div class="modal-body">
            <div id="alert-success" class="alert alert-success alert-dismissible py-1 px-2 d-none fade" role="alert">
              <i class="bi bi-exclamation-octagon me-0"></i>
              <span></span>

            </div>
            <h6 id="confirmationModalLabel">Are you sure you want to approve selected farmers?. This will help each farmer to login.</h6>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary btn-sm" id="confirmApprove">Yes, Continue</button>
          </div>
        </div>
      </div>
    </div>
  </section>

</main><!-- End #main -->


@include('partials/footer')

<script>
  $(document).ready(function() {

    var selectedStoresToAssign = [];
    var selectedAssignmentsToDrop = [];
    var maxSelection = 3;

    function updateButtons() {
      var selectedCountToAssign = selectedStoresToAssign.length;

      if (selectedCountToAssign > 0 && selectedCountToAssign <= maxSelection) {
        $('#save-assignment-btn').show();

      } else {
        $('#save-assignment-btn').hide();

      }
    }

    // Store initially selected rows
    $('table#store-to-allocate-table input.row-select:checked').each(function() {
      selectedStoresToAssign.push($(this).val());
    });

    $('table#store-to-allocate-table input.row-select').change(function() {
      var storeId = $(this).val();

      if (this.checked) {
        if (selectedStoresToAssign.length >= maxSelection) {
          this.checked = false;
          alert('You can only assign up to 3 stores per individual farmer.');
        } else {
          selectedStoresToAssign.push(storeId);
        }
      } else {
        selectedStoresToAssign = selectedStoresToAssign.filter(function(id) {
          return id !== storeId;
        });
      }
      updateButtons();
    });

    $('table#assignments-to-drop-table input.row-select').change(function() {
      let assignmentId = $(this).val();

      if (this.checked) {
        selectedAssignmentsToDrop.push(assignmentId);

        console.log(selectedAssignmentsToDrop);
      } else {
        selectedAssignmentsToDrop = selectedAssignmentsToDrop.filter(function(id) {
          return id !== assignmentId
        });
      }

      if (selectedAssignmentsToDrop.length > 0) {
        $('#drop-assignment-btn').show();

      } else {
        $('#drop-assignment-btn').hide();
      }
    })

    // Function to handle the "Save Assignment" button click
    $('#save-assignment-btn').click(function() {
      var idsString = encodeURIComponent(JSON.stringify(selectedStoresToAssign));
      var farmer_to_assign = $("#farmer-to-assign").text();

      $.ajax({
        method: 'post',
        url: '/kapcco/dashboard/farmers/assign/?ids=' + idsString,
        data: {
          ids: idsString,
          farmer_id: farmer_to_assign
        },
        success: function(response) {
          $("#alert-assignment-success").removeClass('d-none');
          $("#alert-assignment-success").addClass('show');
          $("#alert-assignment-success").text(response.message);

          setTimeout(function() {
            window.location.reload();
          }, 2000)
        },
        error: function(err) {

        }
      });
    });

    $('#drop-assignment-btn').click(function() {
      var idsString = encodeURIComponent(JSON.stringify(selectedAssignmentsToDrop));
      var farmerToDropAssignment = $("#farmer-to-drop-assignments").text();

      $.ajax({
        method: 'post',
        url: '/kapcco/dashboard/farmers/drop-assignments/?ids=' + idsString,
        data: {
          ids: idsString,
          farmer_id: farmerToDropAssignment
        },
        success: function(response) {
          $("#alert-assignment-drop-success").removeClass('d-none');
          $("#alert-assignment-drop-success").addClass('show');
          $("#alert-assignment-drop-success span").text(response.message);

          setTimeout(function() {
            window.location.reload();
          }, 2000)
        },
        error: function(err) {

        }
      })
    })




    $("#farmers-table").on('change', 'input.row-select', function() {
      let checkboxes = $('#farmers-table input.row-select:checked');
      let approveButton = $('#approve-btn');

      if (checkboxes.length > 0) {
        approveButton.show();

      } else {
        approveButton.hide();
      }
    })

    $("#approve-btn").click(function() {
      $('#confirmationModal').modal('show');

      let selectedValues = [];

      $('#farmers-table input.row-select:checked').each(function() {
        selectedValues.push($(this).val());

        if (selectedValues.length > 0) {
          $("#confirmApprove").click(function() {
            let idsString = encodeURIComponent(JSON.stringify(selectedValues));

            $.ajax({
              method: 'get',
              url: '/kapcco/dashboard/farmers/approve/?ids=' + idsString,
              success: function(response) {
                $("#confirmationModalLabel").fadeOut();
                $("#alert-success").removeClass('d-none');
                $("#alert-success").addClass('show');
                $("#alert-success span").text(response.message);
                $('#confirmApprove').prop('disabled', true)

                setTimeout(function() {
                  $('#confirmationModal').modal('hide');
                  window.location.reload();

                }, 2000)
              }
            })
          })
        }
      })
    })

    $('#confirmationModal').on('hidden.bs.modal', function() {
      // Clear the selected checkboxes and the array
      $('#farmers-table input.row-select:checked').prop('checked', false);
      selectedValues = [];
      $('#approve-btn').hide();
    });
  })
</script>