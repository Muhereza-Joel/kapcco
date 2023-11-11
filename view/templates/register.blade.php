@include('partials/header')
<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-7 col-md-7 d-flex flex-column align-items-center justify-content-center">

            <div class="d-flex justify-content-center py-4">
                <a href="/{{$appName}}" class="logo d-flex align-items-center w-auto">
                    <img src="/{{$appName}}/assets/img/logo2.png" alt="kapcco logo" style="width: 200px;">
                    <span class="d-none d-lg-block">Coffee Store Management Information System</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                  <div id="invalid-registration" class="alert alert-danger alert-dismissible fade d-none p-1" role="alert">
                      <span class="text-center"></span>
                   </div>
                  <form id="registration-form" class="row g-3 needs-validation" novalidate>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Your Email</label>
                      <input type="email" name="email" class="form-control" id="yourEmail" required placeholder="Enter your email address here">
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="yourUsername" required placeholder="Enter a login username to use">
                        <div class="invalid-feedback">Please choose a username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required placeholder="Enter your password here">
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    
                    <div class="col-12">
                      <button id="submit-button" class="btn btn-primary w-100" type="submit">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">If you have an account already? <a href="/{{$appName}}/auth/login/">Click here</a> to login</p>
                    </div>
                  </form>

                </div>
                <div class="col-sm-6 pt-5 mt-3" style="border-left: 1px solid #999;">
                    <div class="col">
                        <h4 class="fw-bold text-info">Account notices</h4>
    
                        <h5 class="fw-bold text-dark">Collection center Information</h5>
                        With this account you will be able to view all collection centers where you can bring your coffee                        
                                                        
                        <h5 class="fw-bold text-dark mt-2">Account Approval</h5>
                        Once you sign up, your account will be pending until the validation ends and laiter it will be active
                         
                        <div class="alert alert-warning mt-2">
                           <strong>Note your username and password,</strong> because you will use it all the time to login to your account
                        </div>
                     
                    </div>
                </div>
              </div>

            </div>
                </div>
                        
            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  @include('partials/footer')

  <script>
    $(document).ready(function(){
       $('#registration-form').submit(function(e){
          e.preventDefault();

          let formData = $(this).serialize();

          $.ajax({
            method: 'post',
            url: '/kapcco/auth/create-account/',
            data: formData,
            success: function(response){

              $('#invalid-registration').removeClass('alert-danger')
              $('#invalid-registration').removeClass('d-none')
              $('#invalid-registration').addClass('alert-success')
              $('#invalid-registration').addClass('show')
              $('#invalid-registration').fadeIn();
              $('#invalid-registration span').text(response.message);
              $('#submit-button').prop('disabled', 'true');

              setTimeout(function(){
                window.location.replace("http://localhost/kapcco/")
              }, 3000)

              
            },
            error: function(jqXHR, textStatus, errorThrown){
              if (jqXHR.status === 401) {
                $('#invalid-registration').removeClass('d-none')
                $('#invalid-registration').removeClass('alert-success')
                $('#invalid-registration').addClass('alert-danger')
                $('#invalid-registration').addClass('show')
                $('#invalid-registration').fadeIn();
                $('#invalid-registration span').text(jqXHR.responseJSON.message);

                setTimeout(function(){
                  $('#invalid-registration').fadeOut();
              }, 3000)
              }
            }
          })
       })
    })
  </script>