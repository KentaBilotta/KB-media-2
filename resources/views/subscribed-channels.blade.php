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
                <h1>Canali a cui sei iscritto</h1>
                <div class="my-3 d-flex flex-wrap">
                    @foreach ($users as $user)
                        @if (strpos($user->subscribers, strval(Auth::user()->id)) !== false)
                            <a href="{{ route('ch-public', ['user' => $user]) }}" class="text-black mb-3 me-3" style="text-decoration: none; width: 30vw;">
                                <div class="border border-dark position-relative rounded-3 mb-3 me-3" style="height: 40vh;">
                                    <img src="{{ asset('storage/' . $user->cover_img) }}" alt="" style="height: 25vh; width: 100%; object-fit: cover;" class="rounded-top">
                                    <div class="position-absolute top-50 start-50 translate-middle">
                                        <img src="{{ asset('storage/' . $user->logo) }}" alt="logo" style="width: 150px; height: 150px; border-radius: 50%;" class="border border-white border-4">
                                    </div>
                                    <div class="fs-2 fw-bold text-center mt-4 bold" style="overflow: hidden; height: 46px;">{{ $user->name }}</div>
                                    <div class="mx-3 fs-5 text-center">Iscritti:
                                        @if($user->subscribers == null) 0
                                        @else {{ number_format(substr_count($user->subscribers,","), 0,".",".") }}@endif
                                    </div>
                                </div>
                            </a>
                        @else
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
