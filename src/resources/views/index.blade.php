@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="flex__item">
    <div class="flex__header">
        <h2 class="flex__header-ttl">商品一覧</h2>
        <div class="flex__header__create-button">
            <a href="/register" class="create-button__link">+商品を追加</a>
        </div>

    </div>
    <div class="contents">
        <div class="contents__left">
            検索欄とカテゴリ選択
        </div>
        @foreach($products as $product)
        <div class="card">
            <a href="{{ route('item',['id' => $product->id]) }}">
                <div class="card__image">
                    <!-- imageのurl指定 -->
                    <img src="{{ asset('storage/img/' . $product->image)}}" />
                </div>
            </a>
            <div class="card__content">
                <div class="card__content-common">
                    <div class="card__name">{{ $product->name }}</div>
                    <div class="card__price">¥{{ $product->price }}</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{ $products->links() }}
</div>
@endsection