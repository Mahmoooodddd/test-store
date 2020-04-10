@extends('layouts.app')

@section('content')
    <form action="/product/create" method="post">
        <label>name :</label>
        <input type="text" name="name">
        <label>price :</label>
        <input type="text" name="price">
        {{--<label>sell_amount :</label>--}}
        {{--<input type="text" name="sell_amount">--}}
        <br><br>
        {{ csrf_field() }}
        <button type="submit">send</button>
    </form>


@endsection
