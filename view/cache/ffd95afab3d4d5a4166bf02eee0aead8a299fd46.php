<form id="delete-zone-form">
                <div class="card">
                  <div class="card-body">
                      <input type="hidden" value="<?php echo e($zoneDetails['id']); ?>" name="zone-to-delete">
                      <h5 class="card-title">Continue To Delete Store</h5>
                      <div id="delete-zone-success-alert" class="alert alert-success alert-dismissible fade d-none mt-3 p-1" role="alert">
                          <i class="bi bi-check-circle me-1"></i>
                            <span></span>
                  
                      </div>
                    <div class="my-1">You are about to delete <strong class="text-dark fw-bold"><?php echo e($zoneDetails['zone_name']); ?></strong> </div>
                    <div class="alert alert-info p-1">
                      Stores with farmers attached to them and have collections will not be deleted.
                    </div>
                    <div class="alert alert-danger alert-dismissible fade show p-1" role="alert">
                      Are you sure you want to delete this store ?. <strong>This will delete all associations to collections and farmers attached to this store to null.</strong>
                      
                    </div>
                    <div class="d-flex">
                    <button type="submit" class="btn btn-sm btn-danger">Yes, Delete Store</button>
                    <a href="/<?php echo e($appName); ?>/dashboard/zones/" class="btn btn-sm btn-primary mx-1">Cancel</a>
                    </div>
                  </div>
                </div>
              </form>