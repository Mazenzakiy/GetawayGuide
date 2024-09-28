@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>{{ isset($country) ? 'Edit Country' : 'Create New Country' }}</h1>

    <!-- نموذج لإنشاء أو تعديل دولة -->
    <form action="{{ isset($country) ? route('update.countries', $country->id) : route('storeCountries') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($country))
            @method('PUT')
        @endif

        <!-- حقل الاسم -->
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $country->name ?? '') }}" required>
            @if($errors->has('name'))
                <p class="alert alert-danger">{{ $errors->first('name') }}</p>
            @endif
        </div>

        <!-- حقل السكان -->
        <div class="form-group">
            <label for="population">Population</label>
            <input type="text" name="population" id="population" class="form-control" value="{{ old('population', $country->population ?? '') }}" required>
            @if($errors->has('population'))
                <p class="alert alert-danger">{{ $errors->first('population') }}</p>
            @endif
        </div>

        <!-- حقل الإقليم -->
        <div class="form-group">
            <label for="territory">Territory</label>
            <input type="text" name="territory" id="territory" class="form-control" value="{{ old('territory', $country->territory ?? '') }}" required>
            @if($errors->has('territory'))
                <p class="alert alert-danger">{{ $errors->first('territory') }}</p>
            @endif
        </div>

        <!-- حقل السعر المتوسط -->
        <div class="form-group">
            <label for="avg_price">Average Price</label>
            <input type="text" name="avg_price" id="avg_price" class="form-control" value="{{ old('avg_price', $country->avg_price ?? '') }}" required>
            @if($errors->has('avg_price'))
                <p class="alert alert-danger">{{ $errors->first('avg_price') }}</p>
            @endif
        </div>

        <!-- حقل الوصف -->
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ old('description', $country->description ?? '') }}</textarea>
            @if($errors->has('description'))
                <p class="alert alert-danger">{{ $errors->first('description') }}</p>
            @endif
        </div>

        <!-- القارة -->
        <div class="form-group">
            <label for="continent">Continent</label>
            <input type="text" name="continent" id="continent" class="form-control" value="{{ old('continent', $country->continent ?? '') }}" required>
            @if($errors->has('continent'))
                <p class="alert alert-danger">{{ $errors->first('continent') }}</p>
            @endif
        </div>

        <!-- تحميل الصورة -->
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
            @if($errors->has('image'))
                <p class="alert alert-danger">{{ $errors->first('image') }}</p>
            @endif
        </div>

        <!-- تحميل الفيديو -->
        <div class="form-group">
            <label for="video">Video</label>
            <input type="file" name="video" id="video" class="form-control" accept="video/*">
            @if($errors->has('video'))
                <p class="alert alert-danger">{{ $errors->first('video') }}</p>
            @endif
        </div>

        <!-- زر الحفظ -->
        <button type="submit" class="btn btn-primary">{{ isset($country) ? 'Update' : 'Create' }}</button>
    </form>
</div>
@endsection
    