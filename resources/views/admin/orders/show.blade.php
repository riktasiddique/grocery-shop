@extends('layouts.admin-app.app')
@section('title', 'View Orders')
@section('content')
<section class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-user"></i><strong class="card-title pl-2">{{$order->id}} <span class="text-muted">({{$order->creator->name}})</span></strong>
            </div>
            <div class="card-body">
                <div class="mx-auto d-block">
                    {{-- <h5 class="text-sm-center mt-2 mb-1">Ordered Time: <span class="text-muted">{{$order->created_at}}, {{($order->created_at)->diffForHumans()}} </span></h5>
                    <br> --}}
                    <h5 class="text-sm-center mt-2 mb-1"><i class="fa fa-phone"></i> Phone: <span class="text-muted">{{$order->phone}}</span></h5>
                    <div class="location text-sm-center"><i class="fa fa-map-marker"></i> Address: <span class="text-muted">{{$order->division}}, {{$order->district}}, {{$order->upazila}}, {{$order->address}}</span></div>
                    {{-- <h5 class="text-sm-center mt-2 mb-1">Delivery Type: <span class="text-muted">{{$order->delivery_type}}</span></h5> --}}
                    <h5 class="text-sm-center mt-2 mb-1">Shipping Cost: <span class="text-muted">{{$order->shipping_charge}} 50</span></h5>
                    <div class="location text-sm-center">Total : <span class="text-muted">{{$order->amount}}</span></i></div>
                    <div class="location text-sm-center">Transection Id:  : <span class="text-muted">{{$order->transaction_id}}</span></i></div>
                </div>
                <hr>
            </div>
        </div>
    </div>
</section>
{{-- Ordered Products --}}
<section>
    <div class="row">
        <div class="col-md-8">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <?php
                            $total = 0;
                        ?>
                        @foreach ($myOrders as $myOrder) 
                            <?php
                                $total += $myOrder->price * $myOrder->quantity;
                            ?>   
                            <div class="row">
                                <div class="col-md-4">
                                    <img src=" {{url($myOrder->image1)}}"  class="rounded float-start w-100 h-100 p-4" alt="">
                                </div>
                                <div class="col-md-6 p-4">
                                    <h5>{{$myOrder->subCategory->name}}</h5>
                                    <p>Quantity: {{$myOrder->quantity}}</p>
                                    <p>Price: {{$myOrder->price * $myOrder->quantity}}</p>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header text-center">Checkout Summary</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p>Subtotal:</p>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <p>{{$total}}Tk</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <p>Shipping:</p>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <p>50 Tk</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <p>Total:</p>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <p>{{$total}} Tk</p>
                        </div>
                    </div>
                    {{-- <hr> --}}
                    <div class="row" style="border: dotted gray 2px">
                        <div class="col-md-4">
                            <p>Payable:</p>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <p>{{$total + 50}} Tk</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection