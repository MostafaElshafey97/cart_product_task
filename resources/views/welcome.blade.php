<!DOCTYPE html>
<html>
<head>
    <title>Shipping App</title>
</head>
<body>
    <h1>Shipping App</h1>

    <form method="POST" action="{{ route('add-product') }}">
        @csrf
        <label>اسم المنتج:</label>
        <input type="text" name="name"><br>
        <label>السعر:</label>
        <input type="number" name="price"><br>
        <label>الوزن:</label>
        <input type="number" name="weight"><br>
        <label>بلد الشحن:</label>
        <select name="shipping_country">
            <option value="App\Country">المملكة العربية السعودية</option>
        </select><br>
        <button type="submit">أضف المنتج إلى العربة</button>
    </form>

    @if (count($cart->products) > 0)
        <h2>عربة التسوق</h2>
        <table>
            <thead>
                <tr>
                    <th>المنتج</th>
                    <th>السعر</th>
                    <th>الوزن</th>
                    <th>بلد الشحن</th>
                    <th>تكلفة الشحن</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart->products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->weight }}</td>
                        <td>{{ $product->shipping_country }}</td>
                        <td>{{ $product->getShippingFee() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2>المجموع: {{ $cart->getSubtotal() }}</h2>
        <h2>تكاليف الشحن: {{ $cart->getShippingFees() }}</h2>
        <h2>ضريبة القيمة المضافة: {{ $cart->getTax() }}</h2>

        @if ($cart->hasDiscount())
            <h2>خصم 50% على الجاكيت: {{ $cart->getDiscount() }}</h2>
        @endif

        <h2>الإجمالي: {{ $cart->getTotal() }}</h2>

        <form method="POST" action="{{ route('calculate-total') }}">
            @csrf
            <button type="submit">احسب الإجمالي</button>
        </form>
    @endif
</body>
</html>