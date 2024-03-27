@include('partials/header')

@include('partials/topBar');

@include('partials/leftPane');

<main id="main" class="main">
  <div id="loading-overlay">
    <div id="loading-indicator"></div>
  </div>
  <div class="pagetitle">
    <h1>Add New Collection</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/{{$appName}}/dashboard/">Dashboard</a></li>
        <li class="breadcrumb-item">Collections</li>
        <li class="breadcrumb-item active">Add New</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <form id="add-collection-form" class="row g-3 needs-validation my-3" novalidate>
      <div class="row g-1">
        <div class="col-lg-3 tour-step-1">

          @include('season')

          @include('selectBranchAndStore')

        </div>
        <div class="col-lg-4 tour-step-2">
          @include('farmerCollectionTable')
        </div>
        <div class="col-lg-5">
          <div class="card">
            <div class="card-body">
              <div class="card-title">Collection form</div>
              <div class="alert alert-info p-1">
                Select farmers from the list to add collections. Selecting more than one will save the same collection to all of them forexample if the quantity is similar.
              </div>

              <div id="alert-add-collection-success" class="alert alert-success d-none p-1">
                <span></span>
              </div>

              <div class="row">
                <div class="col-sm-6 tour-step-3">
                  <div>
                    <label for="product-type" class="fw-bold">Product Type</label>
                    <select name="product-type" id="product-type" class="form-control" required>
                      <option value="">Select product type</option>
                      @foreach($scales as $scale)
                      <option value="{{$scale['product_type']}}">{{$scale['product_type']}}</option>
                      @endforeach
                    </select>
                    <div class="invalid-feedback">Please select coffee type</div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="unit-price" class="fw-bold">Unit Price /kg</label>
                    <input type="number" id="unit-price" name="unit-price" readonly class="form-control" required>
                  </div>
                </div>
              </div>

              <div class="row mt-3">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="quantity" class="fw-bold">Quantity in Kilograms</label>
                    <input type="number" id="quantity" name="quantity" class="form-control" required>
                    <div class="invalid-feedback">Please enter quantity</div>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="total" class="fw-bold">Total Amount</label>
                    <input type="number" id="total" name="total-amount" class="form-control" required readonly>
                  </div>
                </div>
              </div>

              <fieldset class="row mb-3 mt-3">
                <label for="" class="fw-bold">Mark collection as</label>
                <div class="col-sm-4">
                  <div class="form-check tour-step-4">
                    <input class="form-check-input" type="radio" name="payed" id="gridRadios1" value="1" checked="" required>
                    <label class="form-check-label" for="gridRadios1">
                      Payed
                    </label>
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="payed" id="gridRadios2" value="0">
                    <label class="form-check-label" for="gridRadios2">
                      Not payed
                    </label>
                  </div>
                </div>
              </fieldset>

              <button type="submit" class="btn btn-primary btn-sm mt-3 tour-step-5" disabled>Save Collection data</button>


            </div>
          </div>
        </div>
      </div>

    </form>
  </section>

</main><!-- End #main -->

@include('partials/footer')

<script>
  $(document).ready(function() {

    $('#parent-branch-drop-down').on('change', function() {

      var selectedBranch = $(this).val();

      $.ajax({
        url: '/kapcco/dashboard/zones/get-zones-by-id/',
        method: 'GET',
        data: {
          branch_id: selectedBranch
        },
        success: function(data) {

          $('#parent-store-drop-down').empty();
          $('#parent-store-drop-down').append('<option >Select Store</option>');


          $.each(data.stores, function(key, value) {
            $('#parent-store-drop-down').append('<option value="' + value.id + '">' + value.zone_name + '</option>');
          });
        },
        error: function(error) {
          console.log('Error fetching data:', error);
        }
      });
    });


    $('#parent-store-drop-down').on('change', function() {

      var selectedStore = $(this).val();

      showLoadingOverlay();

      $.ajax({
        url: '/kapcco/dashboard/zones/get-farmers-by-store-id/',
        method: 'GET',
        data: {
          store_id: selectedStore
        },
        success: function(data) {

          $('#farmers-to-allocate-table tbody').empty();

          $.each(data.farmers, function(key, value) {
            $('#farmers-to-allocate-table tbody').append(
              '<tr>' +
              '<td><input type="checkbox" class="row-select" value="' + value.user_id + '"></td>' +
              '<td>' + '<img width="40px" height="40px" class="rounded-circle mx-3" src = "' + value.image_url + '">' + value.fullname + '</td>' +
              '</tr>'
            );
          });

          hideLoadingOverlay();
        },
        error: function(error) {
          console.log('Error fetching data:', error);
          hideLoadingOverlay();
        }
      });
    });

    $('#product-type').change(function() {

      let productTypeId = $(this).val();
      showLoadingOverlay();

      $.ajax({
        url: '/kapcco/dashboard/colllections/get-product-unit-price/',
        method: 'GET',
        data: {
          productTypeId: productTypeId
        },
        success: function(response) {

          $('#unit-price').val(response.price);
          hideLoadingOverlay();
        },
        error: function(error) {
          console.error('Error fetching price:', error);
          hideLoadingOverlay();
        }
      });
    });

    $('#quantity').on('input', function() {

      let quantity = $(this).val();
      let unitPrice = $("#unit-price").val();

      let total = quantity * unitPrice;

      $('#total').val(total);
    });


    // Array to hold checked checkbox values
    let selectedValues = [];

    $('#add-collection-form').submit(function(e) {
      e.preventDefault();

      if (this.checkValidity() === true) {

        let formData = $(this).serialize();

        $('#farmers-to-allocate-table input.row-select:checked').each(function() {
          selectedValues.push($(this).val());
        });

        let idsString = encodeURIComponent(JSON.stringify(selectedValues));
        formData += '&checkedFarmers=' + idsString;

        $('button[type="submit"]').prop('disabled', true);

        $.ajax({
          method: 'post',
          url: '/kapcco/dashboard/colllections/add/',
          data: formData,
          success: function(response) {
            $('#add-collection-form #quantity').val('0')

            $('button[type="submit"]').prop('disabled', true);

            $('#alert-add-collection-success').removeClass('d-none')
            $('#alert-add-collection-success').addClass('show')
            $('#alert-add-collection-success span').text(response.message)

            selectedValues.length = 0;

            setTimeout(function() {
              $('#alert-add-collection-success').removeClass('show')
              $('#alert-add-collection-success').addClass('d-none')
            }, 3000)

          },
          error: function() {
            $('button[type="submit"]').prop('disabled', false);
          }

        })
      }
    })

    // Event listener for the quantity input change
    $('#quantity').on('input', function() {
      // Get the quantity value
      var quantityValue = $(this).val();

      // Enable/disable the submit button based on the quantity value
      if (quantityValue > 0) {
        $('button[type="submit"]').prop('disabled', false);
      } else {
        $('button[type="submit"]').prop('disabled', true);
      }
    });


    const seasonEndDate = $("#set-season-end-date").val();

    let startDate = moment(new Date());
    let endDate = moment(seasonEndDate);

    // Calculate the difference in milliseconds
    let duration = moment.duration(endDate.diff(startDate));

    // Format and display the remaining time
    let days = Math.floor(duration.asDays());
    let hours = duration.hours();
    let minutes = duration.minutes();
    let seconds = duration.seconds();

    $("#time-remaining").text('Remaining time: ' + days + ' days.')
  })
