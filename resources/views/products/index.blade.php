@extends('layouts.app')

@section('title', 'INDEX PAGE')

@section('content')

    <div class="container">
        <div class="row">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        @foreach($categories as $cat)
                            <a class="btn btn-outline-secondary" href="{{route('products.category', $cat->id)}}">{{$cat->{'name_'.app()->getLocale()} }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            @foreach($products as $product)
                <div class="card m-3" style="width: 18rem;">
                    <img src="{{$product->img}}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">{{$product->name}}</h5>
{{--                        <p class="card-text">{{$product->content}}</p>--}}
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">{{$product->price}}$</li>
                    </ul>
                    <div class="card-body">
                        <a href="{{route('products.show', $product->id)}}" class="btn btn-success">{{__('messages.button_buy')}}</a>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
@endsection
