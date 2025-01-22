@extends('layouts.webs.master')
@section('content')
    <div class="row mt-3">
        <div class="col-sm-12">
            <h3 class="text-danger bg-secondary p-1 rounded">
                {{$name}}
            </h3>
        </div>
    </div>
    <!-- all article  -->
    @if(count($articles))
    <div class="row mt-3">
        @foreach($articles as $art)
        <div class="col-sm-3 mb-3">
            <div class="card" style="w-100">
                <img src="{{asset($art->thumbnail)}}" class="card-img-top" alt="Article Thumbnail">
                <div class="card-body">
                    <h5 class="card-title">{{$art->title}}</h5>
                    <p class="card-text">{{$art->short_description}}</p>
                    <a href="{{route('article_detail', $art->id)}}" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-sm-12">
            {{$articles->links()}}
        </div>
    </div>
    @else 
    <div class="row">
        <div class="col">
            <h5 class="text-danger text-center">There is no record...</h5>
        </div>
    </div>
    @endif
@endsection