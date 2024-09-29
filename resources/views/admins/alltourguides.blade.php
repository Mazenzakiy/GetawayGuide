@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif

                <h5 class="card-title mb-4 d-inline">Tour Guides</h5>
                <a href="{{ route('create.tourguides') }}" class="btn btn-primary mb-4 float-right">Add New Tour Guide</a>

                <table class="table">
                    <thead>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Identification</th>
                            <th scope="col">identification_image</th>
                            <th scope="col">Age</th>
                            <th scope="col">Gender</th>
                            <th scope="col">City</th>
                            <th scope="col">Image</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allTourGuides as $tourGuide)
                            <tr>
                                <th scope="row">{{ $tourGuide->id }}</th>
                                <td>{{ $tourGuide->name }}</td>
                                <td>{{ $tourGuide->email }}</td>
                                <td>{{ $tourGuide->phone }}</td>
                                <td>{{ $tourGuide->identification }}</td>
                                <td>
                                    <img src="{{ asset('assets/images/' . $tourGuide->identification_image) }}" alt="{{ $tourGuide->name }}" width="50" height="50">
                                </td>
                                <td>{{ $tourGuide->age }}</td>
                                <td>{{ ucfirst($tourGuide->gendre) }}</td>
                                <td>{{ $tourGuide->city->name }}</td> <!-- عرض اسم المدينة -->

                                <td>
                                    <img src="{{ asset('assets/images/' . $tourGuide->image) }}" alt="{{ $tourGuide->name }}" width="50" height="50">
                                </td>
                                <td>
                                    <a href="{{ route('edit.tourguides', $tourGuide->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                </td>
                                <td>
                                    <form action="{{ route('delete.tourguides', $tourGuide->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this tour guide?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
