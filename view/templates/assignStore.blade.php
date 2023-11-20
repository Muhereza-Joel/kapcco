<div class="card" >
                  <div class="card-body">
                    <div class="card-title">Allocate This Farmer Stores</div>
                    
  
                    <div class="d-flex justify-content-center mb-3">
                            <img src="{{$userDetails['image_url']}}" class="rounded-circle" alt="" width="150px" height="150px" style="object-fit: cover; border: 3px solid #fff;">
                        </div>
      
                        <div class="row">
                          <div class="col-lg-5 col-md-5 label fw-bold ">Full Name</div>
                          <div class="col-lg-7 col-md-7 form-control mb-2">{{$userDetails['fullname']}}</div>
                        </div>
  
                        <div class="alert alert-info p-1">
                          When recording collections, this farmer will be attached stores assigned.
                      </div>
                      <div id="alert-assignment-success" class="alert alert-success d-none p-1">
                        <span></span>
                      </div>
                        <div id="farmer-to-assign" class="d-none">{{$userDetails['user_id']}}</div>
                        <div class="card"><button id="save-assignment-btn" class="btn btn-primary btn-sm " style="display: none;">Save</button></div>
                    <table id="store-to-allocate-table" class="table table-striped p-0">
                      <div class="table-header fw-bold">Stores to allocate</div>
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
                        @foreach($storesToAssign as $store)
                          <tr>
                            <th>
                                <input type="checkbox" class="row-select" value="{{$store['store_id']}}">
                            </th>
                            <td>{{$store['zone_name']}}</td>
                            <td>{{$store['branch_name']}}</td>
  
                          </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                  </div> 
</div>


                  <div class="card">
                    <div class="card-body">
                        <div class="card-title">Allocated Stores</div>
                    <table id="store-to-allocate-table" class="table table-striped">
                      
                      <thead>
                        <tr>
                        
                    
                        <th scope="col">Store Name</th>
                        <th scope="col">Parent Branch</th>
                       
                      </tr>
                      </thead>
                      <tbody>
                        @foreach($assignedStores as $store)
                          <tr>
                           
                            <td>{{$store['zone_name']}}</td>
                            <td>{{$store['branch_name']}}</td>
  
                          </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                  </div>
                  