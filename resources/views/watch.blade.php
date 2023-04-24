@extends('layouts.app')

@section('content')
    <div class="my-cont d-flex" style="padding-top: 55px;">
        <div id="screen" class="d-none">
            <div class="bg-light border border-dark p-3 rounded-4">
                <form action="{{ route('comment-store', ['video' => $video]) }}" method="POST" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
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
        <div class="player p-4" style="width: 70vw;">
            <div class="w-100 mt-3">
                <video controls style="width: 95%; height: 60vh; object-fit: cover; object-position: center;" {{-- autoplay --}} controlsList="nodownload">
                    <source src="{{ asset('storage/'. $video->video_path) }}" type="video/mp4">
                </video>
            </div>

            @if (session('already_exist'))
                <div class="alert alert-warning my-2" role="alert">
                    Video esiste già in ' {{ session('already_exist')->name }} '
                </div>
            @endif

            <div class="my-3 w-75">
                <h3>{{ $video->title }}</h3>
                <p>{{ $video->description }}</p>
                @if ($video->user)
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('ch-public', ['user' => $video->user]) }}" class="text-black" style="text-decoration: none;">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('storage/' . $video->user->logo) }}" alt="logo" style="width: 50px; height: 50px; border-radius: 50%;">
                                <div>
                                    <div class="ms-3 fs-4 bold">{{ $video->user->name }}</div>
                                    <div class="mx-3">Iscritti:
                                        @if($video->user->subscribers == null) 0
                                        @else {{ number_format(substr_count($video->user->subscribers,","), 0,".",".") }}@endif
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="mx-3 d-flex align-items-center">
                            {{-- <div>
                                <form action="{{ route('subscribe', ['user' => $video->user]) }}" method="POST" novalidate>
                                    @csrf
                                    <button id="subscribe-button" class="btn btn-outline-danger px-4 py-2 rounded-4 mx-3 fs-5">Iscriviti</button>
                                </form>
                            </div> --}}
                            @auth
                                <div class="d-flex">
                                    <div class="likes mx-2 d-flex">
                                        <a href="{{ route('liked', ['video' => $video]) }}" class="text-decoration-none text-black">
                                            @if (str_contains(strval(json_encode($likes)), '"user_id":' . Auth::user()->id) !== false)
                                                <i class="fas fa-thumbs-up fs-4 me-2"></i>
                                            @else
                                                <i class="far fa-thumbs-up fs-4 me-2"></i>
                                            @endif
                                        </a>
                                        <div>{{ count($likes) }}</div>
                                    </div>
                                    <div class="dislikes mx-2 d-flex">
                                        <a href="{{ route('unliked', ['video' => $video]) }}" class="text-decoration-none text-black">
                                            @if (str_contains(strval(json_encode($dislikes)), '"user_id":' . Auth::user()->id) !== false)
                                                <i class="fas fa-thumbs-down fs-4 me-2"></i>
                                            @else
                                                <i class="far fa-thumbs-down fs-4 me-2"></i>
                                            @endif
                                        </a>
                                        <div>{{ count($dislikes) }}</div>
                                    </div>
                                </div>
                                <div class="dropend">
                                    <div data-bs-toggle="dropdown" aria-expanded="false">
                                        <button class="btn btn-light border border-dark px-4 py-2 rounded-4 mx-3 fs-5">Salva</button>
                                    </div>
                                    <ul class="dropdown-menu">
                                        @foreach ($playlists as $playlist)
                                            @if ($playlist->user_id === Auth::user()->id)
                                                <li class="ms-2">
                                                    <form action="{{ route('save-on-watch-later', ['video' => $video, 'playlist' => $playlist]) }}" method="POST">
                                                        @csrf

                                                        <button class="btn btn-light">{{ $playlist->name }}</button>
                                                    </form>
                                                </li>
                                            @else
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            @endauth
                        </div>
                    </div>
                @endif
            </div>

            <div class="my-3 w-75">
                <h3 class="mb-4">Commenti</h3>
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
                    @foreach ($comments as $comment)
                        @if ($comment->user->id === Auth::user()->id)
                            <div class="d-flex my-3 user-comment position-relative">
                                <div>
                                    <img src="{{ asset('storage/' . $comment->user->logo) }}" alt="logo" style="width: 40px; height: 40px; border-radius: 50%; border: 1px solid #91cd39;">
                                </div>
                                <div class="ms-3">
                                    <a href="{{ route('ch-public', ['user' => $comment->user]) }}" class="ch-link">
                                        <h5>{{ $comment->user->name }}</h5>
                                    </a>
                                    <p>{{ $comment->description }}</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-center position-absolute top-50 end-0 translate-middle-y text-center dropend">
                                    <div class="tre-puntini" data-bs-toggle="dropdown" aria-expanded="false">&#8230;</div>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Modifica &#9998;</a></li>
                                        <li>
                                            {{-- <form action="{{ route('comment-destroy', ['comment' => $comment]) }}" method="POST">
                                                @method('DELETE')
                                                @csrf --}}
                                                <button class="dropdown-item">Elimina &#128465;</button>
                                            {{-- </form> --}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @else
                            <div class="d-flex my-3">
                                <div>
                                    <img src="{{ $comment->user->logo }}" alt="logo" style="width: 40px; height: 40px; border-radius: 50%; border: 1px solid #91cd39;">
                                </div>
                                <div class="ms-3">
                                    <a href="{{ route('ch-public', ['user' => $comment->user]) }}" class="ch-link">
                                        <h5>{{ $comment->user->name }}</h5>
                                    </a>
                                    <p>{{ $comment->description }}</p>
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
        <div class="list p-3 d-flex flex-column align-items-center" style="width: 30vw">
            <h5 class="text-center my-3">- VIDEO SIMILI -</h5>
            @foreach($videos->slice(0, 15) as $video)
                <a href="{{ route('watch', ['video' => $video]) }}" style="text-decoration: none; color: black;">
                    <div class="d-flex me-3 mb-3" style="width: 24rem;">
                        <img src="{{ asset($video->thumbnail ? 'storage/' . $video->thumbnail : 'storage/uploads/placeholder.jpeg') }}" class="rounded-4 me-3" alt="thumbnail_watch" style="width: 40%; height: 120px; object-fit: cover;">
                        <div style="width: 60%">
                            <h5>{{ $video->title }}</h5>
                            <p>{{ date_format($video->created_at, "d/m") }} &bull; {{ date_format($video->created_at, "H:i") }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
