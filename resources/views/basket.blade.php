@extends('layouts.app')

@section('content')
    @foreach ($products as $product)
        <p>{{$product['name']}}</p>
        <p>{{$product['price']}}</p>
        <input type="number"  class="update" value="{{$product['number']}}" product-id="{{$product['productId']}}">
        <p>{{$product['total']}}</p>
        <button class="delete" product-id="{{$product['productId']}}">delete</button>
        {{--<button class="update" product-id="{{$product->id}}">update</button>--}}
    @endforeach
    <br><br>
    @if ($loggedInUser = Auth::user())
        <button id="finish">finish</button>
        @else
        <a href="http://localhost:8000/login"><button>login</button></a>
    @endif
@endsection


@section('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/basket.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            basket.init();
        });
    </script>
@endsection

