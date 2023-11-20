<?php if(!$currentSeason['id']): ?>

          <div class="card">
            <div class="card-body">
              <div class="card-title"></div>
              <div class="alert alert-danger fw-bold">You have not set the current season.</div>
            </div>
          </div>
          <?php else: ?>
          <div class="card">
            <div class="card-body">
              <div class="card-title">Current Season</div>
              <div class="form-group">
                <label for="" class="label fw-bold">Runs From</label>
                <input id="set-season-start-date" type="text" value="<?php echo e($currentSeason['start_date']); ?>" class="form-control text-dark" readonly>
              </div>
              <div class="form-group my-3">
                <label for="" class="label fw-bold">Up To</label>
                <input id="set-season-end-date" type="text" value="<?php echo e($currentSeason['end_date']); ?>" class="form-control text-danger" readonly>
              </div>

              <div id="time-remaining" class="badge bg-dark"></div>
            </div>
          </div>

        <?php endif; ?>