@extends('layouts.front-app.app')
@section('title', 'Home')
@section('content')
    <section class="home" id="home">

        <div class="image">
            <img src="{{asset('front/assets/images/home-img.png')}}" alt="">
        </div>

        <div class="content">
            <span>fresh and organic</span>
            <h3>your daily need products</h3>
            <a href="{{route('home.product')}}" class="btn">get started</a>
        </div>

    </section>

    <!-- home section ends -->

    <!-- banner section starts  -->

    <section class="banner-container">

        <div class="banner">
            <img src="{{asset('front/assets/images/banner-1.jpg')}}" alt="">
            <div class="content">
                <h3>special offer</h3>
                {{-- <p>upto 45% off</p> --}}
                <a href="{{route('home.product')}}?query=Vegitables" class="btn">check out</a>
            </div>
        </div>

        <div class="banner">
            <img src="{{asset('front/assets/images/banner-2.jpg')}}" alt="">
            <div class="content">
                <h3>limited offer</h3>
                {{-- <p>upto 50% off</p> --}}
                <a href="{{route('home.product')}}?query=Fruits" class="btn">check out</a>
            </div>
        </div>

    </section>
    <!-- banner section ends -->
@endsection