@extends('layouts.webs.master')
@section('meta')
    <meta name="description"
        content="CamboTransportClub.Com is one of the top 10 Car Rental Companies in Cambodia with more than 38 cars and more than 30 employees. It was founded on June 1, 2001 in Phnom Penh, Cambodia. CamboTransportClub.Com not only rents cars at a competitive price but also creates employment and training opportunities for local young students graduated from NGOs, OIs or any private institution and poor students from remote provinces so that they can enjoy internship in the field of tourism." />
    <meta name="keywords"
        content="Car, car rental, car in cambodia, car for sell, car for rent, tourism, tourism in cambodia, cambodia tourism, tour, cambodia tour ">
    <!-- meta content  -->
    <!-- Open Graph data -->
    <meta property="og:title" content="{{$article->title}}" />
    <meta property="og:type" content="Article"/>
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:image" content="{{asset($article->thumbnail)}}" />
    <meta property="og:description" content="{{$article->short_description}}" />
    <meta property="og:site_name" content="Laravel new Webiste" />

@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h3 class="text-primary">{{$article->title}}</h3>
            <p class="text-secondary fs-6">
                <i>Published Date: {{$article->publish_date}}</i>
            </p>
            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}">
                Share to FB
            </a>

            <div>
                {!! $article->description !!}
            </div>
            <img src="{{asset($article->thumbnail)}}" alt="" class="img-fluid">

        </div>
    </div>
@endsection