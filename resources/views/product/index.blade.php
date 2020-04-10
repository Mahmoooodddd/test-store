@extends('layouts.app')

@section('content')
    <a href="/product/new"><button>New Product</button></a>
    <br><br>
    <table>
    <thead>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>price</th>
        <th>created_at</th>
        <th>updated_at</th>
        <th>sell_amount</th>
    </tr>
    </thead>
    </table>
    @foreach($products as $product)
        <table>
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->created_at}}</td>
                <td>{{$product->updated_at}}</td>
                <td>{{$product->sell_amount}}</td>
                <td><a href="/product/delete/{{$product->id}}"><button>delete</button></a></td>
                <td><a href="/product/edit/{{$product->id}}"><button>edit</button></a></td>

            </tr>
        </table>

    @endforeach

    {{$products->render()}}



@endsection
