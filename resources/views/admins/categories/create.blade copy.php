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
                <h3>Create new category</h3>
                @if(session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{session()->get('error')}}
                </div>
                @endif
                <form action="{{route('category.save')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection