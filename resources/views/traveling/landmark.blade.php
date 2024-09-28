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
                                @if ($landmark->video)
                                    <video autoplay muted loop class="clear-video">
                                        <source src="{{ asset('assets/videos/' . $landmark->video) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @else
                                    <p>No video available for this landmark.</p>
                                @endif
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
                                @if($landmark)
                                    <h2>{{ $landmark->name }}</h2>
                                    @foreach($landmark->images as $image)
                                        <img src="{{ asset('assets/images/' . $image->name) }}" alt="">
                                    @endforeach
                                @else
                                    <p>Landmark not found</p>
                                @endif


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
            @if($landmark->images->isNotEmpty())
                @foreach ($landmark->images as $image)
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <img class="img-fluid shodow rounded mb-4 gallery-img"
                             src="{{ asset('assets/images/' . $image->name) }}"
                             alt="{{ $landmark->name }}">
                    </div>
                @endforeach
            @else
                <p>No images available for this landmark.</p>
            @endif
        </div>
    </div>
</main>

    @endsection
