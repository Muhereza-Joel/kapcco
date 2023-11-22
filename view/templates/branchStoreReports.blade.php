@include('partials/header')
 
@include('partials/topBar');

@include('partials/leftPane');

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Reports</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/{{$appName}}/dashboard/">Dashboard</a></li>
          <li class="breadcrumb-item">Collections</li>
          <li class="breadcrumb-item active">Reports</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-sm-4">
                @include('selectBranchAndStore')
                @include('farmerCollectionTable')
            </div>
            <div class="col-sm-8">
                
                <div class="card" style="position: sticky; top: 50px">
                    <div class="card-body">
                        <div id="report-header" class="card-title fw-bold"></div>
                        <table class="table table-striped datatable" id="reports-table">
                            <thead>
                                <tr>
                                    <th>
                                    <div class="icon">
                                    <i class="bi bi-check-square-fill"></i>
                                    
                                    </div>
        
                                    </th>
                                    <th scope="col">Client</th>
                                    <th scope="col">Branch</th>
                                    <th scope="col">Store</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>

  </main><!-- End #main -->

@include('partials/footer')

<script>
    $(document).ready(function(){
        $('#parent-branch-drop-down').on('change', function () {
    
            var selectedBranch = $(this).val();

            $.ajax({
            url: '/kapcco/dashboard/zones/get-zones-by-id/', 
            method: 'GET',
            data: { branch_id: selectedBranch },
            success: function (data) {
            
                $('#parent-store-drop-down').empty();
                $('#parent-store-drop-down').append('<option >Select Store</option>');

            
                $.each(data.stores, function (key, value) {
                $('#parent-store-drop-down').append('<option value="' + value.id + '">' + value.zone_name + '</option>');
                });

                $('#reports-table tbody').empty();

                $.each(data.collections, function (key, value) {
                $('#reports-table tbody').append(
                    '<tr>' +
                    '<td><input type="checkbox" class="row-select" value="' + value.user_id + '"></td>' +
                    '<td>'+ '<img width="40px" height="40px" class="rounded-circle mx-3" src = "'+value.image_url+'"></td>' +
                    '<td>' + value.branch_name + '</td>' +
                    '<td>' + value.zone_name + '</td>' +
                    '<td>' + value.product_type + '</td>' +
                    '<td>' + value.unit_price + '</td>' +
                    '<td>' + value.quantity + '</td>' +
                    '<td>' + value.total_amount + '</td>' +
                    '</tr>'
                );
                });

                $('#report-header').text('Collection data for seleted branch in the current season')
            },
            error: function (error) {
                console.log('Error fetching data:', error);
            }
            });
        });

        $('#parent-store-drop-down').on('change', function () {
     
     var selectedStore = $(this).val();

    
     $.ajax({
       url: '/kapcco/dashboard/zones/get-farmers-by-store-id/', 
       method: 'GET',
       data: { store_id: selectedStore },
       success: function (data) {
        
         $('#farmers-to-allocate-table tbody').empty();

         $.each(data.farmers, function (key, value) {
           $('#farmers-to-allocate-table tbody').append(
             '<tr>' +
               '<td><input type="checkbox" class="row-select" value="' + value.user_id + '"></td>' +
               '<td>'+ '<img width="40px" height="40px" class="rounded-circle mx-3" src = "'+value.image_url+'">' + value.fullname + '</td>' +
             '</tr>'
           );
         });

         $('#reports-table tbody').empty();

                $.each(data.collections, function (key, value) {
                $('#reports-table tbody').append(
                    '<tr>' +
                    '<td><input type="checkbox" class="row-select" value="' + value.user_id + '"></td>' +
                    '<td>'+ '<img width="40px" height="40px" class="rounded-circle mx-3" src = "'+value.image_url+'"></td>' +
                    '<td>' + value.branch_name + '</td>' +
                    '<td>' + value.zone_name + '</td>' +
                    '<td>' + value.product_type + '</td>' +
                    '<td>' + value.unit_price + '</td>' +
                    '<td>' + value.quantity + '</td>' +
                    '<td>' + value.total_amount + '</td>' +
                    '</tr>'
                );
                });

                $('#report-header').text('Collection data for seleted branch and store in the current season')


       },
       error: function (error) {
         console.log('Error fetching data:', error);
       }
     });
   });


    })
</script>