@extends('layouts.app')

@section('content')
    <div class="my-cont" style="padding-top: 55px;">
        <div class="d-flex justify-content-center">
            @include('partials.sidebar')
            <div class="d-flex flex-column p-4" style="width: 80vw;">
                <div class="d-flex flex-wrap">
                    @foreach($videos->slice(0, 8) as $video)
                        <a href="{{ route('watch', ['video' => $video]) }}" style="text-decoration: none; color: black;">
                            <div class="me-3 mb-4" style="width: 16rem; height: 16.5rem;">
                                <img src="{{ asset($video->thumbnail ? 'storage/' . $video->thumbnail : 'storage/uploads/placeholder.jpeg') }}" class="rounded-4" alt="thumbnail" style="width: 100%; height: 140px; object-fit: cover;">
                                <div class="">
                                    <div class="fs-5" style="height: 65px; overflow: hidden; font-weight: 900;">{{ $video->title }}</div>
                                    <div class="">
                                        @if ($video->user)
                                            <a href="{{ route('ch-public', ['user' => $video->user]) }}" class="ch-link" style="">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('storage/' . $video->user->logo) }}" alt="logo" style="width: 30px; height: 30px; border-radius: 50%;">
                                                    <div class="ms-3" style="height: 20px; overflow: hidden;">{{ $video->user->name }}</div>
                                                </div>
                                            </a>
                                        @endif
                                    </div>
                                    <p class="mt-2 card-text">pubblicato il {{ date_format($video->created_at, "d/m") }} alle {{ date_format($video->created_at, "H:i") }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="p-3 my-4 d-flex" style="border-top: 5px solid lightgrey; border-bottom: 5px solid lightgrey; overflow-x: scroll; overflow-y: hidden;">
                    @foreach($posts->slice(0, 5) as $post)
                        <a href="{{ route('post-show', ['post' => $post]) }}" style="text-decoration: none; color: black;">
                            <div class="border p-3 rounded-4 me-3 mb-3" style="width: 25vw; height: 50vh;">
                                <div class="d-flex align-items-center">
                                    @if ($post->user)
                                        <img src="{{ asset('storage/' . $post->user->logo) }}" alt="logo" style="width: 40px; height: 40px; border-radius: 50%;">
                                        <div class="ms-3 fw-bold">{{ $post->user->name }}</div>
                                        <div class="card-text ms-3">{{ date_format($post->created_at, "d/m") }} &bull; {{ date_format($post->created_at, "H:i") }}</div>
                                    @endif
                                </div>
                                <p class="fs-5 lh-sm mt-3" style="height: 20%; overflow: hidden">{{ $post->description }}</p>
                                <img src="{{ asset($post->image ? 'storage/' . $post->image : 'storage/uploads/placeholder.jpeg') }}" alt="w-100 h-50" class="rounded-4" style="width: 100%; height: 55%; object-fit: cover">
                            </div>
                        </a>
                    @endforeach
                    <a href="{{ route('posts-index') }}" class="btn btn-light border border-dark rounded-5" style="align-self: center;"><nobr>Vedi di più ></nobr></a>
                </div>

                <div class="d-flex flex-wrap">
                    @foreach($videos->slice(8, 48) as $video)
                        <a href="{{ route('watch', ['video' => $video]) }}" style="text-decoration: none; color: black;">
                            <div class="me-3 mb-4" style="width: 16rem; height: 16.5rem;">
                                <img src="{{ asset($video->thumbnail ? 'storage/' . $video->thumbnail : 'storage/uploads/placeholder.jpeg') }}" class="rounded-4" alt="thumbnail" style="width: 100%; height: 140px; object-fit: cover;">
                                <div class="">
                                    <div class="fs-5" style="height: 65px; overflow: hidden; font-weight: 900;">{{ $video->title }}</div>
                                    <div class="">
                                        @if ($video->user)
                                            <a href="{{ route('ch-public', ['user' => $video->user]) }}" class="ch-link" style="text-decoration: none;">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('storage/' . $video->user->logo) }}" alt="logo" style="width: 30px; height: 30px; border-radius: 50%;">
                                                    <div class="ms-3" style="height: 20px; overflow: hidden;">{{ $video->user->name }}</div>
                                                </div>
                                            </a>
                                        @endif
                                    </div>
                                    <p class="mt-2 card-text">pubblicato il {{ date_format($video->created_at, "d/m") }} alle {{ date_format($video->created_at, "H:i") }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

