@extends('layouts.app')

@section('content')
    <div class="my-cont" style="padding-top: 55px;">
        <div class="d-flex justify-content-center">
            @include('partials.sidebar')
            <div class="d-flex flex-column" style="width: 80vw;">
                <img src="{{ asset('storage/' . $user->cover_img) }}" alt="cover_img" style="width: 100%; height: 35vh; opacity: 0.9; object-fit: cover;">
                <div class="pt-3 ps-4 d-flex align-items-center">
                    <div class="d-flex">
                        <img src="{{ asset('storage/' . $user->logo) }}" alt="logo" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;" class="border border-white border-4">
                    </div>
                    <div class="mx-3">
                        <h2>{{ $user->name }}</h2>
                    </div>
                    <div class="mx-3 d-flex">
                        <div class="mx-3">Iscritti:<br>
                            @if($user->subscribers == null) 0
                            @else {{ number_format(substr_count($user->subscribers,","), 0,".",".") }} @endif
                        </div>
                        @auth
                            <div class="position-relative">
                                @if (strpos($user->subscribers, strval(Auth::user()->id)) !== false)
                                    <div class="position-absolute start-0 top-0 dropend">
                                        <button id="subscribe-button" class="btn btn-light border border-dark px-4 py-2 rounded-4 mx-3 fs-5 dropdown-toggle" style="width: 120px;" data-bs-toggle="dropdown" aria-expanded="false">Iscritto</button>
                                        <ul class="dropdown-menu">
                                            <li class="ms-2">
                                                <button class="btn btn-light">Attiva notifiche</button>
                                            </li>
                                            <li class="ms-2">
                                                <form action="{{ route('unsubscribe', ['user' => $user]) }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-light">Annulla Iscrizione</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                @else
                                    <div class="">
                                        <form action="{{ route('subscribe', ['user' => $user]) }}" method="POST" novalidate>
                                            @csrf
                                            <button id="subscribe-button" class="btn btn-outline-danger px-4 py-2 rounded-4 mx-3 fs-5" style="width: 120px;">Iscriviti</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        @endauth
                    </div>
                </div>
                <div class="d-flex ps-4 pt-3">
                    <a href="{{ route('ch-public', ['user' => $user]) }}" class="text-decoration-none text-black me-5 ele">
                        <h4 class="text-uppercase">video</h4>
                    </a>
                    <a href="" _target="_blank" class="text-decoration-none text-black me-5 ele">
                        <h4 class="text-uppercase">posts</h4>
                    </a>
                </div>
                <div class="d-flex flex-wrap p-4">
                    @if ($posts->isEmpty())
                        <div class="position-relative" style="height: 30vh; width: 100%;">
                            <div class="position-absolute top-0 start-50 translate-middle fs-5">
                                Questo canale non ha dei post
                            </div>
                        </div>
                    @else
                        @foreach($posts as $post)
                            <a href="{{ route('post-show', ['post' => $post]) }}" style="text-decoration: none; color: black;">
                                <div class="border p-3 rounded-4 me-3 mb-3" style="width: 30vw; height: 70vh;">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('storage/' . $post->user->logo) }}" alt="logo" style="width: 40px; height: 40px; border-radius: 50%;">
                                        <div class="ms-3 fw-bold">{{ $post->user->name }}</div>
                                    </div>
                                    <p class="card-text mt-3">{{ date_format($post->created_at, "d/m") }} &bull; {{ date_format($post->created_at, "H:i") }}</p>
                                    <p class="fs-5 lh-sm" style="height: 20%; overflow: hidden">{{ $post->description }}</p>
                                    <img src="{{ asset($post->image ? 'storage/' . $post->image : 'storage/uploads/placeholder.jpeg') }}" alt="w-100 h-50" class="rounded-4" style="width: 100%; height: 55%; object-fit: cover">
                                </div>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
