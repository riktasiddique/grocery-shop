@extends('layouts.app')
@section('title', 'Control Role')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
        <div class="card text-center">
            <div class="card-header">
                #{{$user->id}}
            </div>
            <div class="card-body">
                <h5 class="card-title">User Name: {{$user->name}}</h5>
                <p class="card-text">Email: {{$user->email}} <br> Role Id: {{$user->role_id}}<br> Role Name: {{$user->role->name}} </p>
                <hr>
                @if(auth()->user()->id !== $user->id)
               @if($user->active)
                <a class="btn btn-danger" href="{{route('user.change_status', $user->id)}}">Unblock</a>
                @else
                <a class="btn btn-success" href="{{route('user.change_status', $user->id)}}">Block</a>
                @endif
                <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changeRole">Change Role</a>
                @endif
            </div>
            <!-- <div class="card-footer text-muted">
                2 days ago
            </div> -->
            </div>
        </div>
    </div>
    <!-- Modals -->
    <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="changeRole" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Roles</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body col-md-8">
            <form action="{{route('user.change_role', $user->id)}}" method="POST">
                @csrf
                <select name="role_id" class="form-select" aria-label="Default select example">
                    <!-- <option selected>select</option> -->
                    @foreach($roles as $role)
                    <option value="{{$role->id}}"
                      @if($user->role_id == $role->id){
                        selected
                      }
                      @endif
                    >{{$role->name}}</option>
                    @endforeach
                </select>
                <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Confirm</button>
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
      </div>
    </div>
  </div>
</div>
@endsection