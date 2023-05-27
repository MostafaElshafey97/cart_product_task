<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Offer;
use App\Models\Discount;
use App\Models\Invoice;

class CartController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $offers = Offer::all();
        $discounts = Discount::all();

        return view('cart', compact('products', 'offers', 'discounts'));
    }

    public function store(Request $request)
    {
        $cart = $request->input('cart');

        // Calculate subtotal
        $subtotal = 0;
        foreach ($cart as $product => $quantity) {
            $subtotal += Product::where('name', $product)->first()->price * $quantity;
        }

        // Apply offers and discounts
        $discounts = 0;
        if (isset($cart["Shoes"])) {
            $discounts += $subtotal * Offer::where('name', 'shoes_discount')->first()->value;
        }
        if (isset($cart["T-shirt"]) && isset($cart["Blouse"]) && isset($cart["Jacket"])) {
            $discounts += Product::where('name', 'Jacket')->first()->price * Offer::where('name', 'tops_jacket_discount')->first()->value;
        }
        if (count($cart) >= 2) {
            $discounts += min(array_column(Discount::all()->toArray(), 'value')) * Offer::where('name', 'shipping_discount')->first()->value;
        }
        $subtotal -= $discounts;

        // Calculate shipping fees
        $shipping = 0;
        foreach ($cart as $product => $quantity) {
            $shipping += Shipping::where('country', Product::where('name', $product)->first()->source)->first()->rate * Product::where('name', $product)->first()->weight * $quantity;
        }

        // Calculate VAT
        $vat_amount = $subtotal * Invoice::where('name', 'VAT')->first()->value;

        // Calculate total
        $total = $subtotal + $shipping + $vat_amount;

        // Create invoice record
        $invoice = new Invoice;
        $invoice->subtotal = $subtotal;
        $invoice->shipping = $shipping;
        $invoice->vat_amount = $vat_amount;
        $invoice->discounts = $discounts;
        $invoice->total = $total;
        $invoice->save();

        return view('invoice', compact('invoice'));
    }
}