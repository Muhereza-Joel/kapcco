<div class="card">
  <div class="card-body">
    <div class="form-group">
      <label for="parent-branch-drop-down" class="card-title">Parent Branch</label>
      <select name="parent-branch" id="parent-branch-drop-down" class="form-control" required>
        <option>Select branch</option>
        <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($branch['id']); ?>"><?php echo e($branch['branch_name']); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      </select>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-body">
    <div class="form-group">
      <label for="parent-store-drop-down" class="card-title">Stores</label>
      <select name="parent-store" id="parent-store-drop-down" class="form-control" required>
        <option>Select Store</option>
      </select>
    </div>
  </div>
</div>