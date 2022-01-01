@extends('layouts.app')
@section('title', 'Users')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-10">
    <table class="table table-dark table-bordered">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Role</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->role->name}}</td>
            <td>
                @if(auth()->user()->id !== $user->id)
               @if($user->active)
                <a class="btn btn-danger" href="{{route('user.change_status', $user->id)}}">Unblock</a>
                @else
                <a class="btn btn-success" href="{{route('user.change_status', $user->id)}}">Block</a>
                @endif
                @endif
                <a href="{{route('users.show', $user->id)}}" class="btn btn-secondary">Details</a>
        </tr>
        @endforeach
    </tbody>
    </table>
    </div>
</div>
@endsection