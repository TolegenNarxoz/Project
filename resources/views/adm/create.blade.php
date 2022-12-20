@extends('layouts.adm')

@section('title', 'Users page')

@section('content')

    <form action="{{route('categories.store')}}" method="post">
        @csrf
        <div class="form-group mb-3">
            <label>{{__('messages.category_name')}}</label>
            <input name="name" type="text" class="form-control" placeholder="{{__('messages.category_name')}}">
        </div>
        <div class="form-group mb-3">
            <label>{{__('messages.category_name')}}</label>
            <input name="name_en" type="text" class="form-control" placeholder="{{__('messages.category_name')}}">
        </div>
        <div class="form-group mb-3">
            <label>{{__('messages.category_name')}} на Русском</label>
            <input name="name_ru" type="text" class="form-control" placeholder="{{__('messages.category_name')}}">
        </div>
        <div class="form-group mb-3">
            <label>{{__('messages.category_name')}} на Казахском</label>
            <input name="name_kz" type="text" class="form-control" placeholder="{{__('messages.category_name')}}">
        </div>
        <div class="form-group mb-3">
            <label>{{__('messages.category_code')}}</label>
            <input name="code" type="text" class="form-control" placeholder="{{__('messages.category_code')}}">
        </div >
        <button type="submit" class="btn btn-outline-primary mb-3">{{__('messages.product_save')}}</button>
    </form>

@endsection
