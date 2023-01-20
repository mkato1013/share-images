<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Album') }}
        </h2>
        <h3 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- <a href="{{ route('photo.create') }}">{{ __('ImagePost') }}</a> --}}
        </h3>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ $album['name'] }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
