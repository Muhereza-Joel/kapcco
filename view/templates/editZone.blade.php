<div class="card" style="background-color: rgb(223, 232, 225);">
                <div class="card-body">
                  <h5 class="card-title">Edit Zone Details</h5>
                  <div id="create-at-timestamp" class="d-none">{{$zoneDetails['created_at']}}</div>
                      <div id="last-update-timestamp" class="d-none">{{$zoneDetails['updated_at']}}</div>

                      <div>
                        <span id="added-at" class="badge bg-secondary ml-3"></span>
                          @if($zoneDetails['created_at'] != $zoneDetails['updated_at'])
                            <span id="last-update" class="badge bg-dark ml-3"></span>
                          @endif
                      </div>
    
                  <!-- Vertical Form -->
                  <form id="edit-zone-form" class="row g-3 needs-validation pt-2" novalidate>
                  <div id="edit-zone-success-alert" class="alert alert-success alert-dismissible fade d-none p-1" role="alert">
                        <i class="bi bi-check-circle me-1"></i>
                          <span></span>
                
                      </div>
                    <div class="col-12">
                      <input type="hidden" name="zone-id-to-edit" value="{{$zoneDetails['id']}}">  
                      <label for="zone-name" class="form-label fw-bold">Zone Name</label>
                      <input value="{{$zoneDetails['zone_name']}}" oninput="capitalizeEveryWord(this)" type="text" class="form-control p-1" name="zone-name" id="zone-name" required placeholder="Enter zone name">
                      <div class="invalid-feedback">Please enter zone name.</div>
                    </div>
                    <div class="col-12">
                      <label for="zone-location" class="form-label fw-bold">Zone Location</label>
                      <input value="{{$zoneDetails['zone_location']}}" oninput="capitalizeEveryWord(this)" type="text" class="form-control p-1" name="zone-location" id="zone-location" required placeholder="Enter zone location">
                      <div class="invalid-feedback">Please enter zone location.</div>
                    </div>
    
                    <div class="col-12">
                      <label for="parent-branch" class="form-label fw-bold">Parent Branch</label>
                      <select name="parent-branch" id="parent-branch" class="form-control p-1" required>
                        <option value="" >No branch selected</option>
                        @foreach($branches as $branch)
                            <option value="{{$branch['id']}}">{{$branch['branch_name']}}</option>
                        @endforeach
                      </select>
                      <div class="invalid-feedback">Please enter the parent branch.</div>
                      
                    </div>
                  
                    
                    <div class="text-left">
                      <div class="d-flex">
                        <button type="submit" class="btn btn-primary btn-sm">Update Zone</button>
                        <a href="/{{$appName}}/dashboard/zones/" class="btn btn-danger btn-sm mx-2">Cancel</a>

                      </div>
                      
                    </div>
                  </form><!-- Vertical Form -->
    
                </div>
              </div>