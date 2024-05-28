@include('partials/header')

@include('partials/topBar');

@include('partials/leftPane');

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Un Paid Collections</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/{{$appName}}/dashboard/">Dashboard</a></li>
                <li class="breadcrumb-item">Collections</li>
                <li class="breadcrumb-item active">Not Paid</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div id="loading-overlay">
        <div id="loading-indicator"></div>
    </div>
    <div class="row g-1">


        <div class="col-lg-12">
            <div class="card" style="position: sticky; top: 50px">
                <div class="card-body">
                    <div id="report-header" class="card-title fw-bold">Showing all un paid collections</div>
                    <table class="table table-striped datatable" id="up-paid-collections-table">
                        <thead>
                            <tr>
                                

                                <th scope="col">Branch</th>
                                <th scope="col">Store</th>
                                <th scope="col">Farmer</th>
                                
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($unPaidCollections as $collection)
                            <tr>
                                

                                <td>{{$collection['branch_name']}}</td>
                                <td>{{$collection['zone_name']}}</td>
                                <td><img width="40px" height="40px" class="rounded-circle mx-3" src="{{$collection['image_url']}}"> {{$collection['fullname']}}</td>
                                
                                <td>{{$collection['product_type']}}</td>
                                <td>{{$collection['unit_price']}}</td>
                                <td>{{$collection['quantity']}}</td>
                                <td>{{$collection['total_amount']}}</td>
                                <td>
                                    @if($collection['payed'] == 1)
                                    <span class="badge bg-dark">Payed</span>
                                    @else
                                    <span class="badge bg-danger">Not Payed</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($collection['created_at'])->format('d-m-Y') }}</td>
                                <td><a class="btn btn-success btn-sm" id="clear-collection-btn" href="/{{$appName}}/dashboard/colllections/up-paid/clear?id={{$collection['id']}}}">Clear</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</main><!-- End #main -->
<div class="modal fade" id="confirmClearModal" tabindex="-1" role="dialog" aria-labelledby="confirmClearModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="confirmClearModalLabel">Confirm Your Action</h5>

            </div>
            <div class="modal-body">
                <h6 class="text-dark">Are you sure you want to execute this action?</h6>
                <div class="alert alert-success p-1 mt-2">Note that this action will mark this collection as paid.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" id="cancel-btn" data-dismiss="modal">Cancel</button>
                <button type="button" id="confirmClearBtn" class="btn btn-success btn-sm">Yes, Clear Collection</button>
            </div>
        </div>
    </div>
</div>

@include('partials/footer')

<script>
    $(document).ready(function() {
        $('#up-paid-collections-table').on('click', '#clear-collection-btn', function(event) {
            event.preventDefault();

            var removeUrl = $(this).attr('href');

            $('#confirmClearModal').modal('show');
            $('#cancel-btn').click(function() {
                $('#confirmClearModal').modal('hide');

            })

            $('#confirmClearModal').on('click', '#confirmClearBtn', function() {
                $.post(removeUrl, function(response) {

                    setTimeout(function() {
                        window.location.reload();
                    }, 100)
                });
            });
        })
    })
</script>