@extends('layouts.app')

@section('title', 'Cart PAGE')

@section('content')

    <h1>{{__('messages.cart_page')}}</h1>

    <div class="container">
        <div class="row">
            <table class="table">
                @foreach($productsInCart as $product)
                    <tr>
                        <td>{{$product->name}}</td>
                        <td>{{$product->pivot->number}}</td>
                        <td>{{$product->pivot->color}}</td>
                        <td>{{$product->pivot->status}}</td>
                        <td>
                            <form action="{{route('cart.deletefromcart', $product->id)}}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            <form action="{{route('cart.buy')}}" method="post">
                @csrf
                <button type="submit" class="btn-success">Buy all</button>
            </form>
        </div>
    </div>

@endsection
