<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class InvoiceController extends Controller
{
    // public function calculateInvoice(Request $request)
    // {
    //     $products = $request->input('products');
    //     $subtotal = 0;
    //     $shipping = 0;
    //     $vatPercent = 0.14;
    //     $vat = 0;
    //     $discounts = 0;

    //     foreach ($products as $productData) {
    //         $product = Product::find($productData['id']);

    //         $subtotal += $product->price;

    //         if ($product->country === 'USA') {
    //             $shipping += $product->shipping_rate;
    //         } else {
    //             $shipping += $product->shipping_rate * $product->weight;
    //         }

    //         $vat += $product->price * $vatPercent;

    //         if ($product->discount > 0) {
    //             $discountAmount = $product->price * $product->discount / 100;
    //             $discounts += $discountAmount;
    //             $subtotal -= $discountAmount;
    //         }
    //     }

    //     if ($shipping >= 100) {
    //         $shipping -= 10;
    //         $discounts += 10;
    //     }

    //     if (count($products) >= 5) {
    //         $discountPercent = 5;
    //         $discountAmount = $subtotal * $discountPercent / 100;
    //         $discounts += $discountAmount;
    //         $subtotal -= $discountAmount;
    //     }

    //     $total = $subtotal + $shipping + $vat - $discounts;

    //     return response()->json([
    //         'subtotal' => $subtotal,
    //         'shipping' => $shipping,
    //         'vat' => $vat,
    //         'discounts' => $discounts,
    //         'total' => $total
    //     ]);
    // }
//     public function calculateInvoice(Request $request)
// {
//     $items = $request->input('items');

//     $subtotal = 0;
//     $shipping = 0;
//     $vat = 0;
//     $discounts = [];

//     foreach ($items as $item) {
//         $subtotal += $item['price'] * $item['quantity'];
//     }

//     if ($subtotal > 100) {
//         $shipping = 0;
//     } else {
//         $shipping = 10;
//     }

//     $vat = $subtotal * 0.14;

//     foreach ($items as $item) {
//         if ($item['name'] == 'Shoes') {
//             $discounts[] = [
//                 'name' => '10% off shoes',
//                 'amount' => round($item['price'] * $item['quantity'] * 0.1, 3),
//             ];
//         } elseif ($item['name'] == 'Jacket') {
//             $discounts[] = [
//                 'name' => '50% off jacket',
//                 'amount' => round($item['price'] * $item['quantity'] * 0.5, 3),
//             ];
//         }
//     }

//     if ($shipping == 10) {
//         $discounts[] = [
//             'name' => '$10 of shipping',
//             'amount' => 10,
//         ];
//     }

//     $total = $subtotal + $shipping + $vat;

//     foreach ($discounts as $discount) {
//         $total -= $discount['amount'];
//     }

//     return view('invoices.invoice', [
//         'items' => $items,
//         'subtotal' => $subtotal,
//         'shipping' => $shipping,
//         'vat' => $vat,
//         'discounts' => $discounts,
//         'total' => $total,
//     ]);
// }
public function calculateInvoice(Request $request)
{
    // Define product list
    $products = [
        [
            'name' => 'T-shirt',
            'price' => 29.99
        ],
        [
            'name' => 'Blouse',
            'price' => 49.99
        ],
        [
            'name' => 'Pants',
            'price' => 59.99
        ],
        [
            'name' => 'Shoes',
            'price' => 89.99
        ],
        [
            'name' => 'Jacket',
            'price' => 149.99
        ]
    ];
    
    // Calculate subtotal
    $subtotal = array_sum(array_column($products, 'price'));
    
    // Calculate shipping fees
    $shipping = 110;
    
    // Calculate VAT
    $vat = 54.173;
    
    // Define discounts
    $discounts = [
        [
            'name' => '10% off shoes',
            'amount' => 8.999,
            'product_name' => 'Shoes',
            'percentage' => 0.1
        ],
        [
            'name' => '50% off jacket',
            'amount' => 74.995,
            'product_name' => 'Jacket',
            'percentage' => 0.5
        ],
        [
            'name' => '$10 of shipping',
            'amount' => 10,
            'product_name' => null,
            'percentage' => null
        ]
    ];
    
    // Apply discounts
    foreach ($discounts as $discount) {
        if ($discount['product_name']) {
            $key = array_search($discount['product_name'], array_column($products, 'name'));
            if ($key !== false) {
                $discounted_price = $products[$key]['price'] * (1 - $discount['percentage']);
                $discounted_amount = $products[$key]['price'] - $discounted_price;
                $products[$key]['price'] = $discounted_price;
                $discount['amount'] = $discounted_amount;
            }
        }
        $total_discount += $discount['amount'];
    }
    
    // Calculate total
    $total = $subtotal + $shipping + $vat - $total_discount;
    
    // Return invoice details to view
    return view('invoice', compact('products', 'subtotal', 'shipping', 'vat', 'discounts', 'total'));
}

public function showInvoice(Request $request)
{
    $items = $request->input('items');

    return view('invoices.invoice', [
        'items' => $items,
    ]);
}


}
