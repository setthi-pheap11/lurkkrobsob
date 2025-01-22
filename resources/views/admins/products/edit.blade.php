@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
       
        <div class="row mb-3">
            <div class="col-sm-12">
                <a href="{{route('product.index')}}" class="btn btn-primary"> <i class="fa fa-arrow-left"></i> Back</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h3>Edit product</h3>
                @if(session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{session()->get('error')}}
                </div>
                @endif
                <form action="{{route('product.update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <div class="form-group">
                        <label for="">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{$product->name}}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Purchase Price <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="purchase_price" value="{{$product->purchase_price}}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Sell Price <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="sell_price" value="{{$product->sell_price}}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category <span class="text-danger">*</span></label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            <option value="">Select a category</option>
                            @foreach($categories as $cat)
                            <option value="{{$cat->id}}" @if($product->category_id == $cat->id) selected @endif>{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description <span class="text-danger">*</span></label>
                        <textarea name="description" id="description" rows="10" class="form-control" required>{{$product->descrtiption}}</textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="thumbnail">Thumbnail <span class="text-danger"></span></label>
                        <input type="file" name="thumbnail" id="thumbnail" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label for="active">Status <span class="text-danger">*</span></label>
                        <select name="active" id="active" class="form-control" required>
                            <option value="">Select one</option>
                            <option value="1" @if($product->active == 1) selected @endif>Active</option>
                            <option value="0" @if($product->active == 0) selected @endif>Disabled</option>
                        </select>
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