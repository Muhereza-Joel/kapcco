@include('partials/header')

<body>

    <main>
        <div class="container px-4">
             <!-- Profile Edit Form -->
             <form class="needs-validation" novalidate id="image-upload-form" enctype="multipart/form-data">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-10 col-md-10 d-flex flex-column align-items-center justify-content-center">

                            
                                 <img src="/{{$appName}}/assets/img/logo2.png" alt="kapcco logo" style="width: 200px;">
                                <h4 class="pt-2">Add Your Profile Information To Finish Setting Up Your Account</h4>
                                <h6 class="alert alert-info py-2 fw-bold">This profile information will be used in the system when we are recording collections, tracking your performance and to generate reports and other operations in 
                                the application. No part of this data will be modified by any party or used in other systems without your consent.
                                </h6>
                            

                            </div> 
                            <hr class="w-75">
                    </div>       

                            <section class="section profile">
      <div class="row">
        <div class="col-xl-1"></div>
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                    <div class="row mb-3">
                      
                      <div class="col-md-12 col-lg-12">
                  
                            <img id="profile-photo" src="/{{$appName}}/assets/img/avatar.png" class="rounded-circle" alt="Profile">
                            <div class="pt-2">
                            <input type="hidden" name="image_url" id="image_url">
                            <input  type="file" name="image" id="image" class="btn btn-outline btn-sm" required accept="image/jpeg">
                            <div class="invalid-feedback">Please choose a profile photo</div>
                            </div>

                      

                      </div>
                    </div>
              
            </div>
          </div>

        </div>

        <div class="col-xl-6">

          <div class="card">
            <div class="card-body pt-3">
             
                    

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control" id="fullName" placeholder="Enter your full name here" required>
                        <div class="invalid-feedback">Please enter your full name.</div>
                      </div>
                    </div>
                   
                   

                    <div class="row mb-3">
                      <label for="nin" class="col-md-4 col-lg-3 col-form-label">NIN Number</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="nin" type="text" class="form-control" id="nin" placeholder="Enter your nin number" required>
                        <div class="invalid-feedback">Please enter your national ID Number.</div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="country" type="text" class="form-control" id="Country" placeholder="Enter your home Country" required>
                        <div class="invalid-feedback">Please enter your home coutry.</div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Home District" class="col-md-4 col-lg-3 col-form-label">Home District</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="district" type="text" class="form-control" id="Home District" placeholder="Enter your home district" required>
                        <div class="invalid-feedback">Please enter your home district.</div>
                      </div>
                    </div>
                    
                    <div class="row mb-3">
                      <label for="village" class="col-md-4 col-lg-3 col-form-label">Village</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="district" type="text" class="form-control" id="village" placeholder="Enter the village you come from" required>
                        <div class="invalid-feedback">Please enter the village you come from.</div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" id="Phone" placeholder="Enter your phone number" required>
                        <div class="invalid-feedback">Please enter your phone number.</div>

                      </div>
                    </div>
                    
                    <div class="text-left pt-3">
                      <button type="submit" class="btn btn-primary btn-sm">Save Profile</button>
                      <a href="/{{$appName}}/" class="btn btn-danger btn-sm">Cancel</a>
                    </div>
                  

            </div>
          </div>

        </div>
      </div>
    </section>


                        </div>
                    
                </div>

            </section>
            </form><!-- End Profile Edit Form -->

        </div>
    </main><!-- End #main -->
    @include('partials/footer')