@extends('layouts.admin-app.app')
@section('title', 'Wish List')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">WishList Table</strong>
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
                            @foreach ($wishLists as $wishList)
                            <tr>
                                <th scope="row">{{$wishList->id}}</th>
                                <td><img src="{{url($wishList->image1)}}" alt="" height="50" ></td> 
                                <td>{{$wishList->price}}</td> 
                                <td>{{$wishList->quantity}}</td>
                                <td>
                                    <form action="{{route('wish-list.destroy', $wishList->id)}}" method="post">
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