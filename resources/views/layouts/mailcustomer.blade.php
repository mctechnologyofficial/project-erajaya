<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Validation</title>
</head>
<body>
    @php
        $customer = App\Models\Customer::find(Session::get('customerid'));
    @endphp
    <p style="text-align: justify;">
        Dear {{ $customer->name }}, <br><br>
        You have successfully made a transaction at Erajaya, we will send you the transaction invoice below. <br><br>

        Best Regards,<br>
        <strong>Erajaya</strong><br>
        erajayaa.company@gmail.com
    </p>
</body>
</html>
