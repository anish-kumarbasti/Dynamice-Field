
@extends('admin.layout.master')

@section('content')
@if (session('success'))
        <div id="alerts" class="alert alert-success inverse alert-dismissible fade show" role="alert"><i
                class="icon-thumb-up alert-center"></i>
            <p>{{ session('success') }}</p>
        </div>
    @endif
<div class="card-header">
    <h4>Add  Items</h4>

</div>

<div id="formsContainer"></div>
    <div class="card-body p-3">
        <form action="{{route('manage.product.save')}}" method="post" enctype="multipart/form-data">
            @csrf
        <div id="show_item">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="category">Select Category:</label>
                    <select id="category" class="form-control" name="category_id[]" required>
                        <option value="" disabled selected>Select Category</option>
                        @foreach ($category as $categorys)
                        <option value="{{ $categorys->id }}">{{ $categorys->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="subcategory">Select Sub-Category:</label>
                    <select id="subcategory" class="form-control" name="sub_category_id[]" required>
                        <option selected> Select Sub-Category </option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="productName">Product Name:</label>
                    <input type="text" id="productName" class="form-control" name="product_name[]" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="productPrice">Product Price:</label>
                    <input type="text" id="productPrice" class="form-control" name="price[]" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="productDiscount">Product Discount:</label>
                    <input type="text" id="productDiscount" class="form-control" name="discount[]" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="finalPrice">Final Price:</label>
                    <input type="text" id="finalPrice" class="form-control" name="final_price[]" required>
                </div>
                <div class="col-md-4">
                    <label for="productImage">Product Image :</label>
                    <input type="file" id="productImage" class="form-control" name="image[]" multiple />
                </div>
                <div class="col-md-2 mb-3 d-grid">
                    <button class="btn btn-success add_item_btn">Add New</button>
                </div>
            </div>
            <div class="mt-2">
               <input type="submit" value="Submit" class="btn btn-primary w-25">
            </div>
        </div>  
    </form>
    </div>
    @endsection
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
<script>
    $(document).ready(function () {
        function updateFinalPriceForRow(row) {
            var productPrice = parseFloat(row.find("#productPrice").val()) || 0;
            var productDiscount = parseFloat(row.find("#productDiscount").val()) || 0;
            var finalPrice = productPrice - (productPrice * productDiscount / 100);
            row.find("#finalPrice").val(finalPrice.toFixed(2));
            // updateTotalFinalPrice();
        }
        // function updateTotalFinalPrice() {
        //     var totalFinalPrice = 0;
        //     $("#finalPrice").each(function () {
        //         totalFinalPrice += parseFloat($(this).val()) || 0;
        //     });
        //     $("#totalFinalPrice").val(totalFinalPrice.toFixed(2));
        // }


        $(".add_item_btn").click(function (e) {
            e.preventDefault();
            var newRow = $(`
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="category">Select Category:</label>
                    <select id="category" class="form-control" name="category_id[]" required>
                        <option value="" disabled selected>Select Category</option>
                        @foreach ($category as $categorys)
                        <option value="{{ $categorys->id }}">{{ $categorys->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="subcategory">Select Sub-Category:</label>
                    <select id="subcategory" class="form-control" name="sub_category_id[]" required>
                        <option selected> Select Sub-Category </option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="productName">Product Name:</label>
                    <input type="text" id="productName" class="form-control" name="product_name[]" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="productPrice">Product Price:</label>
                    <input type="text" id="productPrice" class="form-control" name="price[]" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="productDiscount">Product Discount:</label>
                    <input type="text" id="productDiscount" class="form-control" name="discount[]" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="finalPrice">Final Price:</label>
                    <input type="text" id="finalPrice" class="form-control" name="final_price[]" required>
                </div>
                <div class="col-md-4">
                    <label for="productImage">Product Image :</label>
                    <input type="file" id="productImage" class="form-control" name="image[]" required>
                </div>
                <div class="col-md-2 mb-3 d-grid">
                    <button class="btn btn-danger remove_item_btn">Remove</button>
                </div>
            </div>
            `);
            $("#show_item").prepend(newRow);
        });

        $(document).on('click', '.remove_item_btn', function (e) {
            e.preventDefault();
            let row_item = $(this).closest('.row');
            $(row_item).remove();
            // updateTotalFinalPrice();
        });
        $(document).ready(function () {
            // updateTotalFinalPrice();
        });


        $(document).on("input", "#productPrice, #productDiscount", function () {
            var row = $(this).closest('.row');
            updateFinalPriceForRow(row);
        });

        $(document).on("change", "#category", function () {
            var row = $(this).closest('.row');
            updateFinalPriceForRow(row);

            var categoryId = $(this).val();
            console.log("Selected Category ID: " + categoryId);

            if (categoryId) {
                $.ajax({
                    url: '/get-category/' + categoryId,
                    type: 'GET',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    },
                    
                    success: function (data) {
                        console.log("Received Data: ", data);
                        var subcategoryDropdown = row.find('#subcategory');
                        subcategoryDropdown.empty();
                        subcategoryDropdown.append('<option value="">Select Sub-Category</option>');
                        $.each(data, function (index, item) {
                        subcategoryDropdown.append('<option value="' + item.id + '">' + item.name + '</option>');
                    });
                    }
                });
            }
        });
    });
</script>

    
    

