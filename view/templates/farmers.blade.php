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
        <div class="card">
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
                          @if($farmer['approved'] == 0)
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
                                <a href="?action=allocate-store&id={{$farmer['id']}}" class="btn btn-success btn-sm mx-1 p-1"><i class="bi bi-shop-window"></i></a>
                                <a href="?action=drop-store-allocation&id={{$farmer['id']}}" class="btn btn-danger btn-sm mx-1 p-1"><i class="bi bi-shop-window"></i></a>
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

  @include('partials/footer')

  <script>
    $(document).ready(function(){
      $("#farmers-table").on('change', 'input.row-select', function(){
          let checkboxes = $('input.row-select:checked');
          let approveButton = $('#approve-btn');

          if (checkboxes.length > 0) {
            approveButton.show();

          } else {
            approveButton.hide();
          }
      })

      $("#approve-btn").click(function(){
        $('#confirmationModal').modal('show');

        let selectedValues = [];

        $('input.row-select:checked').each(function(){
          selectedValues.push($(this).val());

          if(selectedValues.length > 0){
            $("#confirmApprove").click(function(){
              let idsString = encodeURIComponent(JSON.stringify(selectedValues));

              $.ajax({
                method: 'get',
                url : '/kapcco/dashboard/farmers/approve/?ids=' + idsString,
                success: function(response){
                  $("#confirmationModalLabel").fadeOut();
                  $("#alert-success").removeClass('d-none');
                  $("#alert-success").addClass('show');
                  $("#alert-success span").text(response.message);
                  $('#confirmApprove').prop('disabled', true)

                  setTimeout(function(){
                    $('#confirmationModal').modal('hide');
                    window.location.reload();

                  }, 2000)
                }
              })
            })
          }
        })
      })
    })
  </script>