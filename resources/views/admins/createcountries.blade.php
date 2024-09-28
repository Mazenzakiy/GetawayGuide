@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-5 d-inline">Create Countries</h5>
                <form method="POST" action="{{ route('create.countries') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-outline mb-4 mt-4">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="name" />
                    </div>

                    @if($errors->has('name'))
                        <p class="alert alert-danger">{{ $errors->first('name') }}</p>
                    @endif

                    <div class="form-outline mb-4 mt-4">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control" />
                    </div>

                    @if($errors->has('image'))
                        <p class="alert alert-danger">{{ $errors->first('image') }}</p>
                    @endif

                    <div class="form-outline mb-4 mt-4">
                        <label for="continent">Continent</label>
                        <input type="text" name="continent" id="continent" class="form-control" placeholder="continent" />
                    </div>

                    @if($errors->has('continent'))
                        <p class="alert alert-danger">{{ $errors->first('continent') }}</p>
                    @endif

                    <div class="form-outline mb-4 mt-4">
                        <label for="population">Population</label>
                        <input type="text" name="population" id="population" class="form-control" placeholder="population" />
                    </div>

                    @if($errors->has('population'))
                        <p class="alert alert-danger">{{ $errors->first('population') }}</p>
                    @endif

                    <div class="form-outline mb-4 mt-4">
                        <label for="video">Video</label>
                        <input type="file" name="video" id="video" class="form-control" />
                    </div>

                    @if($errors->has('video'))
                        <p class="alert alert-danger">{{ $errors->first('video') }}</p>
                    @endif

                    <div class="form-outline mb-4 mt-4">
                        <label for="territory">Territory</label>
                        <input type="text" name="territory" id="territory" class="form-control" placeholder="territory" />
                    </div>

                    @if($errors->has('territory'))
                        <p class="alert alert-danger">{{ $errors->first('territory') }}</p>
                    @endif

                    <div class="form-outline mb-4 mt-4">
                        <label for="avg_price">Average Price</label>
                        <input type="text" name="avg_price" id="avg_price" class="form-control" placeholder="avg_price" />
                    </div>

                    @if($errors->has('avg_price'))
                        <p class="alert alert-danger">{{ $errors->first('avg_price') }}</p>
                    @endif

                    <div class="form-floating">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" placeholder="description" id="description" style="height: 100px"></textarea>
                    </div>
                    <br>
                    @if($errors->has('description'))
                        <p class="alert alert-danger">{{ $errors->first('description') }}</p>
                    @endif
                    <br>

                    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Create</button>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection
