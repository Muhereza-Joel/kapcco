<form id="delete-branch-form">
  <div class="card">
    <div class="card-body">
      <input type="hidden" value="{{$branchDetails['id']}}" name="branch-to-delete">
      <h5 class="card-title">Continue To Delete Branch</h5>
      <div id="delete-branch-success-alert" class="alert alert-success alert-dismissible fade d-none mt-3 p-1" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        <span></span>

      </div>
      <div class="my-1">You are about to delete <strong class="text-dark fw-bold">{{$branchDetails['branch_name']}}</strong> </div>
      <div class="alert alert-info p-1">
        Branches that have collections attached to them will not be deleted.
      </div>

      <div class="alert alert-danger alert-dismissible fade show p-1" role="alert">
        Are you sure you want to delete this branch? <strong>This will set the parent branch for all zones attached to this branch to null.</strong>


      </div>
      <div class="d-flex">
        <button type="submit" class="btn btn-sm btn-danger">Yes, Delete Branch</button>
        <a href="/{{$appName}}/dashboard/branches/" class="btn btn-sm btn-primary mx-1">Cancel</a>
      </div>
    </div>
  </div>
</form>