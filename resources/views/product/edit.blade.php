@extends('layouts.app')

@section('content')
    <form action="/product/update/{{$product->id}}" method="post">
        <label>title:</label>
        <input type='text' name='name' value="{{$product->name}}">
        <input type='text' name='price' value="{{$product->price}}">
        <input type='text' name='sell_amount' value="{{$product->sell_amount}}">
        {{ csrf_field() }}
        <button type="submit">send</button>
    </form>


@endsection
