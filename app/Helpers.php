<?php 
use App\Models\Product;


function getShippingRate($country) {
    $shipping_rates = [
        'US' => 2,
        'UK' => 3,
        'CN' => 2
    ];
    return $shipping_rates[$country] ?? 0;
}

function calculateShippingFees($item) {
    $shipping_rate = getShippingRate($item->country);
    $shipping_weight = $item->weight * 10; // تحويل الوزن إلى غرام
    $shipping_fees = $shipping_weight; // 100 * $shipping_rate;
    return $shipping_fees;
}
function calculateInvoice($products) {
    $subtotal = 0;
    $shipping_fees = 0;
    $has_shoes = false;
    $tops_count = 0;
    $jacket_discount = 0;

    foreach ($products as $product) {
        $item = Product::where('name', $product)->firstOrFail();
        $subtotal += $item->price;
        $shipping_fees += calculateShippingFees($item);

        if ($product == 'Shoes') {
            $has_shoes = true;
        } elseif (in_array($product, ['T-shirt', 'Blouse'])) {
            $tops_count++;
            if ($tops_count == 2) {
                $subtotal -= $item->price / 2;
            }
        } elseif (count($products) >= 2) {
            $shipping_discount = min($shipping_fees, 10);
            $subtotal -= $shipping_discount;
        }

        if ($product == 'Jacket') {
            $jacket_discount = $item->price / 2;
        }
    }

    if ($has_shoes) {
        $subtotal *= 0.9;
    }

    $subtotal *= 1.14; // تطبيق ضريبة القيمة المضافة

    $total_discount = $jacket_discount +($shipping_discount ?? 0);
    $total_discount += $has_shoes ? $subtotal * 0.1 : 0;

    $total = $subtotal + $shipping_fees;
    $tax = $subtotal * 0.14;

    $invoice = [
        'subtotal' => $subtotal,
        'shipping_fees' => $shipping_fees,
        'tax' => $tax,
        'total_discount' => $total_discount,
        'total' => $total - $total_discount
    ];

    return $invoice;
}






?>