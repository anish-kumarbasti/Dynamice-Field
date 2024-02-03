@extends('admin.layout.master')
@section('content')
<div class="container mt-3">
    <h4>Cart Summary</h4>
    <p id="cartCount">Items in Cart: 0</p>
    <p id="cartTotal">Total: ₹ 0</p>
</div>
    <div class="card-header">
        <h4>Add Items</h4>
    </div>

    <div class="card">
        <div class="row">
            @foreach ($shop as $shops)
                <div class="col-md-3">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset($shops->image) }}" alt="Card image cap" height="100px" width="120px">
                        <div class="card-body">
                            <h5 class="card-title">{{$shops->product_name??'N/A'}}</h5>
                            <p class="card-text">₹ {{$shops->final_price??'N/A'}}</p>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" onclick="addToCart('{{$shops->product_name}}', '{{$shops->final_price}}')">Add to Cart</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

<script>
    let cartCount = 0;
    let cartTotal = 0;

    function addToCart(productName, price) {
        cartCount++;
        cartTotal += parseFloat(price);

        document.getElementById('cartCount').innerText = `Items in Cart: ${cartCount}`;
        document.getElementById('cartTotal').innerText = `Total: ₹ ${cartTotal.toFixed(2)}`;
    }
</script>