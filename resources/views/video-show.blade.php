@extends('layouts.app')

@section('content')
    <div class="my-cont">
        <div class="d-flex justify-content-center">
            @include('partials.sidebar')
            <div class="d-flex flex-column" style="width: 80vw;">
                <div class="my-cont d-flex" style="padding-top: 55px;">
                    <div class="player p-4" style="width: 70vw;">
                        <div class="w-100 mt-3">
                            <video controls style="width: 95%; height: 60vh; object-fit: cover; object-position: center;" autoplay>
                                <source src="{{ asset('storage/'. $video->video_path) }}" type="video/mp4">
                            </video>
                        </div>

                        <div class="my-3 w-75 d-flex justify-content-between">
                            <div>
                                <h3>{{ $video->title }}</h3>
                                <p>{{ $video->description }}</p>
                            </div>
                            <div class="mx-3 h-25 fs-5">Iscritti: <br>
                                @if(Auth::user()->subscribers == null) 0
                                @else {{ number_format(substr_count(Auth::user()->subscribers,","), 0,".",".") }}
                                @endif
                            </div>
                            <div>
                                <form action="{{ route('video-destroy', ['video'=>$video])}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger btn-delete-me px-4 py-2 rounded-4 mx-3 fs-5">Elimina</button>
                                </form>
                            </div>
                        </div>

                        <div class="my-3 w-75">
                            @foreach ($comments as $comment)
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
