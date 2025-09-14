@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')
<div class="item-container">
    <div class="item-link-container">
        <a class="button-back" href="{{ route('products.index') }}">商品一覧</a>
        <p>{{ $item->name }}</p>
    </div>

    <form class="item-edit-form" action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="main-content-flex">
            <div class="item-left">
                <div class="item-image-container">
                    <img src="{{ asset('storage/img/' . $item->image)}}" alt="商品画像" />
                </div>
                <div class="select-button-container">
                    <label for="image" class="file-label">ファイルを選択</label>
                    <input type="file" class="file-input" id="image" name="image">
                    <span class="file-name-display">{{ $item->image }}</span>
                </div>
                <div class="form__error">
                    @error('image')
                    {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="item-right">
                <div class="form-group">
                    <p class="form-ttl">商品名</p>
                    <input type="text" id="name" name="name" value="{{ old('name', $item->name) }}">
                </div>
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>

                <div class="form-group">
                    <p class="form-ttl">値段</p>
                    <input type="text" id="price" name="price" value="{{ old('price', $item->price) }}">
                </div>
                <div class="form__error">
                    @error('price')
                    {{ $message }}
                    @enderror
                </div>

                <div class="form-group">
                    <p class="form-ttl">季節</p><br>
                    <div class="form-group__item-season">
                        @foreach($seasons as $season)
                        <input type="checkbox"
                            name="seasons[]"
                            value="{{ $season->id }}"
                            id="season-{{ $season->id }}"
                            {{ in_array($season->id, old('seasons', [])) || $item->seasons->contains($season->id) ? 'checked' : '' }}>
                        <label for="season-{{ $season->id }}">{{ $season->name }}</label>
                        @endforeach

                    </div>
                </div>
                <div class="form__error">
                    @error('seasons')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>

        <div class="item-bottom">
            <div class="form-group">
                <p class="form-ttl">商品説明</p><br>
                <textarea id="description" name="description">{{ old('description', $item->description) }}</textarea>
            </div>
            <div class="form__error">
                @error('description')
                {{ $message }}
                @enderror
            </div>

            <div class="button-group">
                <a class="button-back" href="{{ route('products.index') }}">戻る</a>
                <button type="submit" class="button-update">変更を保存</button>
            </div>
        </div>
    </form>

    <form action="{{ route('items.destroy', $item->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="button-delete">削除</button>
    </form>
</div>
@endsection