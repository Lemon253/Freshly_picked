@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register">
    <div class="register__header">
        <h2 class="register__header-ttl">商品登録</h2>
    </div>
    <form class="register__form" method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form__contents">
            <label for="name">商品名</label><br>
            <input type="text" id="name" name="name" value="{{ old('name') }}">
        </div>
        <div class="form__error">
            @error('name')
            {{ $message }}
            @enderror
        </div>

        <div class="form__contents">
            <label for="price">値段</label><br>
            <input type="number" id="price" name="price" value="{{ old('price') }}">
        </div>
        <div class="form__error">
            @error('price')
            {{ $message }}
            @enderror
        </div>

        <div class="form__contents">
            <label for="product-image">商品画像</label><br>
            <input type="file" id="image" name="image">
        </div>
        <div class="form__error">
            @error('image')
            {{ $message }}
            @enderror
        </div>

        <div class="form__contents">
            <label for="season">季節</label><br>
            <input type="checkbox" name="seasons[]" value="1" id="season-1" {{ in_array(1, old('seasons', [])) ? 'checked' : '' }}>
            <label for="season-1">春</label>
            <input type="checkbox" name="seasons[]" value="2" id="season-2" {{ in_array(2, old('seasons', [])) ? 'checked' : '' }}>
            <label for="season-2">夏</label>
            <input type="checkbox" name="seasons[]" value="3" id="season-3" {{ in_array(3, old('seasons', [])) ? 'checked' : '' }}>
            <label for="season-3">秋</label>
            <input type="checkbox" name="seasons[]" value="4" id="season-4" {{ in_array(4, old('seasons', [])) ? 'checked' : '' }}>
            <label for="season-4">冬</label>
        </div>
        <div class="form__error">
            @error('seasons')
            {{ $message }}
            @enderror
        </div>

        <div class="form__contents">
            <label for="description">商品説明</label><br>
            <textarea name="description" id="description">{{ old('description') }}
            </textarea>
        </div>
        <div class="form__error">
            @error('description')
            {{ $message }}
            @enderror
        </div>

        <div class="form__contents">
            <a class="button-back" href="{{ route('products.index') }}">戻る</a>
            <button type="submit" class="button-register">登録</button>
        </div>
    </form>
</div>
@endsection