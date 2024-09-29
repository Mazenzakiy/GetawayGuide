@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Edit City</h5>

                <form action="{{ route('update.cities', $city->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">City Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $city->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" name="price" class="form-control" value="{{ $city->price }}" required>
                    </div>

                    <div class="form-group">
                        <label for="num_days">Number of Days</label>
                        <input type="text" name="num_days" class="form-control" value="{{ $city->num_days }}" required>
                    </div>

                    <div class="form-group">
                        <label for="country_id">Country</label>
                        <select name="country_id" class="form-control" required>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ $city->country_id == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="image">City Image</label>
                        <input type="file" name="image" class="form-control">
                        <img src="{{ asset('assets/images/' . $city->image) }}" width="100" class="mt-2">
                    </div>

                    <div class="form-group">
                        <label for="video">City Video (optional)</label>
                        <input type="file" name="video" class="form-control">
                        @if($city->video)
                            <video width="150" class="mt-2" controls>
                                <source src="{{ asset('assets/videos/' . $city->video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-success">Update City</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
