<div class="card">
  <div class="card-body">
    <h5 class="card-title">Edit Store Details</h5>
    <div id="create-at-timestamp" class="d-none"><?php echo e($zoneDetails['created_at']); ?></div>
    <div id="last-update-timestamp" class="d-none"><?php echo e($zoneDetails['updated_at']); ?></div>

    <div>
      <span id="added-at" class="badge bg-secondary ml-3"></span>
      <?php if($zoneDetails['created_at'] != $zoneDetails['updated_at']): ?>
      <span id="last-update" class="badge bg-dark ml-3"></span>
      <?php endif; ?>
    </div>

    <!-- Vertical Form -->
    <form id="edit-zone-form" class="row g-3 needs-validation pt-2" novalidate>
      <div id="edit-zone-success-alert" class="alert alert-success alert-dismissible fade d-none p-1" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        <span></span>

      </div>
      <div class="col-12">
        <input type="hidden" name="zone-id-to-edit" value="<?php echo e($zoneDetails['id']); ?>">
        <label for="zone-name" class="form-label fw-bold">Store Name</label>
        <input value="<?php echo e($zoneDetails['zone_name']); ?>" oninput="capitalizeEveryWord(this)" type="text" class="form-control p-1" name="zone-name" id="zone-name" required placeholder="Enter zone name">
        <div class="invalid-feedback">Please enter store name.</div>
      </div>
      <div class="col-12">
        <label for="zone-location" class="form-label fw-bold">Store Location</label>
        <input value="<?php echo e($zoneDetails['zone_location']); ?>" oninput="capitalizeEveryWord(this)" type="text" class="form-control p-1" name="zone-location" id="zone-location" required placeholder="Enter zone location">
        <div class="invalid-feedback">Please enter store location.</div>
      </div>

      <div class="col-12">
        <label for="parent-branch" class="form-label fw-bold">Parent Branch</label>
        <select name="parent-branch" id="parent-branch" class="form-control p-1" required>
          <option value="">No branch selected</option>
          <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($branch['id']); ?>"><?php echo e($branch['branch_name']); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <div class="invalid-feedback">Please enter the parent branch.</div>

      </div>


      <div class="text-left">
        <div class="d-flex">
          <button type="submit" class="btn btn-primary btn-sm">Update details</button>
          <a href="/<?php echo e($appName); ?>/dashboard/zones/" class="btn btn-danger btn-sm mx-2">Cancel</a>

        </div>

      </div>
    </form><!-- Vertical Form -->

  </div>
</div>