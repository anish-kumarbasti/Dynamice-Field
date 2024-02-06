@extends('admin.layout.master')
@section('content')
    <div class="alert alert-success mt-3" id="message" style="display: none">
        Product Added to your card !
    </div>
    <div class="card-header">
        <h4>Add Items</h4>
    </div>

    <div class="card">
        <div class="row">
            @foreach ($shop as $shops)
                <div class="col-md-3">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset($shops->image) }}" alt="Card image cap" height="100px"
                            width="120px">
                        <div class="card-body">
                            <h5 class="card-title">{{ $shops->product_name ?? 'N/A' }}</h5>
                            <p class="card-text">₹ {{ $shops->final_price ?? 'N/A' }}</p>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary add_to_card" data-product-id="{{ $shops->id }}">Add to
                                Cart</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('.add_to_card').click(function(e) {
            e.preventDefault();
            var productId = $(this).data('product-id');
            var userId = "{{ Auth::user()->id }}";
            // var fprice = "{{ $shops->final_price ?? 'N/A' }}";
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            // console.log("Product Id" + productId + userId + fprice);

            $.ajax({
                type: "post",
                url: '/add/to/card',
                data: {
                    product_id: productId,
                    user_id: userId,
                    // fprice: fprice,
                    _token: csrfToken
                },
                success: function(response) {
                    console.log(response);
                    showClosemessage();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        function showClosemessage() {
            $('#message').show();

            setTimeout(function() {
                $('#message').hide();
            }, 2000);

        }
    });
</script>
