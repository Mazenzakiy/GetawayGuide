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
                <h5 class="card-title mb-4 d-inline">Bookings</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Number of Guests</th>
                            <th scope="col">Check-in Date</th>
                            <th scope="col">Destination</th>
                            <th scope="col">Days</th>
                            <th scope="col">Tour Guide Status</th>
                            <th scope="col">Tour Guide Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Payment</th>
                            <th scope="col">Change Status</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <th scope="row">{{ $booking->id }}</th>
                                <td>{{ $booking->name }}</td>
                                <td>{{ $booking->phone_number }}</td>
                                <td>{{ $booking->num_guests }}</td>
                                <td>{{ $booking->check_in_date }}</td>
                                <td>{{ $booking->destination }}</td>
                                <td>{{ $booking->days }}</td>
                                <td>{{ $booking->tourGuide_status }}</td>
                                <td>{{ $booking->tourGuide_name }}</td>
                                <td>{{ $booking->status }}</td>
                                <td>${{ $booking->price }}</td>

                                @if ($booking->status == 'Booked Successfully')
                                    <td><a href="{{ route('edit.bookings', $booking->id) }}" class="btn btn-success text-white">Approved</a></td>
                                @else
                                    <td><a href="{{ route('edit.bookings', parameters: $booking->id) }}" class="btn btn-warning text-white">Change Status</a></td>
                                @endif
                                <td><a href="{{ route('delete.bookings', $booking->id) }}" class="btn btn-danger">Delete</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
