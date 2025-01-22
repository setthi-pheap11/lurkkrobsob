@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
       
        <div class="row mb-3">
            <div class="col-sm-12">
                <a href="{{route('article.index')}}" class="btn btn-primary"> <i class="fa fa-arrow-left"></i> Back</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h3>Create new article</h3>
                @if(session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{session()->get('error')}}
                </div>
                @endif
                <form action="{{route('article.save')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category <span class="text-danger">*</span></label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            <option value="">Select a category</option>
                            @foreach($categories as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="short_description">Short Description <span class="text-danger">*</span></label>
                        <textarea name="short_description" id="short_description" rows="2" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Long Description <span class="text-danger">*</span></label>
                        <textarea name="description" id="description" rows="10" class="form-control" required></textarea>
                    </div>
                    

                    <div class="form-group">
                        <label for="thumbnail">Thumbnail <span class="text-danger">*</span></label>
                        <input type="file" name="thumbnail" id="thumbnail" class="form-control" required>
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

@section('custom-js')
    <script>
        $(document).ready(function() {
            $('#description').summernote();
        });
    </script>
@endsection