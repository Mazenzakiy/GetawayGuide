@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add New Tour Guide</h5>

                <form action="{{ route('store.tourguides') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number" value="{{ old('phone') }}">
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="identification">Identification</label>
                        <input type="text" class="form-control" id="identification" name="identification" placeholder="Enter identification number" value="{{ old('identification') }}">
                        @error('identification')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="identification_image">Identification Image</label>
                        <input type="file" class="form-control-file" id="identification_image" name="identification_image">
                        @error('identification_image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" class="form-control" id="age" name="age" placeholder="Enter age" value="{{ old('age') }}">
                        @error('age')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" id="gender" name="gender">
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="city_id">City</label>
                        <select class="form-control" id="city_id" name="city_id">
                            <option value="">Select City</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                            @endforeach
                        </select>
                        @error('city_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Add Tour Guide</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
