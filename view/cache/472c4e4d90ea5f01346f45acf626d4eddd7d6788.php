<?php echo $__env->make('partials/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 
<?php echo $__env->make('partials/topBar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<?php echo $__env->make('partials/leftPane', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;
<main id="main" class="main">
<div class="d-flex align-items-center px-3">
                  <div class="pagetitle p-2 order-0 w-50">
                      <h1 class="py-1">Your Profile Information</h1>
                          <nav>
                            <ol class="breadcrumb">
                              <?php if($role == 'Administrator'): ?>
                                <li class="breadcrumb-item"><a href="/<?php echo e($appName); ?>/dashboard/">Dashboard</a></li>
                              <?php endif; ?>
                              <li class="breadcrumb-item">Users</li>
                              <li class="breadcrumb-item active">My Profile</li><br>
                              <div style="width: 10px;"></div>
                              <div id="last-update-timestamp" class="d-none"><?php echo e($userDetails['updated_at']); ?></div>
                              <span id="last-update" class="badge bg-secondary ml-3"></span>
                            </ol>
                          </nav>
                  </div>
                  <div style="width: 30px;"></div>
                  <div id="alert-success" class="alert alert-success alert-dismissible py-1 px-2  fade d-none w-50" role="alert">
                        <i class="bi bi-check-circle me-1"></i>
                        <span></span>
                  </div>

                  
              </div>

      <section class="section profile">
              
                <div class="row">
                  <div class="col-xl-4">

                    <div class="card">
                      <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="<?php echo e($avator); ?>" alt="Profile" class="rounded-circle">
                        <h2><?php echo e($userDetails['fullname']); ?></h2>
                        <span class="text-info"><strong>Your Role : </strong> <?php echo e($role); ?></span>
                  

                        <div>
                          <button type="button" class="btn btn-secondary btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#basicModal">
                            Change Photo
                          </button>
                          
                        </div>
                        
                      </div>
                    </div>

                  </div>

                  <div class="col-xl-8">

                    <div class="card">
                      <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                          <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                          </li>

                          <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                          </li>


                          <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                          </li>

                        </ul>
                        <div class="tab-content pt-2">

                          <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            
                            <h5 class="card-title fw-bold">Biography</h5>

                            <div class="row">
                              <div class="col-lg-3 col-md-4 label fw-bold ">Full Name</div>
                              <div class="col-lg-9 col-md-8"><?php echo e($userDetails['fullname']); ?></div>
                            </div>
                            <div class="row">
                              <div class="col-lg-3 col-md-4 label fw-bold ">NIN Number</div>
                              <div class="col-lg-9 col-md-8"><?php echo e($userDetails['nin']); ?></div>
                            </div>

                            <div class="row">
                              <div class="col-lg-3 col-md-4 label fw-bold ">Email</div>
                              <div class="col-lg-9 col-md-8"><?php echo e($userDetails['email']); ?></div>
                            </div>

                            <div class="row">
                              <div class="col-lg-3 col-md-4 label fw-bold ">Country</div>
                              <div class="col-lg-9 col-md-8"><?php echo e($userDetails['country']); ?></div>
                            </div>

                            <div class="row">
                              <div class="col-lg-3 col-md-4 label fw-bold ">District</div>
                              <div class="col-lg-9 col-md-8"><?php echo e($userDetails['district']); ?></div>
                            </div>
                            <div class="row">
                              <div class="col-lg-3 col-md-4 label fw-bold ">Village</div>
                              <div class="col-lg-9 col-md-8"><?php echo e($userDetails['village']); ?></div>
                            </div>



                            <div class="row">
                              <div class="col-lg-3 col-md-4 label fw-bold ">Phone</div>
                              <div class="col-lg-9 col-md-8"><?php echo e($userDetails['phone']); ?></div>
                            </div>

                            
                          </div>

                          <div class="tab-pane fade profile-edit" id="profile-edit">

                            <!-- Profile Edit Form -->
                            <form id="edit-profile-form" class="needs-validation"  novalidate>
              <br>
              <div class="card-body">
                            <div class="alert alert-success d-none p-1" id="alert-profile-upadte-success"><span></span></div>
                            <div class="row mb-3">
                              <label for="fullName" class=" col-md-4 col-lg-3 col-form-label">Full Name</label>
                              <div class="col-md-8 col-lg-9">
                                <input id="carrent-user-id" name="current-user-id" type="hidden" value="<?php echo e($userDetails['id']); ?>">
                                <input oninput="capitalizeEveryWord(this)" name="fullName" type="text" class="form-control" id="fullName" required placeholder="Enter your full name" value="<?php echo e($userDetails['fullname']); ?>">
                                <div class="invalid-feedback">Please enter your full name.</div>
                              </div>
                            </div>
                            

                            
                            <div class="row mb-3">
                              <label for="nin" class="col-md-4 col-lg-3 col-form-label">NIN</label>
                              <div class="col-md-8 col-lg-9">
                                  <input pattern="[A-Z0-9]{14}" min="14"  name="nin" type="text" class="form-control" id="nin" placeholder="Enter your nin number" required value="<?php echo e($userDetails['nin']); ?>">
                                  <div class="invalid-feedback">Please enter a valid NIN number with digits, letters, no spaces and 14 characters long.</div>
                                  <small id="nin-status" class="text-success fw-bold"></small>
                                </div>
                              </div>
    
                            <div class="row mb-3">
                              <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                              <div class="col-md-8 col-lg-9">
                                <input  name="email" type="text" class="form-control" id="email" placeholder="Enter your email address" required value="<?php echo e($userDetails['email']); ?>">
                                <div class="invalid-feedback">Please enter your email address.</div>
                                <small id="email-status" class="text-success fw-bold"></small>
                              </div>
                            </div>

                            <div class="row mb-3">
                              <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                              <div class="col-md-8 col-lg-9">
                                <input oninput="capitalizeFirstLetter(this)" name="country" type="text" class="form-control" id="Country" placeholder="Enter Country of Origin" required value="<?php echo e($userDetails['country']); ?>">
                                <div class="invalid-feedback">Please enter your country of origin.</div>
                              </div>
                            </div>
                            
                            <div class="row mb-3">
                              <label for="district" class="col-md-4 col-lg-3 col-form-label">District</label>
                              <div class="col-md-8 col-lg-9">
                                <input oninput="capitalizeFirstLetter(this)" name="district" type="text" class="form-control" id="district" placeholder="Enter your home district" required value="<?php echo e($userDetails['district']); ?>">
                                <div class="invalid-feedback">Please enter your home district.</div>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="village" class="col-md-4 col-lg-3 col-form-label">Village</label>
                              <div class="col-md-8 col-lg-9">
                                <input oninput="capitalizeFirstLetter(this)" name="village" type="text" class="form-control" id="village" placeholder="Enter your home village" required value="<?php echo e($userDetails['village']); ?>">
                                <div class="invalid-feedback">Please enter your home village.</div>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                              <div class="col-md-8 col-lg-9">
                                <input pattern="[+]?[0-9]+" name="phone" type="text" class="form-control" id="Phone" placeholder="Phone Number Like +256 776579631" required value="<?php echo e($userDetails['phone']); ?>">
                                <div class="invalid-feedback">Please enter a valid phone number.</div>
                              </div>
                            </div>


                            <div class="text-left">
                              <button id="edit-profile-submit-button"  class="btn btn-primary btn-sm">Update Profile</button>
                            
                            </div>

                            </div>
                          </form>

                        </div>

                        

                        <div class="tab-pane fade pt-3" id="profile-change-password">
                          <!-- Change Password Form -->
                          <div class="alert alert-warning p-2">
                            After successfully changing your password, your account will be loged out and 
                            then you have to log in again. You will be redirected to the login page automatically!
                          </div>
                          <form class="needs-validation" id="password-change-form" novalidate>

                            <div class="alert alert-success p-1 d-none" id="alert-password-change-success">
                               <span></span>
                            </div>

                            <div class="row mb-3">
                              <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="password" type="password" class="form-control" id="currentPassword" required>
                                <div class="invalid-feedback">Please enter your current password.</div>
                                <div class="text-danger" id="password-error"></div>
                              </div>
                            </div>

                            <div class="row mb-3">
                              <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="newpassword" type="password" class="form-control" id="newPassword" required disabled>
                                <div class="invalid-feedback">Please enter new password.</div>
                              </div>
                            </div>

                            <div class="row mb-3">
                              <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="renewpassword" type="password" class="form-control" id="renewPassword" required disabled>
                                <div class="invalid-feedback">Please re enter the new password.</div>
                                <div class="renewPassword-feedback" id="renewPassword-feedback">
                                  <span class="text-danger"></span>
                                </div>
                              </div>
                            </div>

                            <div class="text-left">
                              <button type="submit" class="btn btn-primary btn-sm" id="change-password-btn" disabled>Change Password</button>
                            </div>
                          </form><!-- End Change Password Form -->

                        </div>

                      </div><!-- End Bordered Tabs -->

                    </div>
                  </div>

                </div>
              </div>
            </section>

</main>  

<?php echo $__env->make('partials/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

           <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    
                    <div class="modal-body">
                          <div id="alert-number-error" class="alert alert-danger alert-dismissible py-1 px-2 fade d-none" role="alert">
                              <i class="bi bi-exclamation-octagon me-0"></i>
                              <span></span>
                            
                        </div>

                          <form  id="change-profile-pic-form" class="">
                              <div id="edit-photo-alert-success" class="alert alert-success alert-dismissible py-1 px-2  fade w-100" role="alert">
                                  <i class="bi bi-check-circle me-1"></i>
                                  <span></span>
                            </div>
                            <img id="profile-photo" src="<?php echo e($avator); ?>" width="100%" height="300px"  alt="Profile" style="object-fit: contain;">
                            <br><br><br>
                             <input data-parsley-error-message="Please choose an image" id="image" type="file" accept="image/jpeg" title="Choose Image" required>
                             <input type="hidden" name="image_url" id="image_url">
                            <button id="save-new-profile-pic-btn" type="submit" class="btn btn-primary btn-sm">Save Photo</button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
                          </form>
                    </div>
                    
                  </div>
                </div>
          </div><!-- End Basic Modal-->


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

    

    <script>
      
  $(document).ready(function() {
    $('#image').on('change', function(){
          let formData = new FormData();
          formData.append('image', this.files[0]);

          $.ajax({
            method: 'post',
            url: '/kapcco/image-upload/',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){

              $('#image_url').val("http://localhost/kapcco/uploads/images/" + response);
              $('#profile-photo').attr('src', "http://localhost/kapcco/uploads/images/" + response);

            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('An Error occurred, failed to upload image')
            }
          })
        })

        $('#change-profile-pic-form').submit(function(event){
              event.preventDefault();

              let formData = new FormData(this);
              $.ajax({
                    method: "POST", 
                    url: "/kapcco/auth/user/profile/update-photo/", 
                    data: formData, 
                    processData: false,
                    contentType: false,
                    success: function(response) {
                      $("#edit-photo-alert-success").removeClass('d-none');
                      $("#edit-photo-alert-success").addClass('show');
                      $('#edit-photo-alert-success span').text(response.message);
                      $('#save-new-profile-pic-btn').prop('disabled', true);
                  
                      setTimeout(function() {
                            $("#edit-photo-alert-success").addClass('d-none');
                            window.location.reload();
                          }, 1000);
                        },
                    error: function(jqXHR, textStatus, errorThrown){
                      $('#save-new-profile-pic-btn').prop('disabled', false);
                    }
                  })
            })


    $('#currentPassword').on('input', function(){
      let password = $(this).val();

      $.ajax({
        url: '/kapcco/auth/check-password/', 
        method: 'GET',
        data: { password: password },
        success: function (response) {
          $('#password-error').removeClass('text-danger');
          $('#password-error').addClass('text-success');
          $('#password-error').text(response.message);

          $('#newPassword').removeAttr('disabled');
          $('#renewPassword').removeAttr('disabled');
          $('#change-password-btn').removeAttr('disabled');

        },
        error: function(jqXHR, textStatus, errorThrown){
          if(jqXHR.status === 401){
            $('#password-error').removeClass('text-success');
            $('#password-error').addClass('text-danger');
            $('#password-error').text(jqXHR.responseJSON.message);

            $('#newPassword').attr('disabled', true);
            $('#renewPassword').attr('disabled', true);
            $('#change-password-btn').attr('disabled', true);
          }
        }
      })
    })        



    $('#nin').on('input', function(){
          let ninValue = $(this).val();

          $.ajax({
            method: 'post',
            url: '/kapcco/auth/check-nin/',
            data: {nin : ninValue},
            success: function(response){
              $('#nin-status').text(response.message);
            },
            error: function(jqXHR, textStatus, errorThrown){
              $('#nin-status').text(jqXHR.responseJSON.message);
              if(jqXHR.responseJSON.status === 401){
                $('#nin-status').text(jqXHR.responseJSON.message);
              }
            }
          })
        })

    $('#email').on('input', function(){
          let emailValue = $(this).val();

          $.ajax({
            method: 'post',
            url: '/kapcco/auth/check-email/',
            data: {email : emailValue},
            success: function(response){
              $('#email-status').text(response.message);
            },
            error: function(jqXHR, textStatus, errorThrown){
              $('#email-status').text(jqXHR.responseJSON.message);
              if(jqXHR.responseJSON.status === 401){
                $('#email-status').text(jqXHR.responseJSON.message);
              }
            }
          })
        })

    $('#image').on('change', function(){
          let formData = new FormData();
          formData.append('image', this.files[0]);

          $.ajax({
            method: 'post',
            url: '/kapcco/image-upload/',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){

              $('#image_url').val("http://localhost/kapcco/uploads/images/" + response);
              $('#profile-photo').attr('src', "http://localhost/kapcco/uploads/images/" + response);

            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('An Error occurred, failed to upload image')
            }
          })
        })


        $('#edit-profile-form').submit(function(e){
          e.preventDefault();

          if(this.checkValidity() === true){

              let formData = $(this).serialize();

              $.ajax({
                method: 'post',
                url: '/kapcco/auth/update-profile/',
                data: formData,
                success: function(response){
                  $('#alert-profile-upadte-success').removeClass('d-none');
                  $('#alert-profile-upadte-success').addClass('show');
                  $('#alert-profile-upadte-success span').text(response.message);

                      setTimeout(function(){
                      window.location.reload();
                    }, 3000)
                },
                error: function(jqXHR, textStatus, errorThrown){
                  if(jqXHR.status === 401){
                    alert('An Error Occured, Failled to update your profile data...');
                  }
                }
              })
            }
        })

        $('#password-change-form').submit(function(event) {
            var newPassword = $('#newPassword').val();
            var renewPassword = $('#renewPassword').val();

            if (newPassword !== renewPassword) {
           
              $('#renewPassword-feedback span').text('Passwords do not match.');
              event.preventDefault();
              

            } else {
              event.preventDefault()
              
              if(this.checkValidity() === true){

                  let formData = $(this).serialize();

                  $.ajax({
                    method: 'post',
                    url: '/kapcco/auth/change-password/',
                    data: formData,
                    success: function(response){
                      $('#alert-password-change-success').removeClass('d-none');
                      $('#alert-password-change-success').addClass('show');
                      $('#alert-password-change-success span').text(response.message);

                          setTimeout(function(){
                            window.location.replace("http://localhost/kapcco/auth/login/");
                        }, 3000)
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                      if(jqXHR.status === 401){
                        alert('An Error Occured, Failled to change your password');
                      }
                    }
                  })
              }
            }
          });

    let profileUpdateTimestamp = $("#last-update-timestamp").text();
    const momentTimestamp = moment(profileUpdateTimestamp);
    const relativeTime = momentTimestamp.fromNow();
    $("#last-update").text("updated " + relativeTime)

    })
</script>

    
</body>
</html>