{{-- <h1>hi</h1> --}}
@extends('Layouts.app')
@section('content')
<h3>Edit user</h3>

<form action="{{route('users.update', $user->id)}}" method="POST">
@csrf
@method('PUT')
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" value="{{$user->name}}" name="name"  class="form-control" />
    @error('name')
        <span class="text-danger" >{{$message}}</span>
    @enderror
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input type="text" value="{{$user->email}}" name="email"  class="form-control" />
    @error('email')
        <span class="text-danger" >{{$message}}</span>
    @enderror
</div>

<div class="form-group">
    <label for="email">Password (leave blank to keep current) </label>
    <input type="password"  name="password"  class="form-control" />
    @error('email')
        <span class="text-danger" >{{$message}}</span>
    @enderror
</div>

<div class="form-group">
    <label for="roles">Roles</label>
    <select name="roles[]" multiple   class="form-control" id="">
        @foreach ($roles as $role )
        <option value="{{ $role->id }}" @if(in_array($role->id, $user->roles->pluck('id')->toArray())) selected @endif>{{$role->name}}</option>
        @endforeach
    </select>
    @error('roles')
        <span class="text-danger" >{{$message}}</span>
    @enderror
</div>
    <button type="submit" class="btn btn-dark">Update User</button>
</form>

@endsection
