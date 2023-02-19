<!DOCTYPE html>
<html>
<head>
    <title>Transaction Invoice</title>
</head>
<style type="text/css">
    body{
        font-family: 'Roboto Condensed', sans-serif;
    }
    .m-0{
        margin: 0px;
    }
    .p-0{
        padding: 0px;
    }
    .pt-5{
        padding-top:5px;
    }
    .mt-10{
        margin-top:10px;
    }
    .text-center{
        text-align:center !important;
    }
    .w-100{
        width: 100%;
    }
    .w-50{
        width:50%;
    }
    .logo img{
        width:130px;
        height:60px;
    }
    .gray-color{
        color:#5D5D5D;
    }
    .text-bold{
        font-weight: bold;
    }
    .border{
        border:1px solid black;
    }
    table tr,th,td{
        border: 1px solid #d2d2d2;
        border-collapse:collapse;
        padding:7px 8px;
    }
    table tr th{
        background: #F4F4F4;
        font-size:15px;
    }
    table tr td{
        font-size:13px;
    }
    table{
        border-collapse:collapse;
    }
    .box-text p{
        line-height:10px;
    }
    .float-left{
        float:left;
    }
    .total-part{
        font-size:16px;
        line-height:12px;
    }
    .total-right p{
        padding-right:20px;
    }
</style>
<body>
<div class="head-title">
    <h1 class="text-center m-0 p-0">Invoice</h1>
</div>
<div class="add-detail mt-10">
    <div class="w-50 float-left mt-10">
        <p class="m-0 pt-5 text-bold w-100">Transaction Id : <span class="gray-color">{{ $transactions->id }}</span></p>
        <p class="m-0 pt-5 text-bold w-100">Order Date : <span class="gray-color">{{ \Carbon\Carbon::parse($transactions->created_at) }}</span></p>
    </div>
    <div class="w-50 float-left logo mt-10">
        <img src="{{ public_path('assets/img/brand/erajaya.png') }}" alt="Logo">
    </div>
    <div style="clear: both;"></div>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">From</th>
            <th class="w-50">To</th>
        </tr>
        <tr>
            <td align="left" valign="top">
                <div class="box-text">
                    <strong>Erajaya</strong>
                    <p>
                        Jl. Bandengan Selatan No.19-20 Pekojan - Tambora
                    </p>
                    <p>
                        Jakarta Barat
                    </p>
                    <p>
                        Indonesia, 11240
                    </p>
                        corporate@erajaya.com
                    </p>
                </div>
            </td>
            <td align="left" valign="top">
                <div class="box-text">
                    <Strong>{{ $customer->name }} ({{ $customer->nik }})</Strong>
                    <p>{{ $customer->address }}</p>
                    <p>{{ $customer->email }}</p>
                    <p>{{ $customer->phone }}</p>
                </div>
            </td>
        </tr>
    </table>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-100">Payment Method</th>
        </tr>
        <tr>
            <td align="center" valign="middle">Cash</td>
        </tr>
    </table>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <thead>
            <tr>
                <th class="w-50">Product ID</th>
                <th class="w-50">Product Name</th>
                <th class="w-50">Price</th>
                <th class="w-50">Qty</th>
                <th class="w-50">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order as $data)
                <tr>
                    <td align="center">{{ $data->id }}</td>
                    <td align="left">{{ $data->product_name }}</td>
                    <td align="center">{{ $data->price }}</td>
                    <td align="center">{{ $data->qty }}</td>
                    <td align="center">Rp {{ $data->subtotal }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5" align="right">
                    Total Payable : Rp <strong>{{ $transactions->total_price }}</strong>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</html>
