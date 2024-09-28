@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-5 d-inline">Create Cities</h5>
                <form method="POST" action="{{ route('store.cities') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Name input -->
                    <div class="form-outline mb-4 mt-4">
                        <label for="name">City Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter city name" />
                    </div>
                    @if($errors->has('name'))
                        <p class="alert alert-danger">{{ $errors->first('name') }}</p>
                    @endif

                    <!-- Image input -->
                    <div class="form-outline mb-4 mt-4">
                        <label for="image">City Image</label>
                        <input type="file" name="image" id="image" class="form-control" />
                    </div>
                    @if($errors->has('image'))
                        <p class="alert alert-danger">{{ $errors->first('image') }}</p>
                    @endif

                    <!-- Video input -->
                    <div class="form-outline mb-4 mt-4">
                        <label for="video">City Video</label>
                        <input type="file" name="video" id="video" class="form-control" />
                    </div>
                    @if($errors->has('video'))
                        <p class="alert alert-danger">{{ $errors->first('video') }}</p>
                    @endif

                    <!-- Number of days input -->
                    <div class="form-outline mb-4 mt-4">
                        <label for="num_days">Number of Days</label>
                        <input type="text" name="num_days" id="num_days" class="form-control" placeholder="Enter number of days" />
                    </div>
                    @if($errors->has('num_days'))
                        <p class="alert alert-danger">{{ $errors->first('num_days') }}</p>
                    @endif

                    <!-- Price input -->
                    <div class="form-outline mb-4 mt-4">
                        <label for="price">Price</label>
                        <input type="text" name="price" id="price" class="form-control" placeholder="Enter price" />
                    </div>
                    @if($errors->has('price'))
                        <p class="alert alert-danger">{{ $errors->first('price') }}</p>
                    @endif

                    <!-- Country select -->
                    <div class="form-outline mb-4 mt-4">
                        <label for="country_id">Country</label>
                        <select name="country_id" id="country_id" class="form-select form-control">
                            <option selected>Choose Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('country_id'))
                        <p class="alert alert-danger">{{ $errors->first('country_id') }}</p>
                    @endif

                    <!-- Submit button -->
                    <button type="submit" name="submit" class="btn btn-primary mb-4 text-center">Create</button>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection
