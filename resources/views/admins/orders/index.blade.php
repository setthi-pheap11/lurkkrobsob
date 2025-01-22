@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
       
        <div class="row mb-3">
            <div class="col-sm-12">
                <a href="{{route('category.create')}}" class="btn btn-primary">Create</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h3>Making Order</h3>
                @if(session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{session()->get('success')}}
                </div>
                @endif
                <form class="row" action="{{route('order.save_cart')}}" method="post">
                    @csrf
                    <div class="col-sm-3 form-group">
                        <label for="product_id">Product</label>
                        <select name="id" id="product_id" class="form-control" required>
                            <option value="">-----</option>
                            @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3 form-group">
                        <label for="quantity">Product</label>
                        <input type="number" mix='1' name="quantity" id="quantity" value='1' class="form-control" required>
                    </div>
                    <div class="col-sm-2 form-group">
                        <label><br><br></label>
                        <button class="btn btn-primary mt-4">Add to Cart</button>
                    </div>
                    <div class="col-sm-2 form-group">
                        <label><br><br></label>
                        <a href="{{route('order.clear_all')}}" class="btn btn-danger mt-4">Clear All Cart</a>
                    </div>
                </form>   
                <div class="row">
                    <div class="col-sm">
                        <form action="{{route('order.save')}}" method="post">
                            @csrf
                            <table class="table table-bordered">
                                <tr>
                                    <th>No.</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Quanity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                                @php 
                                    $sub_total = 0;
                                @endphp
                                @foreach($cartItems as $k => $cart)
                                @php 
                                    $sub_total += $cart->price * $cart->quantity;
                                @endphp
                                <input type="hidden" name="id[]" value="{{$cart->id}}">
                                <input type="hidden" name="price[]" value="{{$cart->price}}">
                                <input type="hidden" name="quantity[]" value="{{$cart->quantity}}">
                                <input type="hidden" name="total[]" value="{{$cart->price * $cart->quantity}}">
                                <tr>
                                    <td>{{$k+1}}</td>
                                    <td>
                                        <img src="{{asset($cart->attributes->image)}}" alt="" width="50px" height="50px">
                                    </td>
                                    <td>{{$cart->name}}</td>
                                    <td>{{$cart->quantity}}</td>
                                    <td>{{$cart->price}}</td>
                                    <td>{{$cart->price * $cart->quantity}}</td>
                                    <td>
                                        <a href="{{route('order.remove', $cart->id)}}" class="btn btn-danger"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5" class="text-right"><strong>Sub Total:</strong></td>
                                    <td>${{number_format($sub_total, 2)}}</td>
                                    <td>
                                        <button class="btn btn-primary">Save Order</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>            
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom-js')
@if(session()->has('print_url'))

<script>
    var url = "{{session()->get('print_url')}}";
    window.open(url, '_blank')
</script>
@endif
@endsection