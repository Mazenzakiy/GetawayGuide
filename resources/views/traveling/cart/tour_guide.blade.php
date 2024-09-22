@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Display number of days -->
        <h2>Your Cart</h2>
        @if (session('cart'))
            <table class="table" style="margin: 5%">
                <thead>
                    <tr>
                        <th>Days</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $days }}</td>
                        <td><a href="{{ route('traveling.cart.show') }}">Edit</a></td>
                    </tr>
                </tbody>
            </table>

            <!-- Question: Choose between Online or In-Person Tour Guide -->
            <form action="{{route('traveling.cart.send.tourGuide')}}" method="POST">
                @csrf

                <!-- Choose Tour Guide Type -->
                <div class="form-group">
                    <h4>Choose Your Tour Guide Type</h4>
                    <label>
                        <input type="radio" name="guide_type" value="online" required>
                        Online Tour Guide
                    </label>
                    <br>
                    <label>
                        <input type="radio" name="guide_type" value="in_person">
                        Tour Guide in Land
                    </label>
                </div>

                <!-- Description Section -->
                <div class="form-group" id="guide-description">
                    <h5>Guide Type Information</h5>
                    <p>
                    <h4> <b>Virtual Tour Guide</b></h4>
                        Choosing a Virtual Tour Guide ensures that you’ll have expert guidance every step of the way, right
                        from the moment you start planning your holiday. Your virtual guide will be with you, assisting with
                        reservations, transportation, and providing recommendations for each location.<br>

                        What makes the virtual guide special is the constant support. You’ll share your live location
                        throughout your journey, so your guide can keep track of your route and ensure you’re always headed
                        in the right direction. Whether you need help with bookings, navigating unfamiliar areas, or simply
                        want local insights, your virtual guide is always just a message or call away, ensuring a smooth and
                        safe experience, all from the convenience of your mobile device.
                    </p>
                    <p>
                    <h4> <b>Physical Tour Guide</b></h4>

                        Physical Tour Guide
                        With a Physical Tour Guide, you’ll have a dedicated, in-person expert who will accompany you
                        throughout your entire holiday, helping you with reservations, transportation, and every aspect of
                        your travel experience. From navigating the best local spots to ensuring everything goes smoothly,
                        your guide will be there by your side.<br>

                        Having someone physically present ensures that all your needs are addressed immediately, providing
                        personalized attention and real-time assistance. Whether you're exploring landmarks, dining out, or
                        managing logistics, your guide’s presence guarantees that you enjoy a stress-free holiday, knowing
                        that everything is taken care of.
                    </p>
                </div>

                <!-- Tour Guide Section -->
                <div id="tour-guide-section" style="margin-top: 30px;">
                    <h4>Select a Tour Guide</h4>

                    <!-- Table for displaying tour guides -->
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Identification</th>
                                <th>Identification Image</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>City</th>
                                <th>Image</th>
                                <th>Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tourGuides as $tourGuide)
                                <tr>
                                    <td>{{ $tourGuide->name }}</td>
                                    <td>{{ $tourGuide->email }}</td>
                                    <td>{{ $tourGuide->identification }}</td>
                                    <td>
                                        @if ($tourGuide->identification_image)
                                            <img src="{{ asset("assets/images/$tourGuide->identification_image") }}"
                                                alt="ID Image" style="width: 50px; height: 50px;">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>{{ $tourGuide->age }}</td>
                                    <td>{{ $tourGuide->gendre }}</td>
                                    <td>{{ $tourGuide->city->name }}</td>
                                    <td>
                                        @if ($tourGuide->image)
                                            <img src="{{ asset("assets/images/$tourGuide->image") }}" alt="Guide Image"
                                                style="width: 90px; height: 90px;">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>
                                        <input type="radio" name="tourGuide_id" value="{{ $tourGuide->id }}" required>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Submit button -->
                <div class="form-group">
                    <input type="hidden" name="days" value="{{ $days }}">
                    <button type="submit" class="btn btn-success">Submit and Reserve</button>
                </div>
            </form>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>
@endsection

@section('addScripts')
@endsection
