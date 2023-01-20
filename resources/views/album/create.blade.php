<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Album') }}

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="/album" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" name="name" maxlength=100 placeholder="name" style="width:50%;"/>
                <br/>
                <br/>
                {{-- valueで送る値を指定 --}}
                <input type="radio" name="is_private" value=0 checked/> 公開
                <input type="radio" name="is_private" value=1 /> 非公開
                <br/>
                <br/>
                アルバムアイコン：<input type="file" name="icon">
                <br/>
                <br/>
                <input type="submit" value="作成">
            </form>
        </div>
    </div>
</x-app-layout>
