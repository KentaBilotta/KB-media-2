@extends('layouts.app')

@section('content')
    <div class="container" style="padding-top: 55px;">
        <div class="d-flex justify-content-center">
            <div class="bg-white" style="width: 20vw; height: 93vh;">
                <div class="border p-3 d-flex flex-column alingn-items-center" style="width: 20vw; height: 100vh; position: fixed; left: 0; top: 55px;">
                    @auth
                        <a class="w-100 side-link p-3 rounded-3" href="{{ route('channel') }}">
                            <i class="far fa-user"></i>
                            <span class="ms-3">{{ __('Il tuo canale') }}</span>
                        </a>

                        <a class="w-100 side-link p-3 rounded-3" href="{{ route('playlists-index') }}">
                            <i class="fas fa-list"></i>
                            <span class="ms-3">{{ __('Playlists') }}</span>
                        </a>

                        <a class="w-100 side-link p-3 rounded-3" href="{{ route('subscribed-channels') }}">
                            <i class="fas fa-people-group"></i>
                            <span class="ms-3">{{ __('Iscrizioni') }}</span>
                        </a>

                        <a class="w-100 side-link p-3 rounded-3" href="{{ route('liked-videos') }}">
                            <i class="far fa-thumbs-up"></i>
                            <span class="ms-3">{{ __('Video piaciuti') }}</span>
                        </a>
                    @else
                        <a class="btn btn-primary me-3 mt-3" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                        <div class="mt-3">Per avere tutti i vantaggi come iscriverti ai canali, mettere like ai video e salvarli nelle tue playlist personalizzate</div>
                    @endauth
                </div>
            </div>
            <div class="d-flex flex-column p-4" style="width: 80vw;">
                <h1>Le tue playlists</h1>
                <div class="d-flex justify-content-center">
                    <button id="mostra-form" class="btn btn-outline-primary px-4 py-2 rounded-4 mx-3 fs-5">Nuova Playlist</button>
                </div>
                <div id="form" class="mt-3 position-relative d-none">
                    <form action="{{ route('playlist-store') }}" method="POST" class="row g-3 needs-validation" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Scrivi il nome della playlist</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                            <div class="invalid-feedback">
                                @error('name')
                                    <ul>
                                        @foreach ($errors->get('name') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-success" type="submit">Crea</button>
                        </div>
                    </form>
                    <button id="nascondi-form" class="btn btn-outline-success position-absolute" style="bottom: 0; left: 4rem;">Annulla</button>
                </div>
                <div class="my-3 d-flex flex-wrap">
                    @foreach ($playlists as $playlist)
                        <div class="p-2 my-2 me-3" style="width: 17.5vw">
                            <a href="{{ route('playlist-videos', ['playlist' => $playlist]) }}" class="text-decoration-none text-black">
                                @foreach($playlist->videos->reverse()->slice(0, 1) as $video)
                                    <div class="position-relative">
                                        <img src="{{ asset($video->thumbnail ? 'storage/' . $video->thumbnail : 'storage/uploads/placeholder.jpeg') }}" alt="" style="width: 236px; height: 140px;" class="rounded-2">
                                        <div class="d-flex align-items-center justify-content-center position-absolute top-0 end-0 bg-black rounded-end" style="width: 50%; height: 140px; opacity: 0.8;">
                                            <i class="fas fa-list text-white fs-4"></i>
                                        </div>
                                    </div>
                                @endforeach
                                @if (count($playlist->videos) === 0)
                                    <div class="position-relative">
                                        <img src="storage/uploads/placeholder.jpeg" alt="" style="width: 236px; height: 140px;" class="rounded-2">
                                        <div class="d-flex align-items-center justify-content-center position-absolute top-0 end-0 bg-black rounded-end" style="width: 50%; height: 140px; opacity: 0.8;">
                                            <i class="fas fa-list text-white fs-4"></i>
                                        </div>
                                    </div>
                                @endif
                                <h4 class="mt-2">{{ $playlist->name }}</h4>
                                <div>{{ count($playlist->videos) }} video</div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        const newPlaylist = document.getElementById("mostra-form");
        const closeForm = document.getElementById("nascondi-form");

        newPlaylist.addEventListener("click", function() {
            document.getElementById("form").classList.remove("d-none");
        });

        closeForm.addEventListener("click", function() {
            document.getElementById("form").classList.add("d-none");
        });
    </script>
@endsection
