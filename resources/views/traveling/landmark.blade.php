@extends('layouts.app')

@section('content')
    {{-- start --}}
    <div class="about-main-content" style="margin-top: 10px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content">
                        <!-- Background video without effects -->
                        <div class="video-bg">
                            <video autoplay muted loop class="clear-video">
                                <source
                                    src="{{ asset('assets/videos/Let s Go - Egypt _ A Beautiful Destinations Original.mp4') }}"
                                    type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>

                        <!-- Main content -->
                        <h4>EXPLORE OUR country</h4>
                        <div class="line-dec"></div>
                        <h2>Welcome To {{ $landmark->name }}</h2>

                        <!-- Optional button -->
                        <div class="main-button">
                            <!-- Add button content here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- end --}}
    <!-- ***** Main Banner Area End ***** -->

    <div class="cities-town">
        <div class="container">
            <div class="row">
                <div class="slider-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2>{{ $landmark->name }}’s <em>Images</em></h2>
                        </div>
                        <div class="col-lg-12">
                            <div class="owl-cites-town owl-carousel">
                                @foreach ($landmarkImages as $image)
                                    <div class="item">
                                        <div class="thumb">

                                            <img src="{{ asset('assets/images/' . $image->name . '') }}" alt="">

                                            </a>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                            <div class="col-lg-12" style="margin-top: 4%">
                                <h2><em>Characteristics of {{ $landmark->name }} : </em>
                                    @foreach ($categories as $category)
                                        {{ $category->name }}
                                    @endforeach
                                </h2>
                    

                                @if (isset(Auth::user()->id))
                                    <!-- Add to cart form -->
                                    <form action="{{ route('traveling.cart.add', $landmark->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                                    </form>
                                @else
                                    <p class="alert alert-success">Login To Make add cart</p>
                                @endif

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="more-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="left-image">
                        <img src="{{ asset('assets/images/about-left-image.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h2>Discover More About Our Country</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore.</p>
                    </div>
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="info-item">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h4>+</h4>
                                        <span>Amazing Places</span>
                                    </div>
                                    {{-- <div class="col-lg-6">
                                    <h4>240.580+</h4>
                                    <span>Different Check-ins Yearly</span>
                                </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.
                    </p>

                </div>
            </div>
        </div>
    </div>

    <main>
        <div class="container mt-4">
            <h1 class="display-1 text-center mb-4">
                <strong>
                    Gallery
                </strong>
            </h1>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <img class="img-fluid shodow rouded mb-4 gallery-img" src="{{ asset('assets/images/cairo.jpeg') }}"
                        alt="boulton-watt-murdoch.png">
                </div>

                <div class="col-sm-12 col-md-6 col-lg-4">
                    <img class="img-fluid shodow rouded mb-4 gallery-img" src="assets/images/library.png" alt="library.png">
                </div>

                <div class="col-sm-12 col-md-6 col-lg-4">
                    <img class="img-fluid shodow rouded mb-4 gallery-img" src="assets/images/rotunda.png" alt="rotunda.png">
                </div>

                <div class="col-sm-12 col-md-6 col-lg-4">
                    <img class="img-fluid shodow rouded mb-4 gallery-img" src="assets/images/canal.png" alt="canal.png">
                </div>


                <div class="col-sm-12 col-md-6 col-lg-4">
                    <img class="img-fluid shodow rouded mb-4 gallery-img" src="assets/images/birmingham-street.png"
                        alt="birmingham-street.png">
                </div>


                <div class="col-sm-12 col-md-6 col-lg-4">
                    <img class="img-fluid shodow rouded mb-4 gallery-img" src="assets/images/evening-view.png"
                        alt="evening-view.png">
                </div>

                <div class="col-sm-12 col-md-6 col-lg-4">
                    <img class="img-fluid shodow rouded mb-4 gallery-img" src="assets/images/guardian.png"
                        alt="guardian.png">
                </div>

                <div class="col-sm-12 col-md-6 col-lg-4">
                    <img class="img-fluid shodow rouded mb-4 gallery-img" src="assets/images/new-street-at-night.png"
                        alt="new-street-at-night.png">
                </div>

                <div class="col-sm-12 col-md-6 col-lg-4">
                    <img class="img-fluid shodow rouded mb-4 gallery-img" src="assets/images/st-martins.png"
                        alt="st-martins.png">
                </div>


                <div class="col-sm-12 col-md-6 col-lg-4">
                    <img class="img-fluid shodow rouded mb-4 gallery-img" src="assets/images/birmingham-townhall.png"
                        alt="birmingham-townhall.png">
                </div>


                <div class="col-sm-12 col-md-6 col-lg-4">
                    <img class="img-fluid shodow rouded mb-4 gallery-img" src="assets/images/high-ropes.png"
                        alt="high-ropes.png">
                </div>

                <div class="col-sm-12 col-md-6 col-lg-4">
                    <img class="img-fluid shodow rouded mb-4 gallery-img" src="assets/images/jewellery-quarter-shops.png"
                        alt="jewellery-quarter-shops.png">
                </div>

                <div class="col-sm-12 col-md-6 col-lg-4">
                    <img class="img-fluid shodow rouded mb-4 gallery-img" src="assets/images/shopping-mall-art.png"
                        alt="shopping-mall-art.png">
                </div>

                <div class="col-sm-12 col-md-6 col-lg-4">
                    <img class="img-fluid shodow rouded mb-4 gallery-img" src="assets/images/skyline-shopping-mall.png"
                        alt="skyline-shopping-mall.png">
                </div>

                <div class="col-sm-12 col-md-6 col-lg-4">
                    <img class="img-fluid shodow rouded mb-4 gallery-img" src="assets/images/birmingham-cathedral.png"
                        alt="birmingham-cathedral.png">
                </div>

            </div>
        </div>
    </main>
@endsection
