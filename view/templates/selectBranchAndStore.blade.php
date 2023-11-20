<div class="card">
              <div class="card-body">
                <div class="form-group">
                  <label for="parent-branch-drop-down" class="card-title">Parent Branch</label>
                  <select name="parent-branch" id="parent-branch-drop-down" class="form-control">
                    <option value="">Select branch</option>
                    @foreach($branches as $branch)
                      <option value="{{$branch['id']}}">{{$branch['branch_name']}}</option>
                    @endforeach
  
                  </select>
                </div>
              </div>
            </div>
  
            <div class="card">
              <div class="card-body">
                <div class="form-group">
                  <label for="parent-store-drop-down" class="card-title">Stores</label>
                  <select name="parent-store" id="parent-store-drop-down" class="form-control">
                    <option value="">Select Store</option>
                  </select>
                </div>
              </div>
            </div>