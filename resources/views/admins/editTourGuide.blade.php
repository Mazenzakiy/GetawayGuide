@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Tour Guide</h5>

                <form action="{{ route('update.tourguides', $tourGuide->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $tourGuide->name }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $tourGuide->email }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $tourGuide->phone }}">
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                        @if($tourGuide->image)
                            <img src="{{ asset('assets/images/' . $tourGuide->image) }}" alt="{{ $tourGuide->name }}" width="100">
                        @endif
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="identification">Identification</label>
                        <input type="text" class="form-control" id="identification" name="identification" value="{{ $tourGuide->identification }}">
                    </div>

                    <div class="form-group">
                        <label for="identification_image">Identification Image</label>
                        <input type="file" class="form-control-file" id="identification_image" name="identification_image">
                        @if($tourGuide->identification_image)
                            <img src="{{ asset('assets/images' . $tourGuide->identification_image) }}" alt="Identification" width="50">
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" class="form-control" id="age" name="age" value="{{ $tourGuide->age }}">
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" id="gender" name="gender">
                            <option value="male" {{ $tourGuide->gender == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $tourGuide->gender == 'female' ? 'selected' : '' }}>Female</option>
                        </select>

                    </div>

                    <div class="form-group">
                        <label for="city_id">City</label>
                        <select class="form-control" id="city_id" name="city_id">
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ $tourGuide->city_id == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <button type="submit" class="btn btn-primary">Update Tour Guide</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
