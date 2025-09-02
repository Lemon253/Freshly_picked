@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
<!--  -->
<form method="POST" action="{{ route('store') }}" enctype=""></form>
@endsection

@section('content')
<div>
    <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name">
        <input type="number" name="price">
        <input type="file" name="image_url">
        <input type="submit" value="登録">
    </form>
</div>
@endsection