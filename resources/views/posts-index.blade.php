@extends('layouts.app')

@section('content')
<div class="my-cont" style="padding-top: 55px;">
    <div class="d-flex justify-content-center">
        @include('partials.sidebar')
        <div class="d-flex flex-column" style="width: 80vw;">
            <div class="d-flex flex-wrap p-4">
                @foreach($posts as $post)
                    <a href="{{ route('post-show', ['post' => $post]) }}" style="text-decoration: none; color: black;">
                        <div class="border p-3 rounded-4 me-3 mb-3" style="width: 70vw; height: 80vh;">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('storage/' . $post->user->logo) }}" alt="logo" style="width: 40px; height: 40px; border-radius: 50%;">
                                <div class="ms-3 fw-bold">{{ $post->user->name }}</div>
                            </div>
                            <p class="card-text mt-3">{{ date_format($post->created_at, "d/m") }} &bull; {{ date_format($post->created_at, "H:i") }}</p>
                            <div class="d-flex h-75">
                                <img src="{{ asset($post->image ? 'storage/' . $post->image : 'storage/uploads/placeholder.jpeg') }}" alt="post-img" class="mt-3 rounded-4" style="width: 50%; height: 100%; object-fit: cover">
                                <p class="fs-5 lh-sm ms-3 mt-3" style="width: 50%; height: 90%; overflow: hidden; align-self: center;">{{ $post->description }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
