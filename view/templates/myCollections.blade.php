@include('partials/header')

@include('partials/topBar');

@include('partials/leftPane');

<main id="main" class="main">
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        Your Stores
                    </div>

                    <div class="alert alert-info p-1">
                        Check any of the stores in the table to fetch your collections.
                    </div>

                    <div id="current-farmer" class="d-none">{{$userId}}</div>

                    <table id="stores-table" class="table table-striped">

                        <thead>
                            <tr>
                                <th>
                                    <div class="icon">
                                        <i class="bi bi-check-square-fill"></i>
                                    </div>
                                </th>

                                <th scope="col">Store Name</th>
                                <th scope="col">Parent Branch</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assignedStores as $store)
                            <tr>
                                <td>
                                    <input type="checkbox" class="row-select" value="{{$store['store_id']}}">
                                </td>
                                <td>{{$store['zone_name']}}</td>
                                <td>{{$store['branch_name']}}</td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card" style="position: sticky; top: 50px">
                <div class="card-body">
                    <div id="report-header" class="card-title fw-bold">Showing last {{count($lastCollections)}} collections, you supplied to your stores</div>
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
                            @foreach($lastCollections as $collection)
                            <tr>
                                <td><input type="checkbox" class="row-select" value="{{$collection['id']}}"></td>
                                <td><img width="40px" height="40px" class="rounded-circle mx-3" src="{{$collection['image_url']}}"></td>
                                <td>{{$collection['branch_name']}}</td>
                                <td>{{$collection['zone_name']}}</td>
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
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</main><!-- End #main -->


@include('partials/footer')

<script>
    $(document).ready(function() {
        var selectedStores = [];
        var maxSelection = 1;
        var currentFarmer = $("#current-farmer").text();

        $('#stores-table tbody').on('change', 'input.row-select', function() {
            var storeId = $(this).val();

            if (this.checked) {
                if (selectedStores.length >= maxSelection) {
                    this.checked = false;
                    alert('You can only fetch recods for one store per selection.');
                } else {
                    selectedStores.push(storeId);
                    getSelectedFarmerCollections(storeId, currentFarmer);
                }
            } else {
                selectedStores = selectedStores.filter(function(id) {
                    return id !== storeId;
                });
            }
        });

        function getSelectedFarmerCollections(store, farmerId) {
            $.ajax({
                url: '/kapcco/dashboard/zones/get-farmers-collections-only/',
                method: 'GET',
                data: {
                    store: store,
                    farmer_id: farmerId
                },

                success: function(data) {
                    $('#reports-table tbody').empty();

                    $.each(data.collections, function(key, value) {
                        $('#reports-table tbody').append(
                            '<tr>' +
                            '<td><input type="checkbox" class="row-select" value="' + value.user_id + '"></td>' +
                            '<td>' + '<img width="40px" height="40px" class="rounded-circle mx-3" src = "' + value.image_url + '"></td>' +
                            '<td>' + value.branch_name + '</td>' +
                            '<td>' + value.zone_name + '</td>' +
                            '<td>' + value.product_type + '</td>' +
                            '<td>' + value.unit_price + '</td>' +
                            '<td>' + value.quantity + '</td>' +
                            '<td>' + value.total_amount + '</td>' +
                            '<td>' + (value.payed == 1 ? '<span class="badge bg-dark">Payed</span>' : '<span class="badge bg-danger">Not Payed</span>') + '</td>' +
                            '</tr>'
                        );
                    });

                    $('#report-header').text('Your collection data for selected store')


                }
            })
        }
    })
</script>