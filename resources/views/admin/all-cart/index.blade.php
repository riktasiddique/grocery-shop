@extends('layouts.admin-app.app')
@section('title', 'Cart')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">All Cart Table</strong>
                </div>
                <div class="card-body">
                    <table class="table table-success table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Image1</th>
                                {{-- <th scope="col">Title</th> --}}
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                            <tr>
                                <th scope="row">{{$cart->id}}</th>
                                <td><img src="{{url($cart->image1)}}" alt="" height="50" ></td> 
                                <td>{{$cart->price}}</td> 
                                <td>{{$cart->quantity}}</td>
                                <td>
                                    <form action="{{route('cart.destroy', $cart->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>        
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection