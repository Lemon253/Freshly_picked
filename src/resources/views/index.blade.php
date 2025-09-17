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
        @if(session('searches.search'))
        <p class="flex__search-ttl"><span class="current-search-term">”{{ session('searches.search') }}”の</span>商品一覧</p>
        @else
        <p class="flex__search-ttl">商品一覧</p>
        <div class="flex__header__create-button">
            <a href="/register" class="create-button__link">+商品を追加</a>
        </div>
        @endif
    </div>

    <div class="main-container">
        <div class="contents__left">
            <form class="search-form" action="{{ route('items.search') }}" method="get">
                <div class="search-form__item">
                    <input class="search-form__item-input" type="text" name="search" placeholder="商品名で検索" @if(session('searches.search')) value="{{ session('searches.search') }}" @endif />
                    <div class="search-form__button">
                        <button class="search-form__button-submit" type="submit" name="submit" value="submit">検索</button>
                    </div>

                    <h3 class="search-form-sort-ttl">価格順で表示</h3>
                    <select class="search-form__item-select-sort" name="sort">
                        <option value="" class="gray" disabled selected @if(request('sort')=='' ) selected @endif>価格で並べ替え</option>
                        <option value="asc" @if(request('sort')=='asc' ) selected @endif>低い順に表示</option>
                        <option value="desc" @if(request('sort')=='desc' ) selected @endif>高い順に表示</option>
                    </select>
                </div>
                @if(request('sort'))
                <div style="border: 1px solid #ddd; padding: 10px; border-radius: 20px; width: 158px;">
                    @if(request('sort') == 'asc')
                    低い順に表示
                    @elseif(request('sort') == 'desc')
                    高い順に表示
                    @endif
                    <span style="float: right; cursor: pointer;">
                        <a href="{{ route('products.index') }}" style="text-decoration: none; color: #333;">x</a>
                    </span>
                </div>
                @endif
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