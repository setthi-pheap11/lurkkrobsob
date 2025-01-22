@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
       
        <div class="row mb-3">
            <div class="col-sm-12">
                <a href="{{route('user.index')}}" class="btn btn-primary">Back</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h3>Edit user</h3>
                @if(session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{session()->get('error')}}
                </div>
                @endif
                <form action="{{route('user.update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <div class="form-group">
                        <label for="">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{$user->name}}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" value="{{$user->email}}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Password <span class="text-danger"></span></label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Status <span class="text-danger"></span></label>
                        <select name="active" id="active" class="form-control">
                            <option value="1" @if($user->active == 1) selected @endif>Active</option>
                            <option value="0" @if($user->active == 0) selected @endif>Deleted</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Photo <span class="text-danger"></span></label>
                        <input type="file" name="photo" class="form-control">
                        <img src="{{asset($user->photo)}}" alt="Profile" width="100px">
                    </div>
                    <button class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection