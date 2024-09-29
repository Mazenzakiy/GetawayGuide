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

                <h5 class="card-title mb-4 d-inline">Landmarks</h5>
                <a href="{{ route('create.landmarks') }}" class="btn btn-primary mb-4 float-right">Add New Landmark</a>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">City</th>
                            <th scope="col">Description</th>
                            <th scope="col">Address</th>
                            <th scope="col">Categories</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($landmarks as $landmark)
                            <tr>
                                <th scope="row">{{ $landmark->id }}</th>
                                <td>{{ $landmark->name }}</td>
                                <td>{{ $landmark->city->name }}</td>
                                <td>{{ $landmark->desc }}</td>
                                <td>{{ $landmark->address }}</td>

                                <td>
                                    @if($landmark->categories->isNotEmpty())
                                        @foreach($landmark->categories as $category)
                                            <span class="badge bg-primary">{{ $category->name }}</span>
                                        @endforeach
                                    @else
                                        <span>No categories</span>
                                    @endif
                                </td>

                               <td> <a href="{{ route('edit.landmarks', $landmark->id) }}" class="btn btn-warning btn-sm">Edit</a></td>
                                <td>
                                    <form action="{{ route('destroy.landmarks', $landmark->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this landmark?');">
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
