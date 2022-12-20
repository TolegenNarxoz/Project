@extends('layouts.adm')

@section('title', 'Users page')

@section('content')


    <table class="table">
        <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">{{__('messages.category_name')}}</th>
            <th scope="col">{{__('messages.category_code')}}</th>
            <th scope="col">{{__('messages.category_details')}}</th>
        </tr>
        </thead>
        <tbody>
        @for($i=0; $i<count($categories); $i++)
            <tr>
                <th scope="row">{{$i+1}}</th>
                <td>{{$categories[$i]->name}}</td>
                <td>{{$categories[$i]->code}}</td>
                <td>
                    <form action="{{route('categories.destroy', $categories[$i]->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm({{__('category_delete')}})" class="btn btn-outline-danger">{{__('messages.cart_delete')}}</button>
                    </form>
                </td>
            </tr>
        @endfor
        </tbody>
    </table>
@endsection
