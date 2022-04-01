{{-- cart js --}}
<script src="{{asset('front/assets/add-cart/app.js')}}"></script>
@extends('layouts.front-app.app')
@section('title', 'Add Cart')
@section('content')
    <section>
        <div class="row">
            <div class="col-md-2">
                <div class="card p-3">
                    <h5>Hello,</h5>
                    <h2>{{$user->name}}</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    @if(count($addCarts) < 1)
                        <div class="alert alert-warning text-center">
                            <strong>Ops!</strong> Your cart is empty.
                        </div>
                        <h3 class="text-center text-danger">Please add some product to your cart</h3>                                      
                    @else
                    @foreach ($addCarts as $addCart)     
                        <div class="row">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src=" {{url($addCart->image1)}}"  class="rounded float-start w-100 h-100 p-4" alt="">
                                    </div>
                                    <div class="col-md-4 p-4 mt-5">
                                        <h5 class="text-center">{{$addCart->subCategory->name}}</h5>
                                        <p>Single Price: <span></span> {{$addCart->price}} <br>Total Price: <span id="productPriceId{{$addCart->id}}">{{$addCart->price * $addCart->quantity}}</span></p>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-center mt-5">
                                    <div class="row justify-content-start">
                                        <button class="btn-secondary w-25">-</i></button>
                                        <input type="number" min="0" class="form-control text-center w-50" value="{{$addCart->quantity}}">
                                        <button class="btn-secondary w-25">+</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        <div class="col-md-2 d-flex align-items-center mt-5">
                                <form action="{{route('cart.destroy', $addCart->id)}}" method="post">
                                @method('DELETE')
                                    @csrf
                                    <button type="submit"><i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                        {{-- <a href="{{route('easyPay.sslCommerce')}}" type="submit" class="btn-warning border border-success p-2 text-center text-white mt-5">Go to the shipping page</a> --}}
                        <form action="{{route('home.payment_type')}}" method="post">
                            @csrf
                            <div class="row m-2">
                                <div class="col-md-4">
                                    <div class="mb-3 form-check">
                                        <input name="name" type="radio" class="form-check-input" value="national_card">
                                        <label class="form-check-label" for="exampleCheck1">National card</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3 form-check">
                                        <input name="name" type="radio" class="form-check-input" value="international_card">
                                        <label class="form-check-label" for="exampleCheck1">International Card</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3 form-check">
                                        <input name="name" type="radio" class="form-check-input" value="cash_on_delivery">
                                        <label class="form-check-label" for="exampleCheck1">Cash on delivery</label>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn-warning border border-success p-2 text-center text-white mt-5 w-100">Go to the shipping page</button>
                        </form>
                    @endif
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
                                <p><span id="subTotal"></span>Tk</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <p>Shipping:</p>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <p><span id="shippingCharge"></span>Tk</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <p>Total:</p>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <p><span id="total"></span> Tk</p>
                            </div>
                        </div>
                        {{-- <hr> --}}
                        <div class="row" style="border: dotted gray 2px">
                            <div class="col-md-4">
                                <p>Payable:</p>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <p><span id="payable"></span> Tk</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection