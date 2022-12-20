@extends('layouts.adm')

@section('title', 'CREATE PAGE')

@section('content')

    <form action="{{route('products.update', $product->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label>{{__('messages.product_name')}}</label>
            <input name="name" type="text" value="{{$product->name}}" class="form-control">
        </div>

        <div class="form-check">
            <label>{{__('messages.product_content')}}</label>
            <textarea class="form-control" name="content" cols="20" rows="10">{{$product->content}}</textarea>
        </div >

        <div class="form-group mb-3">
            <label>{{__('messages.product_price')}}</label>
            <input name="price" value="{{$product->price}}" type="number" class="form-control">
        </div>

        <div class="form-group mb-3">
            <select class="form-select w-25 p-2" aria-label="Disabled select example" name="category_id">
                @foreach($categories as $cat)
                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label>{{__('messages.product_img')}}</label>
            <input name="img" type="text" class="form-control" value="{{$product->img}}">
        </div>

        <div>
            <button type="submit" class="btn btn-outline-primary mb-3">{{__('messages.button_save')}}</button>
        </div>
    </form>
    <div>
        <form action="{{route('products.destroy', $product->id)}}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-outline-danger mb-3">{{__('messages.cart_delete')}}</button>
        </form>
    </div>

@endsection

