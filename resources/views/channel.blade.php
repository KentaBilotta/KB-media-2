@extends('layouts.app')

@section('content')
    <div class="my-cont" style="padding-top: 55px;">
        <div class="d-flex justify-content-center">
            @include('partials.sidebar')
            <div class="d-flex flex-column" style="width: 80vw;">
                <img src="{{ asset(Auth::user()->cover_img ? 'storage/' . Auth::user()->cover_img : 'storage/uploads/placeholder.jpeg') }}" alt="cover_img" style="width: 100%; height: 35vh; opacity: 0.9; object-fit: cover;">
                <div class="pt-3 ps-4 d-flex align-items-center">
                    <div class="d-flex">
                        <img src="{{ asset('storage/' . Auth::user()->logo) }}" alt="logo" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;" class="border border-white border-4">
                    </div>
                    <div class="mx-3">
                        <h2>{{ Auth::user()->name }}</h2>
                    </div>
                    <div class="mx-3 d-flex">
                        <div class="mx-3">Iscritti:<br>
                            @if(Auth::user()->subscribers == null) 0
                            @else {{ number_format(substr_count(Auth::user()->subscribers,","), 0,".",".") }}
                            @endif
                        </div>
                        <div>
                            <a href="{{ route('video-create') }}" class="btn btn-outline-primary px-4 py-2 rounded-4 mx-3 fs-5">Carica video</a>
                        </div>
                        <div>
                            <a href="{{ route('post-create') }}" class="btn btn-outline-primary px-4 py-2 rounded-4 mx-3 fs-5">Carica post</a>
                        </div>
                    </div>
                </div>
                <div class="d-flex ps-4 pt-3">
                    <a href="{{ route('channel') }}" class="text-decoration-none text-black me-5 ele">
                        <h4 class="text-uppercase">I tuoi video</h4>
                    </a>
                    <a href="{{ route('ch-posts') }}" class="text-decoration-none text-black me-5 ele">
                        <h4 class="text-uppercase">I tuoi posts</h4>
                    </a>
                </div>
                @if (session('success_delete'))
                    <div class="alert alert-warning" role="alert">
                        Video '{{ session('success_delete')->title }}' deleted successfully
                    </div>
                @endif
                <div class="d-flex flex-wrap p-4">
                    @if ($videos->isEmpty())
                        <div class="position-relative" style="height: 30vh; width: 100%;">
                            <div class="position-absolute top-0 start-50 translate-middle fs-5">
                                Non hai video pubblicati
                            </div>
                        </div>
                    @else
                        @foreach($videos as $video)
                            <a href="{{ route('video-show', ['video' => $video]) }}" style="text-decoration: none; color: black;">
                                <div class="card me-3 mb-3" style="width: 16rem; height: 16.5rem;">
                                    <img src="{{ asset($video->thumbnail ? 'storage/' . $video->thumbnail : 'storage/uploads/placeholder.jpeg') }}" class="card-img-top" alt="thumbnail" style="width: 100%; height: 140px; object-fit: cover;">
                                    <div class="card-body">
                                        <h5 class="card-title" style="height: 65px; overflow: hidden;">{{ $video->title }}</h5>
                                        <p class="card-text">pubblicato il {{ date_format($video->created_at, "d/m") }} alle {{ date_format($video->created_at, "H:i") }}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
