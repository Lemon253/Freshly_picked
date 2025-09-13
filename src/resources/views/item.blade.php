@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')
<!-- 中身の確認 -->
<!-- <?php print_r($item) ?> -->

<div class="flex-item">
    <div class="item-link">
        <a class="button-back" href="{{ route('products.index') }}">商品一覧</a>
        <p>{{ $item->name }}</p>
    </div>
    <form class="item-edit" action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="item__left">
            <div class="item-image">
                <!-- 画像の参照元指定 -->
                <img src="{{ asset('storage/img/' . $item->image)}}" alt="商品画像" />
            </div>

            <div class="select-button">
                <label for="image">ファイルを選択</label>
                <input type="file" class="item-edit__image" id="image" name="image" style="display:none;">
                <span>{{ $item->image }}</span>
            </div>
            <div class="form__error">
                @error('image')
                {{ $message }}
                @enderror
            </div>
            <div class="item-right">
                <div class="item-name">
                    <label for="item-ttl-name">商品名</label>
                    <input type="text" class="item-edit__name" id="name" name="name" value="{{ old('name', $item->name) }}">
                </div>
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>

                <div class="item-price">
                    <label for="item-ttl-price">値段</label>
                    <input type="text" class="item-edit__price" id="price" name="price" value="{{ old('price', $item->price) }}">
                </div>
                <div class="form__error">
                    @error('price')
                    {{ $message }}
                    @enderror
                </div>

                <div class="item-season">
                    <label for="item-ttl-season">季節</label><br>
                    @foreach($seasons as $season)
                    <input type="checkbox"
                        name="seasons[]"
                        value="{{ $season->id }}"
                        {{ in_array($season->id, old('seasons', [])) || $item->seasons->contains($season->id) ? 'checked' : '' }}>
                    {{ $season->name }}
                    @endforeach
                </div>
                <div class="form__error">
                    @error('seasons')
                    {{ $message }}
                    @enderror
                </div>

            </div>
            <div class="item-bottom">
                <div class="item-explanation">
                    <label for="item-explain">商品の説明</label><br>
                    <textarea class="item-edit__description" id="description" name="description">{{ old('description', $item->description) }}
                    </textarea>
                </div>
                <div class="form__error">
                    @error('description')
                    {{ $message }}
                    @enderror
                </div>

                <div class="item-bottom__flex">
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