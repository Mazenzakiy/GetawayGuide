@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-3">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Countries</h5>
                <p class="card-text">Number of countries: {{ $countriesCount }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Cities</h5>
                <p class="card-text">Number of cities: {{ $citiesCount }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Admins</h5>
                <p class="card-text">Number of admins: {{ $adminsCount }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Landmarks</h5>
                <p class="card-text">Number of landmarks: {{ $landmarksCount }}</p>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Tour Guides</h5>
                <p class="card-text">Number of tour guides: {{ $tourGuidesCount }}</p>
            </div>
        </div>
    </div>
@endsection
