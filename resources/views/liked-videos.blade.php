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
                <div class="d-flex align-items-center justify-content-between">
                    <h1>Video Piaciuti</h1>
                </div>
                <div class="my-3">
                    @foreach ($likes->reverse() as $like)
                        <a href="{{ route('watch', ['video' => $like->video]) }}" class="text-decoration-none text-black">
                            <div class="border rounded-4 p-2 my-2 d-flex align-items-center">
                                <div class="w-25">
                                    <img src="{{ asset($like->video->thumbnail ? 'storage/' . $like->video->thumbnail : 'storage/uploads/placeholder.jpeg') }}" class="rounded-4" alt="thumbnail" style="width: 235px; height: 140px; object-fit: cover;">
                                </div>
                                <div class="w-75 ms-3">
                                    <div>
                                        <h3>{{ $like->video->title }}</h3>
                                        @if ($like->video->user)
                                            <a href="{{ route('ch-public', ['user' => $like->video->user]) }}" class="ch-link" style="">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('storage/' . $like->video->user->logo) }}" alt="logo" style="width: 30px; height: 30px; border-radius: 50%;">
                                                    <div class="ms-3" style="height: 20px; overflow: hidden;">{{ $like->video->user->name }}</div>
                                                </div>
                                            </a>
                                        @endif
                                        <p class="mt-2 card-text">pubblicato il {{ date_format($like->video->created_at, "d/m") }} alle {{ date_format($like->video->created_at, "H:i") }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
