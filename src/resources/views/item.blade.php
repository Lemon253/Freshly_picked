@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')
<div class="flex-item">
    <div class="item__left">
        <div class="item-image">
            <!-- 画像の参照元指定 -->
            <img src="{{ asset('storage/' . $item->image_url)}}" />
        </div>
    </div>
    <div class="item__right">
        <div class="item-content">
            <div class="item__title">
                <h2>{{ $item->name }}</h2>
            </div>
            <div class="item__price">¥1000</div>
            <div class="item__price">¥{{ $item->price }}税込）送料込み</div>
            <a href="/item">
                <div class="buy">商品を購入する</div>
            </a>
        </div>
        <div class="item-explanation">
            <h2>商品の説明</h2>
            <p>test</p>
        </div>
    </div>
</div>
@endsection