</script>

<script>
  const tour = new Shepherd.Tour({
    useModalOverlay: true,
    defaultStepOptions: {
      classes: 'shadow-md bg-purple-dark',
      scrollTo: true
    }
  });

  tour.addStep({
    id: 'step-0',
    text: '<h4><strong>Hello {{$username}}, Take a brief tour on how to add collections to your store</strong></h4> <h6>I will guide you through a few steps to achieve this task</h6>',
    buttons: [{
      text: 'No, I already no',
      action: tour.cancel,
      classes: 'shepherd-button-secondary',
    }, {
      text: 'Yeah, Lets Start',
      action: tour.next,
    }],
  });

  tour.addStep({
    id: 'step-1',
    text: 'To record collections, set the current season if there is no season which is running, then proceed and select the branch, after select the store to get a list of approved farmers',
    attachTo: {
      element: 'div.tour-step-1', // Target the element you want to highlight
      on: 'bottom',
    },
    buttons: [{
      text: 'Back',
      action: tour.back,
      classes: 'shepherd-button-secondary',
    }, {
      text: 'Next',
      action: tour.next,
    }],
  });

  tour.addStep({
    id: 'step-2',
    text: 'All Farmers you assigned to the store you selected will appear in this table, you can use the checkboxes to select the farmer, you can select one or many if the quantity to record is the same for each, then proceed',
    attachTo: {
      element: 'div.tour-step-2', // Target the element you want to highlight
      on: 'top',
    },
    buttons: [{
      text: 'Back',
      action: tour.back,
      classes: 'shepherd-button-secondary',
    }, {
      text: 'Next',
      action: tour.next,
    }],
  });

  tour.addStep({
    id: 'step-3',
    text: 'Then select the product type from this drop down, this will fetch the unit price automatically.. then go ahead and add the quantiy, this will calculate the total amount automatically basing on the unit price',
    attachTo: {
      element: 'div.tour-step-3', // Target the element you want to highlight
      on: 'bottom',
    },
    buttons: [{
      text: 'Back',
      action: tour.back,
      classes: 'shepherd-button-secondary',
    }, {
      text: 'Next',
      action: tour.next,
    }],
  });

  tour.addStep({
    id: 'step-4',
    text: 'You can then mark this collection as paid if you have paid the farmer, or mark it as not paid if no payment is made, then proceed <strong>Please note that this will be the same for all farmers you selected</strong>',
    attachTo: {
      element: 'div.tour-step-4', // Target the element you want to highlight
      on: 'bottom',
    },
    buttons: [{
      text: 'Back',
      action: tour.back,
      classes: 'shepherd-button-secondary',
    }, {
      text: 'Next',
      action: tour.next,
    }],
  });

  tour.addStep({
    id: 'step-5',
    text: 'Click this button to save the record... Please note that this will save this record agains all the farmers you have selected.',
    attachTo: {
      element: 'button.tour-step-5', // Target the element you want to highlight
      on: 'top',
    },
    buttons: [{
      text: 'Back',
      action: tour.back,
      classes: 'shepherd-button-secondary',
    }, {
      text: 'Next',
      action: tour.next,
    }],
  });

  tour.addStep({
    id: 'step-6',
    text: 'Follow these steps in order to record collections for your store.',
    buttons: [{
      text: 'Back',
      action: tour.back,
      classes: 'shepherd-button-secondary',
    }, {
      text: 'Got It',
      action: function() {
        setCookie('addCollectionTourFinished', 'true', 7); // Set cookie with expiry of 7 days
        tour.complete();
      },
    }],
  });

  document.addEventListener('DOMContentLoaded', function() {
    if (getCookie('addCollectionTourFinished') === 'true') {
      tour.cancel();
    } else {
      tour.start();
    }
  });
</script>