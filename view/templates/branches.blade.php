@include('partials/header')
 
@include('partials/topBar');

@include('partials/leftPane');

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Branches</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/{{$appName}}/dashboard/">Dashboard</a></li>
          <li class="breadcrumb-item">Branches</li>
          <li class="breadcrumb-item active">All</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        
        
        <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Showing All Branches</h5>

              <!-- Table with stripped rows -->
              <table class="table table-striped datatable">
                <thead>
                  <tr>
                    <th scope="col">SNo</th>
                    <th scope="col">Branch Name</th>
                    <th scope="col">Branch Location</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($branches as $branch)
                    <tr>
                      <th scope="row">{{ $loop->iteration }}</th>
                      <td>{{$branch['branch_name']}}</td>
                      <td>{{$branch['branch_location']}}</td>
                      <td><span class="badge bg-success">{{$branch['status']}}</span></td>
                      <td>
                        <div class="d-flex">
                        <a href="?action=edit&id={{$branch['id']}}" class="btn btn-secondary btn-sm p-1"><i class="bi bi-pencil-square"></i></a>
                        <a href="?action=delete&id={{$branch['id']}}" class="btn btn-danger btn-sm p-1 mx-1"><i class="bi bi-trash3"></i></a>
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

          <div>
            <div class="delete-form-container">
              @if($action == 'delete')
                @include('deleteBranch')
              @endif
            </div>
            <div id="update-form-container">
                <!-- begin update form -->
                @if($action == 'edit')
                  @include('editBranch')
                @endif
                <!-- end update form -->

              </div>

            
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Add New Branch</h5>
    
                  <!-- Vertical Form -->
                  <form class="needs-validation" novalidate id="create-branch-form" class="row g-3">
                  <div id="add-branch-success-alert" class="alert alert-success alert-dismissible fade d-none p-1" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                      <span></span>
            
                  </div>
                    <div class="col-12">
                      <label for="branch-name" class="form-label">Branch Name</label>
                      <input oninput="capitalizeEveryWord(this)" name="branch-name" type="text" class="form-control" id="branch-name" placeholder="Enter branch name" required>
                      <div class="invalid-feedback">Please enter the branch name.</div>
                    </div>
                    <div class="col-12">
                      <label for="branch-location" class="form-label">Branch Location</label>
                      <input oninput="capitalizeEveryWord(this)" type="text" name="branch-location" class="form-control" id="branch-location" placeholder="Enter branch location" required>
                      <div class="invalid-feedback">Please enter the branch location.</div>
                    </div>
                    
                    
                    <div class="text-left mt-3">
                      <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                      
                    </div>
                  </form><!-- Vertical Form -->
    
                </div>
              </div>
            


          </div>
   
         </div>
      </div>
      
    </section>

  </main><!-- End #main -->

  <script>
    function capitalizeFirstLetter(input) {
              input.value = input.value.charAt(0).toUpperCase() + input.value.slice(1);
    }

    function capitalizeEveryWord(input) {
            var words = input.value.split(' ');

            for (var i = 0; i < words.length; i++) {
                words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
            }

            input.value = words.join(' ');
        }
  </script>

  @include('partials/footer')

  <script>
    $(document).ready(function(){

      $('#delete-branch-form').submit(function(e){
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
          method: 'post',
          url: '/kapcco/dashboard/branches/delete/',
          data: formData,
          success: function(response){
            $('#delete-branch-success-alert').removeClass('d-none');
            $('#delete-branch-success-alert').addClass('show');
            $('#delete-branch-success-alert span').text(response.message);

            setTimeout(function(){
                  window.location.replace("http://localhost/kapcco/dashboard/branches/");
            }, 2000)
          }
        })

      })

      $('#update-branch-form').submit(function(e){
          e.preventDefault();

          if(this.checkValidity() === true){
            let formData = $(this).serialize();

            $.ajax({
              method: 'post',
              url: '/kapcco/dashboard/branches/edit/',
              data: formData,
              success: function(response){
                $('#edit-branch-success-alert').removeClass('d-none');
                $('#edit-branch-success-alert').addClass('show');
                $('#edit-branch-success-alert span').text(response.message);

                setTimeout(function(){
                  window.location.reload();
                }, 2000)
              },
              error: function(){}
            })
          }
      })

      $('#create-branch-form').submit(function(e){

        e.preventDefault();

        if(this.checkValidity() === true){

          let formData = $(this).serialize();
  
          $.ajax({
            method:'post',
            url: '/kapcco/dashboard/branches/add/',
            data: formData,
            success: function(response){
              
                $('#add-branch-success-alert').removeClass('d-none');
                $('#add-branch-success-alert').addClass('show');
                $('#add-branch-success-alert span').text(response.message);
                
                setTimeout(function(){
                  window.location.reload();
                }, 2000)
  
              
            },
            error: function(){}
          })
        }

      })

    })
  </script>