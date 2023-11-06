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
                                    <img src="assets/img/logo2.png" alt="kapcco logo" style="width: 200px;">
                                    <span class="d-none d-lg-block mt-3">Coffe Store Management Information System</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-sm-6">

                                            <div class="pt-4 pb-2">
                                                <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                                <p class="text-center small">Enter your username & password to login</p>
                                            </div>

                                            <form class="row g-3 needs-validation" novalidate>

                                                <div class="col-12">
                                                    <label for="yourUsername" class="form-label">Username</label>
                                                    <div class="input-group has-validation">
                                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                                                        <div class="invalid-feedback">Please enter your username.</div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <label for="yourPassword" class="form-label">Password</label>
                                                    <input type="password" name="password" class="form-control" id="yourPassword" required>
                                                    <div class="invalid-feedback">Please enter your password!</div>
                                                </div>

                                                <div class="col-12">
                                                    <button class="btn btn-primary w-100" type="submit">Login</button>
                                                </div>
                                                <div class="col-12">
                                                    <p class="small mb-0">If you don't have account? <a href="/<?php echo e($appName); ?>/register/">click here to</a> create an account</p>
                                                </div>
                                            </form>
                                        </div>


                                        <div class="col-sm-6 text-secondary pt-5 mt-3" style="border-left: 1px solid #999;">
                                            <div class="col">
                                                <h4 class="fw-bold text-info">Keep your account Secure</h4>

                                                <h5 class="fw-bold text-dark">Password Safety</h5>
                                                Do not share your password or have it stored on a browser by default unless necessary.
                                                
                                                       
                                                <h5 class="fw-bold text-dark mt-2">Always Logout</h5>
                                                Once done, always logout so that no one gains access to your account without your knowledge.
                                                  
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