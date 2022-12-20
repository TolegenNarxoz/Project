@extends('layouts.adm')

@section('title', 'Edit page')

@section('content')

    <form action="{{route('adm.users.update', $user->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label>{{__('messages.user_name')}}</label>
            <input type="text" value="{{$user->name}}" readonly class="form-control">
        </div>

        <div class="form-group mb-3">
            <label>{{__('messages.user_email')}}</label>
            <input type="email" class="form-control" value="{{$user->email}}" cols="20" rows="10" readonly>
        </div >

        <div class="form-group mb-3">
            <select class="form-select" aria-label="Disabled select example" name="role_id">
                <option selected disabled>{{__('messages.user_role')}}</option>
                @foreach($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
            </select>
        </div>

        <div>
            <button type="submit" class="btn btn-primary mb-3">{{__('messages.button_save')}}</button>
        </div>
    </form>
@endsection
