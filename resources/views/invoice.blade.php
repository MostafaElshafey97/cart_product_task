<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>Invoice</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h2>Order Details</h2>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Subtotal:</td>
                            <td>${{ $subtotal }}</td>
                        </tr>
                        <tr>
                            <td>Shipping:</td>
                            <td>${{ $shipping_cost }}</td>

                        </tr>
                        <tr>
                            <td>VAT:</td>
                            <td>${{ $vat }}</td>
                        </tr>
                        @if(count($discounts) > 0)
                            <tr>
                                <td>Discounts:</td>
                                <td>
                                    <ul>
                                        @foreach($discounts as $discount)
                                            <li>{{ $discount }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h2>Total</h2>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Total:</td>
                            <td>${{ $total }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>
</html>