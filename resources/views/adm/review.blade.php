@extends('layouts.adm')

@section('title', 'Users page')

@section('content')

    <h1>Categories</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">Content</th>
            <th scope="col"></th>
            <th scope="col">####</th>
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
                        <button type="submit" onclick="return confirm('Do you really want to delete this review?')" class="btn btn-outline-danger">DELETE</button>
                    </form>
                </td>
            </tr>
        @endfor
        </tbody>
    </table>
@endsection
