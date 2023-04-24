@extends('layouts.app')

@section('content')
    <div class="my-cont" style="padding-top: 55px;">
        <div class="d-flex justify-content-center">
            <div style="width: 20vw; height: 93vh;">
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
            <div class="d-flex flex-column" style="width: 80vw;">
                <div class="m-3">
                    <form action="{{ route('post-store') }}" method="POST" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label for="description" class="form-label">Descrizione</label>
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

                        <div class="mb-3">
                            <label for="image" class="form-label">Immagine</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image') }}">
                            <div class="invalid-feedback">
                                @error('image')
                                    <ul>
                                        @foreach ($errors->get('image') as $error)
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
                </div>
            </div>
        </div>
    </div>
@endsection
