@extends('layouts.front-app.app')
@section('title', 'My Deal View')
@section('content')
<section>
    <div class="row">
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Hello,</h5>
                <h2>{{$user->name}}</h2>
                <h2>Phone: {{$order->phone}}</h2>
                <h2>addres: {{$order->address}}</h2>
                <h2>Transaction: {{$order->transaction_id}}</h2>
                <h2>Total: {{$order->amount}}</h2>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                @foreach ($order_products as $order_product)   
                    <div class="row">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="{{url($order_product->image1)}}"  class="rounded float-start w-100 h-100 p-4" alt="">
                                    </div>
                                    <div class="col-md-4 p-4 mt-5">
                                        <p>{{$order_product->subCategory->name}}</p>
                                        <h5>Price: {{$order_product->price * $order_product->quantity}}</h5>
                                        <p>Quantity: {{$order_product->quantity}}<span></span></p>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-center mt-5">
                                    </div>
                                </div>
                            </div>
                    </div>    
                    <hr>  
                @endforeach  
            </div>
        </div>
</section>
@endsection