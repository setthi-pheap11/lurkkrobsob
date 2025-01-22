@extends('layouts.webs.master')

@section('slideshow')
    @include('website.slideshow')
@endsection
@section('content')
    <!-- all article  -->
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
@endsection