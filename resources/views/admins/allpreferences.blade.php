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
                @if(session()->has('delete'))
                    <div class="alert alert-success">
                        {{ session()->get('delete') }}
                    </div>
                @endif
                <h5 class="card-title mb-4 d-inline">Preferences</h5>
                <a href="{{ route('create.preference') }}" class="btn btn-primary mb-4 text-center float-right">Create Preference</a>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Question</th>
                            <th scope="col">Type</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($preferences as $preference)
                            <tr>
                                <th scope="row">{{ $preference->id }}</th>
                                <td>{{ $preference->question }}</td>
                                <td>{{ $preference->type }}</td>
                                <td>
                                    <a href="{{ route('edit.preference', $preference->id) }}" class="btn btn-warning text-center">Edit</a>
                                </td>
                                <td>
                                    <!-- حذف باستخدام نموذج -->
                                    <form action="{{ route('delete.preference', $preference->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this preference?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger text-center">Delete</button>
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
