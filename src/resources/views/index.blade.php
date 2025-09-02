@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="flex__item">
    @foreach($items as $item)
    <div class="card">
        <a href="{{ route('item',['id' => $item->id]) }}">

            <div class="card__image">
                <!-- imageのurl指定 -->
                <img src="{{ asset('storage/' . $item->image_url)}}" />
            </div>
        </a>
        <div class="card__content">
            <div class="card__content-common">
                <div class="card__price">¥{{ $item->price }}</div>
                <div class="card__buy">
                    <!-- <a href="/item" class="card__link">購入に進む</a> -->
                    <a href="{{ route('item',['id' => $item->id]) }}" class="card__link">購入に進む</a>
                </div>
            </div>
            <h2 class="card__ttl">{{ $item->name }}</h2>
        </div>
    </div>
    @endforeach
</div>
@endsection