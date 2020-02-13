@extends('layouts.app')

@section('content')
    @foreach($products as $product)
        <p>{{$product['name']}}</p>
        <p>{{$product['price']}}</p>
        <button class="add-to-basket" product-id="{{$product['id']}}">add to basket</button>
        @if ($product['isLiked'])
            <button type="button" class="unLike-product" product-id="{{$product['id']}}">unLike</button>
            @else
            <button type="button" class="like-product" product-id="{{$product['id']}}">Like</button>

        @endif




    @endforeach
@endsection


@section('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/homePage.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            homePage.init();
        });

    </script>
@endsection
