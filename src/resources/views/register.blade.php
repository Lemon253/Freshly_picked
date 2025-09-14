@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="contents">
    <div class="register">
        <p class="register__ttl">商品登録</p>
        <form class="register__form" method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form__contents">
                <p class="from__ttl">商品名<span class="required-mark">必須</span></p>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="商品名を入力">
            </div>
            <div class="form__error">
                @error('name')
                {{ $message }}
                @enderror
            </div>

            <div class="form__contents">
                <p class="form__ttl">値段<span class="required-mark">必須</span></p>
                <input type="number" id="price" name="price" value="{{ old('price') }}" placeholder="値段を入力">
            </div>
            <div class="form__error">
                @error('price')
                {{ $message }}
                @enderror
            </div>

            <div class="form__contents">
                <p class="form__ttl">商品画像<span class="required-mark">必須</span></p>
                <input type="file" id="image" name="image">
            </div>
            <div class="form__error">
                @error('image')
                {{ $message }}
                @enderror
            </div>

            <div class="form__contents">
                <p class="form__ttl">季節<span class="required-mark">必須</span><span class="required-mark--text">複数選択可</span></p>
                <input type="checkbox" name="seasons[]" value="1" id="season-1" {{ in_array(1, old('seasons', [])) ? 'checked' : '' }}>
                <label for="season-1" class="checkbox-text">春</label>
                <input type="checkbox" name="seasons[]" value="2" id="season-2" {{ in_array(2, old('seasons', [])) ? 'checked' : '' }}>
                <label for="season-2" class="checkbox-text">夏</label>
                <input type="checkbox" name="seasons[]" value="3" id="season-3" {{ in_array(3, old('seasons', [])) ? 'checked' : '' }}>
                <label for="season-3" class="checkbox-text">秋</label>
                <input type="checkbox" name="seasons[]" value="4" id="season-4" {{ in_array(4, old('seasons', [])) ? 'checked' : '' }}>
                <label for="season-4" class="checkbox-text">冬</label>
            </div>
            <div class="form__error">
                @error('seasons')
                {{ $message }}
                @enderror
            </div>

            <div class="form__contents">
                <p class="form__ttl">商品説明<span class="required-mark">必須</span></p>
                <textarea name="description" id="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
            </div>
            <div class="form__error">
                @error('description')
                {{ $message }}
                @enderror
            </div>

            <div class="form__button">
                <a class="button-back" href="{{ route('products.index') }}">戻る</a>
                <button type="submit" class="button-register">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection