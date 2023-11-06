<?php echo $__env->make('partials/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-7 col-md-7 d-flex flex-column align-items-center justify-content-center">

            <div class="d-flex justify-content-center py-4">
                <a href="/<?php echo e($appName); ?>" class="logo d-flex align-items-center w-auto">
                    <img src="/<?php echo e($appName); ?>/assets/img/logo2.png" alt="kapcco logo" style="width: 200px;">
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

                  <form class="row g-3 needs-validation" novalidate>
                    <div class="col-12">
                      <label for="yourName" class="form-label">Your Name</label>
                      <input type="text" name="name" class="form-control" id="yourName" required placeholder="Enter your full name here">
                      <div class="invalid-feedback">Please, enter your name!</div>
                    </div>

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
                      <button class="btn btn-primary w-100" type="submit">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">If you have an account already? <a href="/<?php echo e($appName); ?>/">Click here</a> to login</p>
                    </div>
                  </form>

                </div>
                <div class="col-sm-6 pt-5 mt-3" style="border-left: 1px solid #999;">
                    <div class="col">
                        <h4 class="fw-bold text-info">Farmer account notices</h4>
    
                        <h5 class="fw-bold text-dark">Collection center Information</h5>
                        With this account you will be able to view all collection centers where you can bring your coffee
                        <h5 class="fw-bold text-dark mt-2">Collection Information</h5>
                        With this account you will be able to view you supplies to the cooperative.

                                                    
                                                        
                        <h5 class="fw-bold text-dark mt-2">Account Approval</h5>
                        Once you sign up, your account will be pending until the validation ends and laiter it will be active
                                                  
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

  <?php echo $__env->make('partials/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>