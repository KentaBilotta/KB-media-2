@extends('layouts.app')

@section('content')
<div class="my-cont" style="padding-top: 55px;">
    <div class="d-flex justify-content-center">
        @include('partials.sidebar')
        <div class="d-flex flex-column" style="width: 80vw;">
            <div class="border rounded-4 d-flex m-3">
                <div class="w-50 m-4">
                    <a href="{{ route('ch-public', ['user' => $post->user]) }}" class="ch-link" style="">
                        <div class="d-flex align-items-center">
                            <img src="{{ $post->user->logo }}" alt="logo" style="width: 40px; height: 40px; border-radius: 50%;">
                            <div class="ms-3 fw-bold">{{ $post->user->name }}</div>
                        </div>
                    </a>
                    <p class="card-text mt-3">{{ date_format($post->created_at, "d/m") }} &bull; {{ date_format($post->created_at, "H:i") }}</p>
                    <div>
                        <form action="{{ route('post-destroy', ['post'=>$post])}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-delete-me px-4 py-2 rounded-4 fs-5">Elimina</button>
                        </form>
                    </div>
                    <div>
                        <img src="{{ asset($post->image ? 'storage/' . $post->image : 'storage/uploads/placeholder.jpeg') }}" alt="w-100 h-50" class="mt-3 rounded-4" style="width: 90%; height: 100%; object-fit: cover">
                        <p class="fs-5 lh-sm mt-3" style="width: 90%; height: 90%; overflow: hidden; align-self: center;">{{ $post->description }}</p>
                    </div>
                </div>
                <div class="w-50 m-4">
                    <h3 class="mb-3">Commenti</h3>
                    @foreach ($postcomments as $postcomment)
                        <div class="d-flex my-3">
                            <div>
                                <img src="{{ $postcomment->user->logo }}" alt="logo" style="width: 40px; height: 40px; border-radius: 50%; border: 1px solid #91cd39;">
                            </div>
                            <div class="ms-3">
                                <a href="{{ route('ch-public', ['user' => $postcomment->user]) }}" class="ch-link">
                                    <h5>{{ $postcomment->user->name }}</h5>
                                </a>
                                <p>{{ $postcomment->description }}</p>
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
@endsection
