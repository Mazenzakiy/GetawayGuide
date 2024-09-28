@extends('layouts.app')



@section('content')
    {{-- start --}}
    <div class="about-main-content" style="margin-top: 10px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content">
                        <!-- Background video without effects -->
                        <div class="video-bg">
                            <video autoplay muted loop class="clear-video">
                                <source
                                    src="{{ asset("assets/videos/$city->video") }}"
                                    type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>

                        <!-- Main content -->
                        <h4>EXPLORE OUR CITY</h4>
                        <div class="line-dec"></div>
                        <h2>Welcome To {{ $city->name }}</h2>
                        <p>{{ $city->price }}</p>

                        <!-- Optional button -->
                        <div class="main-button">
                            <!-- Add button content here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- end --}}

    <div class="cities-town">
        <div class="container">
            <div class="row">
                <div class="slider-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2>landmark’s <em> &amp; </em></h2>

                        </div>
                        <div class="col-lg-12">
                            {{-- start new logic --}}
                            <div class="mt-4">
                                <h3>Select Landmarks</h3>
                                <div class="form-group">
                                    <label>How would you like to choose landmarks?</label>
                                    <div>
                                        <input type="radio" id="manual" name="choice" value="manual" checked>
                                        <label for="manual">Choose manually</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="preferences" name="choice" value="preferences">
                                        <label for="preferences">Based on my preferences</label>
                                    </div>
                                </div>

                                <div id="manual-selection" class="mt-3">
                                    <h4>All Landmarks</h4>
                                    @include('traveling.partial', ['landmarks' => $landmarks])
                                </div>

                                <div id="preferences-selection" class="mt-3" style="display: none;">
                                    <h4>Answer the following questions</h4>
                                    <form id="preferences-form">
                                        @csrf
                                        @foreach ($preferences as $preference)
                                            <div class="form-group">
                                                <label>{{ $preference->question }}</label>
                                                @if ($preference->type == 'single')
                                                    @foreach ($preference->options as $option)
                                                        <div>
                                                            <input type="radio" name="preferences[]"
                                                                value="{{ $option->id }}"
                                                                {{ $loop->first ? 'required' : '' }}>
                                                            <label>{{ $option->option }}</label>
                                                        </div>
                                                    @endforeach
                                                @elseif($preference->type == 'multiple')
                                                    @foreach ($preference->options as $option)
                                                        <div>
                                                            <input type="checkbox" name="preferences[]"
                                                                value="{{ $option->id }}">
                                                            <label>{{ $option->option }}</label>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        @endforeach
                                        <button type="submit" name="submit" class="btn btn-primary">Get
                                            Recommendations</button>
                                    </form>

                                    <div id="recommended-landmarks" class="mt-4">
                                        <!-- Recommended landmarks will be loaded here -->
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- end new logic --}}



    <!-- ***** Main Banner Area End ***** -->
@endsection

@section('addScripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const manualRadio = document.getElementById('manual');
            const preferencesRadio = document.getElementById('preferences');
            const manualSelection = document.getElementById('manual-selection');
            const preferencesSelection = document.getElementById('preferences-selection');
            const preferencesForm = document.getElementById('preferences-form');
            const recommendedLandmarks = document.getElementById('recommended-landmarks');

            manualRadio.addEventListener('change', toggleSelection);
            preferencesRadio.addEventListener('change', toggleSelection);

            function toggleSelection() {
                if (preferencesRadio.checked) {
                    manualSelection.style.display = 'none';
                    preferencesSelection.style.display = 'block';
                } else {
                    manualSelection.style.display = 'block';
                    preferencesSelection.style.display = 'none';
                }
            }

            preferencesForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(preferencesForm);
                const preferences = formData.getAll('preferences[]');
                console.log(preferences);

                const url = "{{ route('traveling.cities.preferences', $city->id) }}";
                console.log(url);

                fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                        body: formData,
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        if (data.landmarks) {
                            recommendedLandmarks.innerHTML = data.landmarks;
                        } else {
                            console.error('No landmarks returned', data);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });

        });
    </script>
@endsection
