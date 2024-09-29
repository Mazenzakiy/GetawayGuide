@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4 d-inline">Edit Admin</h5>

                <form action="{{ route('admins.update.admins', $admin->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $admin->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $admin->email }}" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password (leave empty to keep current password):</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <button type="submit" class="btn btn-primary">Update Admin</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
