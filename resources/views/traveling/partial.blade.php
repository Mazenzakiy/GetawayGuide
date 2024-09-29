<div class="row">
    @forelse($landmarks as $landmark)
        <div class="col-md-4 mb-3">
            <div class="card">
                <a href="{{route('traveling.showLandmark',$landmark->id)}}">
                @if($landmark->mainImage)

                <img src="{{ asset('assets/images/' . $landmark->mainImage) }}" class="card-img-top" alt="{{ $landmark->name }}" height="300px">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $landmark->name }}</h5>
                    {{-- <p class="card-text">{{ $landmark->description }}</p> --}}
                </div>
            </a>
            </div>
        </div>
    @empty
        <p>No landmarks found.</p>
    @endforelse
</div>
