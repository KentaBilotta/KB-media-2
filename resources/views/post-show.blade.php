@extends('layouts.app')

@section('content')
<div class="my-cont" style="padding-top: 55px;">
    <div class="d-flex justify-content-center">
        <div id="screen" class="d-none">
            <div class="bg-light border border-dark p-3 rounded-4">
                <form action="{{ route('postcomment-store', ['post' => $post]) }}" method="POST" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label for="description" class="form-label">Il tuo commento</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
                        <div class="invalid-feedback">
                            @error('description')
                                <ul>
                                    @foreach ($errors->get('description') as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-success" type="submit">Carica</button>
                    </div>
                </form>
                <div class="mt-3">
                    <button id="no-comment" class="btn btn-outline-success">Annulla</button>
                </div>
            </div>
        </div>
        @include('partials.sidebar')
        <div class="d-flex flex-column" style="width: 80vw;">
            <div class="border rounded-4 d-flex m-3">
                <div class="w-50 m-4">
                    <a href="{{ route('ch-public', ['user' => $post->user]) }}" class="ch-link" style="">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('storage/' . $post->user->logo) }}" alt="logo" style="width: 40px; height: 40px; border-radius: 50%;">
                            <div class="ms-3 fw-bold">{{ $post->user->name }}</div>
                        </div>
                    </a>
                    <p class="card-text mt-3">{{ date_format($post->created_at, "d/m") }} &bull; {{ date_format($post->created_at, "H:i") }}</p>
                    <div>
                        <img src="{{ asset($post->image ? 'storage/' . $post->image : 'storage/uploads/placeholder.jpeg') }}" alt="w-100 h-50" class="mt-3 rounded-4" style="width: 90%; height: 100%; object-fit: cover">
                        <p class="fs-5 lh-sm mt-3" style="width: 90%; height: 90%; overflow: hidden; align-self: center;">{{ $post->description }}</p>
                    </div>
                </div>
                <div class="w-50 m-4">
                    <h3 class="mb-3">Commenti</h3>
                    @auth
                        <div class="d-flex mb-4 align-items-center">
                            <div>
                                <img src="{{ asset('storage/' . Auth::user()->logo) }}" alt="logo" style="width: 50px; height: 50px; border-radius: 50%; border: 1px solid #91cd39;">
                            </div>
                            <div class="ms-3">
                                <button id="write-comment" class="btn btn-light border border-dark">Inserisci un commento</button>
                            </div>
                        </div>
                    @else
                        <div class="d-flex mb-4 align-items-center">
                            <div>Se vuoi commentare e vedere i commenti, allora</div>
                            <div class="ms-3"><a class="btn btn-primary" href="{{ route('login') }}">{{ __('Accedi') }}</a></div>
                        </div>
                    @endauth
                    @auth
                        @foreach ($postcomments as $postcomment)
                            @if ($postcomment->user->id === Auth::user()->id)
                                <div class="d-flex my-3 user-comment position-relative">
                                    <div>
                                        <img src="{{ asset('storage/' . $postcomment->user->logo) }}" alt="logo" style="width: 40px; height: 40px; border-radius: 50%; border: 1px solid #91cd39;">
                                    </div>
                                    <div class="ms-3">
                                        <a href="{{ route('ch-public', ['user' => $postcomment->user]) }}" class="ch-link">
                                            <h5>{{ $postcomment->user->name }}</h5>
                                        </a>
                                        <p>{{ $postcomment->description }}</p>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center position-absolute top-50 end-0 translate-middle-y text-center dropend">
                                        <div class="tre-puntini" data-bs-toggle="dropdown" aria-expanded="false">&#8230;</div>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Modifica &#9998;</a></li>
                                            <li><button class="dropdown-item">Elimina &#128465;</button></li>
                                        </ul>
                                    </div>
                                </div>
                            @else
                                <div class="d-flex my-3">
                                    <div>
                                        <img src="{{ asset('storage/' . $postcomment->user->logo) }}" alt="logo" style="width: 40px; height: 40px; border-radius: 50%; border: 1px solid #91cd39;">
                                    </div>
                                    <div class="ms-3">
                                        <a href="{{ route('ch-public', ['user' => $postcomment->user]) }}" class="ch-link">
                                            <h5>{{ $postcomment->user->name }}</h5>
                                        </a>
                                        <p>{{ $postcomment->description }}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <div class="d-flex">
                            <div>
                                <img src="https://as1.ftcdn.net/v2/jpg/00/33/04/38/1000_F_33043820_Jqjz72pjMYYpORHNy6EWyXSyAfbuy5b8.jpg" alt="logo" style="width: 40px; height: 40px; border-radius: 50%; border: 1px solid #91cd39;">
                            </div>
                            <div class="ms-3">
                                <h5>Hater1</h5>
                                <p>fai schifo, fai schifo, fai schifo, fai schifo, fai schifo, fai schifo, fai schifo, fai schifo, fai schifo, fai schifo, fai schifo, fai schifo, fai schifo, fai schifo, fai schifo, fai schifo,</p>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
