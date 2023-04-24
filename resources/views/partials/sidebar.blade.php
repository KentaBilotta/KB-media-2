<div style="width: 20vw;">
    <div class="border p-2 d-flex flex-column alingn-items-center" style="width: 20vw; height: 93vh; position: fixed; left: 0; top: 55px;">
        @auth
            <a class="w-100 side-link p-3 rounded-3" href="{{ route('channel') }}">
                <i class="fas fa-user"></i>
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
