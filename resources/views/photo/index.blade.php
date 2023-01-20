<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Album') }}
        </h2>
        <h3 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- $photos[0]['album_id']]は投稿0の場合エラーがでるから修正する --}}
            <a href="{{ route('albums.photos.create', ['album' => $album['id']]) }}">{{ __('ImagePost') }}</a>
        </h3>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @foreach ($photos as $photo)
                        @if (isset($photo['photo_img']))
                            <img src="{{ $photo['photo_img'] }}" alt="投稿画像" width="30%" height="20%">
                        @else
                            <img src="{{ asset('image/noimage.jpeg') }}" alt="noimage" width="30%" height="20%">
                        @endif
                        <a
                            href="{{ route('photos.show', ['photo' => $photo['id']]) }}">{{ $photo['name'] }}</a>
                        <hr style="border:none;border-top:dashed 1px black;height:1px;width:300px;">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
