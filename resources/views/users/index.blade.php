@extends('layouts.app')


@section('content')
    <div id="success-message" >
        {{ session('success') }}
    </div>
    <h3 style="text-align: center" >All Users</h3>

    <center><a href="{{ route('users.create') }}" class="btn btn-primary mb-2">Add User</a></center>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>S.NO</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach ($user->roles as $role)
                            {{ $role->name }} {{ !$loop->last ? ', ' : '' }}
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-dark">View</a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST", class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-5" >
                        {{-- {{$data->links()}} --}}
                        {{$users->links('pagination::bootstrap-5')}}
        </div>

@endsection()
