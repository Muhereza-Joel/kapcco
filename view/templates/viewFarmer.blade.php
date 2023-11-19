<div class="card">
                      <div class="card-body" style=" position: sticky; top: 100px;">
                          <div class="card-title">Farmer Information.</div>
                          <div class="d-flex justify-content-center mb-3">
                              <img src="{{$userDetails['image_url']}}" class="rounded-circle" alt="" width="150px" height="150px" style="object-fit: cover; border: 3px solid #fff;">
                          </div>
        
                          <div class="row">
                            <div class="col-lg-5 col-md-5 label fw-bold ">Full Name</div>
                            <div class="col-lg-7 col-md-7 form-control mb-2">{{$userDetails['fullname']}}</div>
                          </div>
                          <div class="row">
                            <div class="col-lg-5 col-md-5 label fw-bold ">NIN Number</div>
                            <div class="col-lg-7 col-md-7 form-control mb-2">{{$userDetails['nin']}}</div>
                          </div>
        
                          <div class="row">
                            <div class="col-lg-5 col-md-5 label fw-bold ">Country</div>
                            <div class="col-lg-7 col-md-7 form-control mb-2">{{$userDetails['country']}}</div>
                          </div>
                          <div class="row">
                            <div class="col-sm-6">
                                <div class="col-lg-5 col-md-5 label fw-bold ">District</div>
                                <div class="col-lg-7 col-md-7 form-control mb-2">{{$userDetails['district']}}</div>

                            </div>
                            <div class="col-sm-6">
                                <div class="col-lg-5 col-md-5 label fw-bold ">Village</div>
                                <div class="col-lg-7 col-md-7 form-control mb-2">{{$userDetails['village']}}</div>

                            </div>
                          </div>

                          

                          <div class="row">
                            <div class="col-lg-5 col-md-5 label fw-bold ">Phone</div>
                            <div class="col-lg-7 col-md-7 form-control mb-2">{{$userDetails['phone']}}</div>
                          </div>
                      </div>
                    </div>