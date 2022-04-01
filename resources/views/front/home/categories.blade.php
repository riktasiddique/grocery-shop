@extends('layouts.front-app.app')
@section('title', 'Categories')
@section('content')
{{-- Categories Section --}}
    <section class="category" id="category">

        <h1 class="heading">shop by <span>category</span></h1>

        <div class="box-container">
            @foreach ($categories as $category)
                <div class="box">
                    <h3>{{$category->name}}</h3>
                    {{-- <p>upto 44% off</p> --}}
                    <img src="{{url($category->image1)}}" alt="">
                    <a href="{{route('home.product')}}?query={{$category->name}}" class="btn">shop now</a>
                </div>
            @endforeach
        </div>

    </section>
{{-- Products Section --}}
    <section class="product" id="product">
        <h1 class="heading">latest <span>products</span></h1>
        <div class="box-container">
            @foreach ($products as $product) 
                    <div class="box">
                        <div class="icons">
                            <a href="#" class="fas fa-heart"></a>
                            <a href="#" class="fas fa-share"></a>
                            <a href="#" class="fas fa-eye"></a>
                        </div>
                        <img src="{{url($product->image1)}}" alt="">
                        <h3>{{$product->subCategory->name}}</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        {{-- <div class="price"> $10.50 <span> $13.20 </span> </div> --}}
                        <div class="price">Price: {{$product->price}} Tk</div>
                        <div class="quantity">
                            <span>quantity : </span>
                            <input type="number" min="1" max="1000" value="{{$product->quantity}}">
                            <span> /kg </span>
                        </div>
                        <a href="#" class="btn">add to cart</a>
                    </div>
            @endforeach
        </div>
        {{-- Pagination --}}
        {{-- <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
            </ul>
        </nav> --}}
    </section>
@endsection