@if(!isset($currentSeason['id']) || $currentSeason['id'] === null)

<div class="card">
  <div class="card-body">
    <div class="card-title"></div>
    <div class="alert alert-danger fw-bold">The current season is not set..</div>
  </div>
</div>
@else
<div class="card">
  <div class="card-body">
    <div class="card-title">Current Season</div>
    <div class="form-group">
      <label for="" class="label fw-bold">Runs From</label>
      <input type="hidden" name="current-season" value="{{$currentSeason['id']}}">
      <input id="set-season-start-date" type="text" value="{{$currentSeason['start_date']}}" class="form-control text-dark" readonly>
    </div>
    <div class="form-group my-3">
      <label for="" class="label fw-bold">Up To</label>
      <input id="set-season-end-date" type="text" value="{{$currentSeason['end_date']}}" class="form-control text-danger" readonly>
    </div>

    <div id="time-remaining" class="badge bg-dark"></div>
  </div>
</div>

@endif