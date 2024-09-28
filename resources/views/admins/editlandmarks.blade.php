@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>{{ isset($landmark) ? 'Edit Landmark' : 'Create New Landmark' }}</h1>

    <form action="{{ isset($landmark) ? route('update.landmarks', $landmark->id) : route('store.landmarks') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($landmark))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $landmark->name ?? '') }}" required>
            @if($errors->has('name'))
                <p class="alert alert-danger">{{ $errors->first('name') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="desc">Description</label>
            <textarea name="desc" id="desc" class="form-control" required>{{ old('desc', $landmark->desc ?? '') }}</textarea>
            @if($errors->has('desc'))
                <p class="alert alert-danger">{{ $errors->first('desc') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $landmark->address ?? '') }}" required>
            @if($errors->has('address'))
                <p class="alert alert-danger">{{ $errors->first('address') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="category_ids">Categories</label>
            <div>
                @foreach($categories as $category)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="category_ids[]" value="{{ $category->id }}" id="category_{{ $category->id }}"
                        {{ (collect(old('category_ids'))->contains($category->id) || isset($landmark) && $landmark->categories->contains($category->id)) ? 'checked' : '' }}>
                        <label class="form-check-label" for="category_{{ $category->id }}">
                            {{ $category->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            @error('category_ids')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="city_id">City</label>
            <select name="city_id" id="city_id" class="form-control" required>
                <option value="">Select City</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}" {{ (old('city_id', $landmark->city_id ?? '') == $city->id) ? 'selected' : '' }}>
                        {{ $city->name }}
                    </option>
                @endforeach
            </select>
            @if($errors->has('city_id'))
                <p class="alert alert-danger">{{ $errors->first('city_id') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="video">Video</label>
            <input type="file" name="video" id="video" class="form-control" accept="video/*">
            @if($errors->has('video'))
                <p class="alert alert-danger">{{ $errors->first('video') }}</p>
            @endif

            @if(isset($landmark->video))
                <video width="150" class="mt-2" controls>
                    <source src="{{ asset('assets/videos/' . $landmark->video) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            @endif
        </div>

        <div class="form-group">
            <label for="images">Images</label>
            <input type="file" name="images[]" id="images" class="form-control" multiple accept="image/*">
            @if($errors->has('images'))
                <p class="alert alert-danger">{{ $errors->first('images') }}</p>
            @endif

            @if(isset($landmark->images) && count($landmark->images) > 0)
        <div class="mt-2">
                @foreach($landmark->images as $image)
                    <img src="{{ asset('assets/images/' . $image->name) }}" width="100" class="mr-2 mb-2" alt="Landmark Image">
                @endforeach
        </div>
                @endif

        </div>

        <button type="submit" class="btn btn-primary">{{ isset($landmark) ? 'Update' : 'Create' }}</button>
    </form>
</div>
@endsection
