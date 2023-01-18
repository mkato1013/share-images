{{-- <x-app-layout> の記述で、app.blade.phpを読み込める --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Albums') }}
        </h2>
        <h3 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('album.create') }}">{{ __('Create') }}</a>
        </h3>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @foreach ($albums as $album)
                        <a href="{{ route('album.show', ['id' => $album['id']]) }}">{{ $album['name'] }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
