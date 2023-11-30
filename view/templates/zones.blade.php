@include('partials/header')

@include('partials/topBar');

@include('partials/leftPane');

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Stores</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/{{$appName}}/dashboard/">Dashboard</a></li>
        <li class="breadcrumb-item">stores</li>
        <li class="breadcrumb-item active">All</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-9">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Showing All Stores</h5>

            <!-- Table with stripped rows -->
            <table class="table table-striped datatable">
              <thead>
                <tr>
                  <th scope="col">SNo</th>
                  <th scope="col">Zone Name</th>
                  <th scope="col">Zone Location</th>
                  <th scope="col">Branch</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($zones as $zone)
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $zone['zone_name'] }}</td>
                  <td>{{ $zone['zone_location'] }}</td>
                  <td>
                    @if($zone['parent_branch'] != "")
                    @foreach($branches as $branch)
                    @if($branch['id'] == $zone['parent_branch'])
                    {{ $branch['branch_name'] }}

                    @endif

                    @endforeach

                    @else
                    <span class="badge bg-info">Branch Deleted</span>

                    @endif
                  </td>
                  <td><span class="badge bg-success">{{ $zone['status'] }}</span></td>
                  <td>
                    <div class="d-flex">
                      <a href="?action=edit&id={{$zone['id']}}" class="btn btn-secondary btn-sm p-1"><i class="bi bi-pencil-square"></i></a>
                      <a href="?action=delete&id={{$zone['id']}}" class="btn btn-danger btn-sm mx-1 p-1"><i class="bi bi-trash3"></i></a>
                    </div>
                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>
            <!-- End Table with stripped rows -->

          </div>
        </div>
      </div>


      <div class="col-lg-3">
        <div style="position: sticky; top: 100px;">
          <div id="edit-zone-container">
            @if($action == 'edit')
            @include('editZone')
            @endif

          </div>

          <div id="delete-zone-container">
            @if($action == 'delete')
            @include('deleteZone')
            @endif
          </div>

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add New Store</h5>

              <!-- Vertical Form -->
              <form id="add-zone-form" class="row g-3 needs-validation" novalidate>
                <div id="add-zone-success-alert" class="alert alert-success alert-dismissible fade d-none p-1" role="alert">
                  <i class="bi bi-check-circle me-1"></i>
                  <span></span>

                </div>
                <div class="col-12">
                  <label for="zone-name" class="form-label">Store Name</label>
                  <input oninput="capitalizeEveryWord(this)" type="text" class="form-control p-1" name="zone-name" id="zone-name" required placeholder="Enter store name">
                  <div class="invalid-feedback">Please enter store name.</div>
                </div>
                <div class="col-12">
                  <label for="zone-location" class="form-label">Zone Location</label>
                  <input oninput="capitalizeEveryWord(this)" type="text" class="form-control p-1" name="zone-location" id="zone-location" required placeholder="Enter store location">
                  <div class="invalid-feedback">Please enter store location.</div>
                </div>

                <div class="col-12">
                  <label for="parent-branch" class="form-label">Parent Branch</label>
                  <select name="parent-branch" id="parent-branch" class="form-control p-1" required>
                    <option value="">No branch selected</option>
                    @foreach($branches as $branch)
                    <option value="{{$branch['id']}}">{{$branch['branch_name']}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">Please enter the parent branch.</div>

                </div>


                <div class="text-left">
                  <button type="submit" class="btn btn-primary btn-sm">Submit</button>

                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>

        </div>
      </div>


    </div>
  </section>

</main><!-- End #main -->

<script>
  function capitalizeFirstLetter(input) {
    input.value = input.value.charAt(0).toUpperCase() + input.value.slice(1);
  }

  function capitalizeEveryWord(input) {
    var words = input.value.split(' ');

    for (var i = 0; i < words.length; i++) {
      words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
    }

    input.value = words.join(' ');
  }
</script>

@include('partials/footer')

<script>
  $(document).ready(function() {
    $('#add-zone-form').submit(function(e) {
      e.preventDefault();

      if (this.checkValidity() === true) {
        let formData = $(this).serialize();

        $.ajax({
          method: 'post',
          url: '/kapcco/dashboard/zones/add/',
          data: formData,
          success: function(response) {

            $('#add-zone-success-alert').removeClass('d-none');
            $('#add-zone-success-alert').addClass('show');
            $('#add-zone-success-alert span').text(response.message);

            setTimeout(function() {
              window.location.reload();
            }, 2000)
          },
          error: function() {}
        })

      }
    })

    $('#edit-zone-form').submit(function(e) {
      e.preventDefault();

      if (this.checkValidity() === true) {
        let formData = $(this).serialize();
        $.ajax({
          method: 'post',
          url: '/kapcco/dashboard/zones/edit/',
          data: formData,
          success: function(response) {
            $('#edit-zone-success-alert').removeClass('d-none');
            $('#edit-zone-success-alert').addClass('show');
            $('#edit-zone-success-alert span').text(response.message);

            setTimeout(function() {
              window.location.reload();
            }, 2000)
          },
          error: function() {}
        })
      }
    })

    $('#delete-zone-form').submit(function(e) {
      e.preventDefault();

      let formData = $(this).serialize();

      $.ajax({
        method: 'post',
        url: '/{{$appName}}/dashboard/zones/delete/',
        data: formData,
        success: function(response) {
          $('#delete-zone-success-alert').removeClass('d-none');
          $('#delete-zone-success-alert').addClass('show');
          $('#delete-zone-success-alert span').text(response.message);

          setTimeout(function() {
            window.location.replace("http://localhost/kapcco/dashboard/zones/");
          }, 2000)
        },
        error: function() {}
      })
    })

    let zoneCreateTimestamp = $("#create-at-timestamp").text();
    const addedTimestamp = moment(zoneCreateTimestamp);
    const relativeTimeWhenAdded = addedTimestamp.fromNow();
    $("#added-at").text("added " + relativeTimeWhenAdded);



    let zoneUpdateTimestamp = $("#last-update-timestamp").text();
    const momentTimestamp = moment(zoneUpdateTimestamp);
    const relativeTime = momentTimestamp.fromNow();
    $("#last-update").text("updated " + relativeTime)


  })
</script>