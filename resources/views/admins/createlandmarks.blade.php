@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-5 d-inline">Add Landmark</h5>

                <form action="{{ route('store.landmarks') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Name input -->
                    <div class="form-outline mb-4 mt-4">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" />
                    </div>
                    @if($errors->has('name'))
                        <p class="alert alert-danger">{{ $errors->first('name') }}</p>
                    @endif

                    <!-- City select -->
                    <div class="form-outline mb-4 mt-4">
                        <label for="city_id" class="form-label">City</label>
                        <select name="city_id" id="city_id" class="form-select form-control" aria-label="Default select example">
                            <option selected>Choose City</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('city_id'))
                        <p class="alert alert-danger">{{ $errors->first('city_id') }}</p>
                    @endif

                    <!-- Description input -->
                    <div class="form-outline mb-4 mt-4">
                        <label for="desc" class="form-label">Description</label>
                        <textarea name="desc" id="desc" class="form-control" placeholder="Description"></textarea>
                    </div>
                    @if($errors->has('desc'))
                        <p class="alert alert-danger">{{ $errors->first('desc') }}</p>
                    @endif

                    <!-- Video upload -->
                    <div class="form-outline mb-4 mt-4">
                        <label for="video" class="form-label">Video</label>
                        <input type="file" name="video" id="video" class="form-control" accept="video/*" />
                    </div>
                    @if($errors->has('video'))
                        <p class="alert alert-danger">{{ $errors->first('video') }}</p>
                    @endif

                    <!-- Address input -->
                    <div class="form-outline mb-4 mt-4">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" id="address" class="form-control" placeholder="Address" />
                    </div>
                    @if($errors->has('address'))
                        <p class="alert alert-danger">{{ $errors->first('address') }}</p>
                    @endif

                    <!-- Categories select -->
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
                    <!-- Images upload -->
                    <div class="form-outline mb-4 mt-4">
                        <label for="images" class="form-label">Images</label>
                        <input type="file" name="images[]" id="images" multiple class="form-control" />
                    </div>
                    @if($errors->has('images'))
                      p class="alert alert-danger">{{ $errors->first('images') }}</p>
                    @endif

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary mb-4 text-center">Save</button>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection
