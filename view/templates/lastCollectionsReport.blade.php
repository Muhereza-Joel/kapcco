<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kapcco Collections Report</title>
    <style>
        body {
            background-color: #fcfdfe;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            background-color: #075E54;
            color: #ffffff;
        }

        .logo {
            flex-grow: 1;
            /* Fill available space */
            max-width: 80px;
            /* Limit max width */
        }

        .contact-info {
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            page-break-inside: avoid;
            /* Prevent table from breaking across pages */
        }

        /* tr th{
            background-color: black;
            color: #ffffff;
            height: 10px;
        } */

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .document-header {
            text-decoration: underline;
            font-size: 20px;
            color: #075E54;
        }

        /* Color rows based on status */
        tbody tr {
            background-color: #ffffff; /* Default background color */
        }

        tr.not-payed {
            background-color: #801818;
            color: #ffffff; /* Custom background color for "Not Payed" rows */
        }

        @media print {
            .container {
                page-break-after: always;
                /* Ensure header starts on a new page when printing */
            }
        }

        
    </style>
</head>

<body>
    <div class="container">
        
        <div class="contact-info">
            <img src="/{{$appName}}/assets/img/logo2.png" alt="kapcco logo" class="logo">
            <h1>Karangura Peak Coffee Farmers Cooperative</h1>
            <span>Fortportal Tourism City, Kitumba Kyabwire village</span><br>
            <span>Tel: +256 753172862</span><br>
            <span>Email: info@karangurapeakcoffee.org</span>
            <br>
            <h4 class="document-header">
                Collections Report
            </h4>
        </div>
    </div>
    <table>
        <thead class="thead">
            <tr>
                <th>Client</th>
                <th>Branch</th>
                <th>Store</th>
                <th>Product</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Status</th>
                <th>Added On</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lastCollections as $collection)
            <tr class="@if($collection['payed'] != 1) not-payed @endif">
                <td>{{$collection['fullname']}}</td>
                <td>{{$collection['branch_name']}}</td>
                <td>{{$collection['zone_name']}}</td>
                <td>{{$collection['product_type']}}</td>
                <td>{{$collection['unit_price']}}</td>
                <td>{{$collection['quantity']}}</td>
                <td>{{$collection['total_amount']}}</td>
                <td>
                    @if($collection['payed'] == 1)
                    <span>Payed</span>
                    @else
                    <span>Not Payed</span>
                    @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($collection['created_at'])->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</body>

</html>
