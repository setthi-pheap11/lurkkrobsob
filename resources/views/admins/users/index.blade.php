@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
       
        <div class="row mb-3">
            <div class="col-sm-12">
                <a href="{{route('user.create')}}" class="btn btn-primary">Create</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h3>List of users</h3>
                @if(session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{session()->get('success')}}
                </div>
                @endif

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>Photo</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Type</td>
                            <td>Status</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $k => $user)
                        <tr>
                            <td>{{$k+1}}</td>
                            <td>
                                @if($user->photo)
                                <img src="{{asset($user->photo)}}" alt="Profile" width="50px" height="50px" class="rounded-circle">
                                @else
                                <img src="{{asset('assets/dist/img/user2-160x160.jpg')}}" alt="Profile" class="rounded-circle" width="50px">
                                @endif
                            </td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->user_type}}</td>
                            <td>
                                @if($user->active)
                                <span class="badge badge-success">Active</span>
                                @else
                                <span class="badge badge-danger">Deleted</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('user.edit', $user->id)}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                <a href="{{route('user.delete', $user->id)}}" onclick="return confirm('Are you OK?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection