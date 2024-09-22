@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Your Cart</h2>

        @if (session('cart'))
            <table class="table" style="margin: 5%">
                <thead>
                    <tr>
                        <th>Landmark</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach (session('cart') as $landmark)

                        <tr>
                            <td>{{ $landmark->name }}</td>
                            <td>
                                <form action="{{ route('traveling.cart.remove', $landmark->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="margin: 5%">

                <h3>Select the number of days for your holiday</h3>
                <form id="cart-form" action="{{ route('traveling.cart.process') }}" method="POST">
                    @csrf
                    <div class="form-group">
                    <label for="days">Number of days:</label>
                    <input type="number" name="days" id="days" class="form-control" required min="1">
                    </div>

                    <div id="article-section"
                        style="display: none; padding: 20px; border: 2px solid #ccc; background-color: #f9f9f9; border-radius: 8px;">
                        <h4 style="font-size: 1.5em; text-align: center; margin-bottom: 20px;">Read this article</h4>

                        <p style="font-weight: bold; line-height: 1.6; font-size: 1.1em;">

                            <b>Plan Your Perfect Holiday with Ease!</b><br><br>

                            Since you've selected more than one day for your holiday, we’re excited to share that we’ve
                            partnered with Booking.com to ensure your stay is comfortable and relaxing. We take care of
                            every detail, from accommodation to transport, making your trip stress-free.<br><br>

                            Our expert tour guides are here to help you every step of the way. From the moment you arrive,
                            they'll handle everything from start to finish:<br><br>

                        <ul style="padding-left: 20px;">
                            <li style="list-style: circle">Personalized itineraries based on your preferences</li>
                            <li style="list-style: circle">Safe and comfortable transportation between landmarks</li>
                            <li style="list-style: circle">Recommendations for the best local restaurants, shops, and
                                experiences</li>
                            <li style="list-style: circle">Insider knowledge of each landmark, ensuring you don't miss any
                                hidden gems</li>
                        </ul>

                        <br>

                        With our trusted partners and dedicated guides, you can sit back, relax, and enjoy your holiday
                        without any worries. We're here to make your experience unforgettable!
                        </p>

                        <div style="text-align: center; margin-top: 20px;">
                            <input type="checkbox" name="agree" id="agree"> I agree to the terms
                        </div>
                    </div>

                    <input type="hidden" name="city_id" value="{{$city_id}}">

            <!-- Group Type Selection -->
            <div>
                <h4>Select Group Type</h4>


                    <label>
                        <input type="radio" name="group" value="boys" required> Boys
                    </label>
                    <label>
                        <input type="radio" name="group" value="girls"> Girls
                    </label>
                    <label>
                        <input type="radio" name="group" value="family"> Family
                    </label>
                    <br>

            </div>


                    <button type="submit"  class="btn btn-primary" style="margin-top: 2%">Next step</button>
                </form>
            </div>
    </div>
@else
    <p>Your cart is empty.</p>
    @endif
    </div>
@endsection

@section('addScripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const daysInput = document.getElementById('days');
            const articleSection = document.getElementById('article-section');
            const agreeCheckbox = document.getElementById('agree');
            const form = document.getElementById('cart-form');

            // Show or hide the article section based on the number of days
            daysInput.addEventListener('input', function() {
                const days = parseInt(daysInput.value, 10);

                if (days > 1) {
                    articleSection.style.display = 'block';
                    agreeCheckbox.required = true;
                } else {
                    articleSection.style.display = 'none';
                    agreeCheckbox.required = false;
                }
            });

            // Form submission handler
            form.addEventListener('submit', function(e) {
                const days = parseInt(daysInput.value, 10);

                // If days > 1, check if the user agreed to the article
                if (days > 1 && !agreeCheckbox.checked) {
                    e.preventDefault();
                    alert("You must agree to the article before proceeding.");
                }
            });
        });
    </script>
@endsection
