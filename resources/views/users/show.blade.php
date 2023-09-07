{{-- resources/views/users/show.blade.php --}}

@extends('layouts.app') {{-- Make sure to use the correct layout name --}}
@section('content')
<div class="container"> {{-- Wrap the content in a container for centering --}}
    <h3 style="text-align: center" >Show user</h3>

    <div class="row justify-content-center"> {{-- Center the content --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Details</div>
                <div class="card-body">
                    <table class="table table-striped"> {{-- Apply Bootstrap table styles --}}
                        <tr>
                            <th>Name</th>
                            <td>{{$user->name}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$user->email}}</td>
                        </tr>
                        <tr>
                            <th>Roles</th>
                            <td>
                                @foreach ($user->roles as $role)
                                    {{ $role->name }} {{ !$loop->last ? ', ' : '' }}
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
