@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $product->name }}</h1>
        <table class="table">
            <tbody>
                <tr>
                    <td>Price</td>
                    <td>{{ $product->price }}</td>
                </tr>
                <tr>
                    <td>Shipping From</td>
                    <td>{{ $product->shipping_country }}</td>
                </tr>
                <tr>
                    <td>Weight</td>
                    <td>{{ $product->weight }}</td>
                </tr>
                <tr>
                    <td>Shipping Rate</td>
                    <td>{{ $shipping_rate }}</td>
                </tr>
                <tr>
                    <td>Total Price</td>
                    <td>{{ $total_price }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection