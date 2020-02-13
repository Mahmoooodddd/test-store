@extends('layouts.app')

@section('content')
    @foreach($orders as  $order)
        <p>{{$order['orderId']}}</p>

        <table>
            <thead>
            <tr>
                <th>id</th>
                <th>name</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order['products'] as $product)
                {{--@dd($order['products'])--}}
                <tr>
                    <td>{{$product['id']}}</td>
                    <td>{{$product['name']}}</td>
                    {{--<td></td>--}}
                </tr>
            @endforeach
            </tbody>
        </table>
        {{--<p>{{$order->status}}</p>--}}
        {{--<p>{{$order->name}}</p>--}}
        {{--<p>{{$order->price}}</p>--}}
{{--        <button type="button" class="show-order" order-id="{{$order['orderId']}}">Show Products</button>--}}
        <hr>


    @endforeach


@endsection


@section('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/myOrder.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            // myOrder.init();
        });
    </script>

@endsection
