<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // عرض الصفحة الرئيسية
    public function index()
    {
        return view('cart');
    }

    // حساب الفاتورة الإجمالية
    public function calculate(Request $request)
    {
        // قائمة المنتجات وأسعارالشحن
        $products = [
            [
                'name' => 'T-shirt',
                'price' => 30.99,
                'shipping_from' => 'US',
                'weight' => 0.2,
            ],
            [
                'name' => 'Blouse',
                'price' => 10.99,
                'shipping_from' => 'UK',
                'weight' => 0.3,
            ],
            [
                'name' => 'Pants',
                'price' => 64.99,
                'shipping_from' => 'UK',
                'weight' => 0.9,
            ],
            [
                'name' => 'Sweatpants',
                'price' => 84.99,
                'shipping_from' => 'CN',
                'weight' => 1.1,
            ],
            [
                'name' => 'Jacket',
                'price' => 199.99,
                'shipping_from' => 'US',
                'weight' => 2.2,
            ],
            [
                'name' => 'Shoes',
                'price' => 79.99,
                'shipping_from' => 'CN',
                'weight' => 1.3,
            ],
        ];

        // قائمة أسعار الشحن لكل بلد
        $shipping_rates = [
            'US' => 

                2,
            'UK' => 3,
            'CN' => 2,
        ];

        // العروض المتاحة
        $offers = [
            'shoes' => 0.1,
            'jacket' => 0.5,
            'shipping' => 10,
        ];

        // مجموع الوزن
        $total_weight = 0;

        // مجموع الأسعار قبل الخصم
        $subtotal = 0;

        // قائمة المنتجات المحددة من قبل المستخدم
        $selected_products = $request->input('products');

        // حساب مجموع الأسعار والوزن
        foreach ($selected_products as $product_name) {
            foreach ($products as $product) {
                if ($product['name'] == $product_name) {
                    $subtotal += $product['price'];
                    $total_weight += $product['weight'];
                }
            }
        }

        // حساب تكلفة الشحن
        $shipping_cost = (int) ceil($total_weight * 1000) / 100 * $shipping_rates[$request->input('country')];
        $discount = 0;


        // حسابتم انقطاع النص. يرجى إكمال الجزء الناقص من الكود.
        // حساب الخصومات
        $discounts = [];
        if (in_array('Shoes', $selected_products)) {
            $shoes_discount = $subtotal * $offers['shoes'];
            // $subtotal -= $shoes_discount;
            $discounts[] = '10% off shoes: -' . number_format($shoes_discount, 3);
        }

        $tops_count = 0;
        foreach ($selected_products as $product_name) {
            if ($product_name == 'T-shirt' || $product_name == 'Blouse') {
                $tops_count++;
            }
        }

        if ($tops_count >= 2) {
            $jacket_discount = $offers['jacket'] * $subtotal;
            $discounts[] = '50% off jacket: -' . number_format($jacket_discount, 3);
        }
        

        if (count($selected_products) >= 2) {
            if ($shipping_cost > $offers['shipping']) {
                $discount = $offers['shipping'];
            } else {
                $discount = $shipping_cost;
            }
            $shipping_cost -= $discount;
            $discounts[] = '$10 of shipping: -' . number_format($discount, 3);
        }

        //حساب الضريبة المضافة وإجمالي الفاتورة بعد الخصومات
        $vat = $subtotal * 0.14;
        $total = $subtotal + $shipping_cost + $vat;

        // إرجاع الفاتورة كنتيجة
        return view('invoice', [
            'subtotal' => number_format($subtotal, 2),
            'shipping_cost' => number_format($shipping_cost),
            'vat' => number_format($vat, 3),
            'discounts' => $discounts,
            'total' => number_format($total, 3),
        ]);
    }
}