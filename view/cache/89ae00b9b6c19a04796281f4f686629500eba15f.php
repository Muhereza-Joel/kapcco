<?php echo $__env->make('partials/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 
<?php echo $__env->make('partials/topBar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<?php echo $__env->make('partials/leftPane', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Reports</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/<?php echo e($appName); ?>/dashboard/">Dashboard</a></li>
          <li class="breadcrumb-item">Collections</li>
          <li class="breadcrumb-item active">Reports</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row g-3">
            <div class="col-lg-4">
                <?php echo $__env->make('selectBranchAndStore', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->make('farmerCollectionTable', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="col-lg-8">
                
                <div class="card" style="position: sticky; top: 50px">
                    <div class="card-body">
                        <div id="report-header" class="card-title fw-bold">Showing last <?php echo e(count($lastCollections)); ?> collections.</div>
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
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $__currentLoopData = $lastCollections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $collection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                  <td><input type="checkbox" class="row-select" value="<?php echo e($collection['id']); ?>"></td>
                                  <td><img width="40px" height="40px" class="rounded-circle mx-3" src = "<?php echo e($collection['image_url']); ?>"></td>
                                  <td><?php echo e($collection['branch_name']); ?></td>
                                  <td><?php echo e($collection['zone_name']); ?></td>
                                  <td><?php echo e($collection['product_type']); ?></td>
                                  <td><?php echo e($collection['unit_price']); ?></td>
                                  <td><?php echo e($collection['quantity']); ?></td>
                                  <td><?php echo e($collection['total_amount']); ?></td>
                                  <td>
                                    <?php if($collection['payed'] == 1): ?>
                                        <span class = "badge bg-dark">Payed</span>
                                        <?php else: ?>
                                          <span class = "badge bg-danger">Not Payed</span>
                                      <?php endif; ?>
                                  </td>
                                </tr>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>

  </main><!-- End #main -->

<?php echo $__env->make('partials/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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
                    '<td>' + (value.payed == 1 ? '<span class="badge bg-dark">Payed</span>' : '<span class="badge bg-danger">Not Payed</span>') + '</td>'+
                    '</tr>'
                );
                });

                $('#report-header').text('Collection data for seleted branch.')
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
                    '<td>' + (value.payed == 1 ? '<span class="badge bg-dark">Payed</span>' : '<span class="badge bg-danger">Not Payed</span>') + '</td>'+
                    '</tr>'
                );
                });

                $('#report-header').text('Collection data for seleted branch and store.')


       },
       error: function (error) {
         console.log('Error fetching data:', error);
       }
     });
   });


    })
</script>