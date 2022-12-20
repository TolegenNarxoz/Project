@extends('layouts.adm')

@section('title', 'CREATE PAGE')

@section('content')

    <div class="container">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

            <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label>{{__('messages.product_name')}}</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter product name">
                </div>

                <div class="form-check">
                    <label>{{__('messages.product_content')}}</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" name="content" cols="10" rows="5"></textarea>
                </div >

                <div class="form-check">
                    <label>{{__('messages.product_content')}}</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" name="content_en" cols="10" rows="5"></textarea>
                </div >

                <div class="form-check">
                    <label>{{__('messages.product_content')}} на Русском</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" name="content_ru" cols="10" rows="5"></textarea>
                </div >

                <div class="form-check">
                    <label>{{__('messages.product_content')}} на Казахском </label>
                    <textarea class="form-control @error('content') is-invalid @enderror" name="content_kz" cols="10" rows="5"></textarea>
                </div >

                <div class="form-group mb-3">
                    <label>{{__('messages.product_price')}}</label>
                    <input name="price" type="number" class="form-control @error('price') is-invalid @enderror" placeholder="Enter post price">
                </div>

                <div class="form-group mb-3">
                    <select class="form-select @error('category_id') is-invalid @enderror" aria-label="Disabled select example" name="category_id">
                        <option selected disabled>{{__('messages.product_category')}}</option>
                        @foreach($categories as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="imgInput">{{__('messages.product_img')}}</label>
                    <input name="img" type="file" class="form-control @error('img') is-invalid @enderror" id="imgInput">
                </div>
                <button type="submit" class="btn btn-outline-primary mb-3">{{__('messages.product_save')}}</button>
            </form>

@endsection

