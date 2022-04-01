@extends('layouts.admin-app.app')
@section('title', 'Sub Categories')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <button type="button" class="btn btn-info mb-5" data-bs-toggle="modal" data-bs-target="#exampleModal">
                + Add New
              </button>
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">All Main Category Table</strong>
                </div>
                <div class="card-body">
                    <table class="table table-success table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                {{-- <th scope="col">Role</th> --}}
                                <th scope="col">Edit</th>
                                <th scope="col">Delate</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <th scope="row">{{$category->id}}</th>
                                <td>{{$category->name}}</td>
                                <td>
                                    <a href="{{route('sub-category.edit', $category->id)}}" class="btn btn-primary"><i class="fa  fa-edit (alias)"></i></a>
                                </td>
                                <td>
                                    <form action="{{route('sub-category.destroy', $category->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        {{-- <a href="" class="btn btn-danger"><i class="fa fa-trash"></i></a> --}}
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"      aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <p>Create Your Product Categories</p>
            </div>
            <form action="{{route('sub-category.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-2 mb-2">
                        <select name="main_category_id" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                            {{-- <option selected>Please Select</option> --}}
                            @foreach($main_categories as $main_category)
                                <option value="{{$main_category->id}}">{{$main_category->name}}</option>
                            @endforeach
                          </select>
                      </div>
                    <div class="mb-2">
                      <label for="exampleInputEmail1" class="form-label"> Category Name</label>
                      <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Submit</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection