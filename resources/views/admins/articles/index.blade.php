@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
       
        <div class="row mb-3">
            <div class="col-sm-12">
                <a href="{{route('article.create')}}" class="btn btn-primary"> <i class="fa fa-plus-circle"></i> Create</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h3>List of articles</h3>
                @if(session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{session()->get('success')}}
                </div>
                @endif

                <form class="row" method="get">
                    <div class="col-sm-3 form-group">
                        <label for="">Category</label>
                        <select name="category_id" class="form-control">
                            <option value="">----</option>
                            @foreach($categories as $categ)
                            <option value="{{$categ->id}}">{{$categ->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="">Keyword</label>
                        <input type="text" name="keyword" class="form-control" placeholder="Search by title, category name, creator name, description...">
                    </div>
                    <div class="col-sm form-group">
                        <label for=""><br><br></label>
                        <button class="btn btn-primary mt-4"><i class="fa fa-search"></i> Search</button>
                    </div>
                </form>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>Thumbnail</td>
                            <td>Title</td>
                            <!-- <td>Short Description</td> -->
                            <td>Category</td>
                            <td>Published Date</td>
                            <td>Created By</td>
                            <td>Status</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($articles as $k => $article)
                        <tr>
                            <td>
                            {{ $articles->firstItem() + $k }}
                            </td>

                            <td>
                                <img src="{{asset($article->thumbnail)}}" alt="Thumbnail" width="50">
                            </td>
                            <td>{{$article->title}}</td>
                            <!-- <td>{{$article->short_descrtiption}}</td> -->
                            <td>{{$article->category_name}}</td>
                            <td>{{$article->publish_date}}</td>
                            <td>{{$article->creator}}</td>
                            <td>
                                @if($article->active)
                                <span class="badge badge-success">Active</span>
                                @else
                                <span class="badge badge-danger">Deleted</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('article.edit', $article->id)}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                <a href="{{route('article.delete', $article->id)}}" onclick="return confirm('Are you OK?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-sm-12">
                        {{$articles->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection