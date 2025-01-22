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
                <h3>Invoice Detail</h3>
                <div class="row">
                    <div class="col-sm-12">
                        <h2>Logo</h2>
                        <h2>Company Name</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-js')

@endsection