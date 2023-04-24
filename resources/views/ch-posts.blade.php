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
                    <a href="{{ route('ch-posts') }}" _target="_blank" class="text-decoration-none text-black me-5 ele">
                        <h4 class="text-uppercase">I tuoi posts</h4>
                    </a>
                </div>
                @if (session('success_delete'))
                    <div class="alert alert-warning" role="alert">
                        Post deleted successfully
                    </div>
                @endif
                <div class="d-flex flex-wrap p-4">
                    @if ($posts->isEmpty())
                        <div class="position-relative" style="height: 30vh; width: 100%;">
                            <div class="position-absolute top-0 start-50 translate-middle fs-5">
                                Non hai post pubblicati
                            </div>
                        </div>
                    @else
                        @foreach($posts as $post)
                            <a href="{{ route('user-post-show', ['post' => $post]) }}" style="text-decoration: none; color: black;">
                                <div class="border p-3 rounded-4 me-3 mb-3" style="width: 30vw; height: 70vh;">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('storage/' . Auth::user()->logo) }}" alt="logo" style="width: 40px; height: 40px; border-radius: 50%;">
                                        <div class="ms-3 fw-bold">{{ Auth::user()->name }}</div>
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
