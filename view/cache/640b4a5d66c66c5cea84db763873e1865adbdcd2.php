<div class="card" style="background-color: rgb(223, 232, 225);">
                  
                  <div class="card-body">
                      <h5 class="card-title">Update Branch Details</h5>
                      <div id="create-at-timestamp" class="d-none"><?php echo e($branchDetails['created_at']); ?></div>
                      <div id="last-update-timestamp" class="d-none"><?php echo e($branchDetails['updated_at']); ?></div>

                      <div>
                        <span id="added-at" class="badge bg-secondary ml-3"></span>
                        <span id="last-update" class="badge bg-dark ml-3"></span>
                      </div>
                      <!-- Vertical Form -->
                      <form class="needs-validation row g-3 pt-2" novalidate id="update-branch-form">
                      <div id="edit-branch-success-alert" class="alert alert-success alert-dismissible fade d-none p-1" role="alert">
                        <i class="bi bi-check-circle me-1"></i>
                          <span></span>
                
                      </div>
                      <div id="add-branch-success-alert" class="alert alert-success alert-dismissible fade d-none p-1" role="alert">
                        <i class="bi bi-check-circle me-1"></i>
                         <span></span>
                
                      </div>
                        <div class="col-12">
                          <input type="hidden" name="branch-edit-id" value="<?php echo e($branchDetails['id']); ?>">
                          <label for="branch-name" class="form-label fw-bold">Branch Name</label>
                          <input value="<?php echo e($branchDetails['branch_name']); ?>" oninput="capitalizeEveryWord(this)" name="branch-name" type="text" class="form-control" id="branch-name" placeholder="Enter branch name" required>
                          <div class="invalid-feedback">Please enter the branch name.</div>
                        </div>
                        <div class="col-12">
                          <label for="branch-location" class="form-label fw-bold">Branch Location</label>
                          <input value="<?php echo e($branchDetails['branch_location']); ?>" oninput="capitalizeEveryWord(this)" type="text" name="branch-location" class="form-control" id="branch-location" placeholder="Enter branch location" required>
                          <div class="invalid-feedback">Please enter the branch location.</div>
                        </div>
                       
                        
                        <div class="text-left mt-3">
                          <button type="submit" class="btn btn-primary btn-sm">Update Branch Details</button>
                          <a href="/<?php echo e($appName); ?>/dashboard/branches/" id="cancel-branch-update" class="btn btn-danger btn-sm mx-2">Cancel</a>
                          
                        </div>
                      </form><!-- Vertical Form -->
        
                    </div>
                </div>