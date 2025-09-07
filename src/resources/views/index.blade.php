@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="flex__item">
    <div class="flex__header">
        <h2 class="flex__header-ttl">商品一覧</h2>
        <div class="flex__header__create-button">
            <a href="/item" class="create-button__link">購入に進む</a>
        </div>

    </div>
    <div class="contents">
        <div class="contents__left">
            検索欄とカテゴリ選択
        </div>
        <div class="card">

            <div class="card__image">
                <!-- imageのurl指定 -->
            </div>
            <!-- </a> -->
            <div class="card__content">
                <div class="card__content-common">
                    <div class="card__buy">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection