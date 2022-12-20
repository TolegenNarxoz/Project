@extends('layouts.adm')

@section('title', 'Users page')

@section('content')
    <form action="{{route('products.search')}}" method="GET">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">@</span>
            </div>
            <input type="text" name="search" class="form-control" placeholder="Search" aria-label="Username" aria-describedby="basic-addon1">
            <button class="btn btn-success ml-2" type="submit">{{__('messages.search')}}</button>
        </div>
    </form>
    @if (session('admin'))

    @endif
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('messages.user_name')}}</th>
            <th scope="col">{{__('messages.user_email')}}</th>
            <th scope="col">{{__('messages.user_role')}}</th>
            <th scope="col">{{__('messages.user_active')}}</th>
            <th scope="col">{{__('messages.user_details')}}</th>
        </tr>
        </thead>
        <tbody>
        @for($i=0; $i<count($users); $i++)
            <tr>
                <th scope="row">{{$i+1}}</th>
                <td>{{$users[$i]->name}}</td>
                <td>{{$users[$i]->email}}</td>
                <td>{{$users[$i]->role->name}}</td>
                <td>
                    <form action="
                    @if($users[$i]->is_active)
                        {{route('adm.users.ban', $users[$i]->id)}}
                    @else
                        {{route('adm.users.unban', $users[$i]->id)}}
                    @endif
                    " method="post">
                        @csrf
                        @method('PUT')
                        <button class="btn {{$users[$i]->is_active  ? 'btn-outline-danger' : 'btn-outline-success'}}" type="submit">
                            @if($users[$i]->is_active)
                                {{__('messages.button_ban')}}
                            @else
                                {{__('messages.button_unban')}}
                            @endif
                        </button>
                    </form>
                </td>
                <td>
                    <a href="{{route('adm.users.edit', $users[$i]->id)}}" class="btn btn-outline-success">{{__('messages.button_edit')}}</a>
                </td>
            </tr>
        @endfor
        </tbody>
    </table>
@endsection
