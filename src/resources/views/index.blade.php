@extends('layouts.app')
<style>
    svg.w-5.h-5 {
        /*paginateメソッドの矢印の大きさ調整のために追加*/
        width: 30px;
        height: 30px;
    }
</style>

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="flex__item">
    <div class="flex__header">
        <h1 class="flex__search-ttl">商品一覧</h1>
        <div class="flex__header__create-button">
            <a href="/register" class="create-button__link">+商品を追加</a>
        </div>
    </div>

    <div class="main-container">
        <div class="contents__left">
            <form class="search-form" action="{{ route('items.search') }}" method="get">
                <div class="search-form__item">
                    <input class="search-form__item-input" type="text" name="search" @if(session('searches.search')) value="{{ session('searches.search') }}" @endif />
                    <div class="search-form__button">
                        <button class="search-form__button-submit" type="submit" name="submit" value="submit">検索</button>
                    </div>

                    <h3 class="search-form-sort-ttl">価格順で表示</h3>
                    <select class="search-form__item-select-sort" name="sort">
                        <option value="" @if(request('sort')=='' ) selected @endif>価格で並べ替え</option>
                        <option value="asc" @if(request('sort')=='asc' ) selected @endif>低い順に表示</option>
                        <option value="desc" @if(request('sort')=='desc' ) selected @endif>高い順に表示</option>
                    </select>
                </div>
            </form>
        </div>

        <div class="card-list">
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
    </div>
    {{ $products->links() }}
</div>
@endsection