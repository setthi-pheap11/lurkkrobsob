@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
       
        <div class="row mb-3">
            <div class="col-sm-12">
                <a href="{{route('category.index')}}" class="btn btn-primary">Back</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h3>Edit category</h3>
                @if(session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{session()->get('error')}}
                </div>
                @endif
                <form action="{{route('category.update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$category->id}}">
                    <div class="form-group">
                        <label for="">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{$category->name}}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="active">Status <span class="text-danger">*</span></label>
                        <select name="active" id="active" class="form-control">
                            <option value="1" @if($category->active) selected @endif>Active</option>
                            <option value="0"  @if(!$category->active) selected @endif>Deleted</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection