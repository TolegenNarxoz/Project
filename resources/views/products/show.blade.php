{{--@vite(['resources/sass/app.scss', 'resources/js/app.js'])--}}

@extends('layouts.app')

@section('title', 'INDEX PAGE')

@section('content')
            <div class="container">
                <div class="row">
                    @error('buy')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                    <div class="container">
                        <div class="row">
                            <div class="col-5">
                                <div class="card m-3" style="width: 20rem;">
                                    <img src="{{$product->img}}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">{{$product->price}}$</li>
                                    </ul>
                                    <div class="card-body">
                                        @can('delete', $product)
                                        <a href="{{route('products.edit', $product->id)}}" class="card-link btn btn-primary">{{__('messages.button_edit')}}</a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                            <div class="col-7 mb-lg-2">
                                <h1>{{$product->name}}</h1>
                                <div>
                                    <p>{{$product->content}}</p>
                                </div>

                            </div>
                            <div class="col-7 mb-lg-5 m-5">
                                <div>
                                    @auth()
                                    <form action="{{route('products.basketAll ', $product->id)}}" method="post">
                                        @csrf
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <input type="number" name="number" placeholder="1">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <select class="form-select" name="color">
                                                    <option value="White">{{__('messages.color_white')}}</option>
                                                    <option value="Black">{{__('messages.color_black')}}</option>
                                                    <option value="Red">{{__('messages.color_red')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button class="btn btn-success">{{__('messages.button_buy')}}</button>
                                    </form>
                                    @endauth
                                </div>

                            </div>
                        </div>
                        <div class="row">
                                <form action="{{route('reviews.store')}}" method="post">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label>{{__('messages.leave_review')}}</label>
                                        <input name="content" type="text" class="form-control w-60 p-3">
                                        <input name="product_id" value="{{$product->id}}" type="hidden">
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-3">{{__('messages.save_review')}}</button>
                                </form>
                        </div>
                        <div class="row">
                            <div>
                                @foreach($product->reviews as $review)
                                        <div class="bg-light p-5 m-2 rounded">
                                            <p class="lead"><font style="vertical-align: inherit;"></font><font style="vertical-align: inherit;">{{$review->content}}</font></p>
                                            <p>{{$review->created_at}}</p>
                                            <form action="{{route('reviews.destroy', $review->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Do you really want to delete this review?')" class="btn btn-danger">DELETE</button>
                                            </form>
                                        </div>
                                @endforeach
                            </div>
                        </div>


                    </div>
                </div>
            </div>
@endsection
