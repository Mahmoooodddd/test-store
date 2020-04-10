@extends('layouts.app')

@section('content')
    {{--@foreach($favoriteProducts as  $favoriteProduct)--}}
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>id</th>
                <th>name</th>
            </tr>
            </thead>
            <tbody>
            <tr>

                @foreach($favoriteProducts as  $favoriteProduct)
                <td>{{$favoriteProduct->id}}</td>
                <td>{{$favoriteProduct->name}}</td>

            </tr>
        {{--</table>--}}
        {{--<div>--}}
            {{--<button type="button" class="show-favorite" favoriteProduct-id="{{$favoriteProduct->id}}">Show favorites--}}
            {{--</button>--}}
            {{--<button type="button" class="unLike-product" favoriteProduct-id="{{$favoriteProduct->id}}">unLike</button>--}}
            {{--<p>{{$favoriteProduct->id}}</p>--}}
            {{--<p>{{$favoriteProduct->name}}</p>--}}
            {{--<button type="button" class="show-favorite" favoriteProduct-id="{{$favoriteProduct->id}}">Show favorites--}}
            {{--</button>--}}
            {{--<button type="button" class="unLike-product" favoriteProduct-id="{{$favoriteProduct->id}}">unLike</button>--}}
        {{--</div>--}}
        {{--<hr>--}}


    @endforeach
            </tbody>
    </table>


@endsection


@section('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/myFavorite.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            // myFavorite.init();
        });
    </script>

@endsection
