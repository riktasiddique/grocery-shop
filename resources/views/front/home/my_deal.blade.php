@extends('layouts.front-app.app')
@section('title', 'My Deal')
@section('content')
    <section>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">All Orders Table</strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-success table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Details</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{$order->name}}</td>
                                        <td>{{$order->email}}</td>
                                        <td>{{$order->phone}}</td>
                                        <td>{{$order->status}}</td>
                                        <td>
                                            <a href="{{route('my_deal.show', $order->id)}}" class="btn-secondary p-2 border-secondary rounded">Show</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection