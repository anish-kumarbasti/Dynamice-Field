@extends('admin.layout.master')

@section('content')

@isset($product)
    <div class="card">
        <div class="card-header">
            <h4>Edit Product</h4>
        </div>
        <div class="card-body p-3>
            <form action="{{ route('manage.product.update',$product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div id="show_item">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="category_id">Category:</label>
                            <select class="form-control" id="category_id" name="category_id">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="subcategory">Select Sub-Category:</label>
                            <select class="form-control" id="sub_category_id" name="sub_category_id">
                                @foreach($subCategories as $subCategory)
                                    <option value="{{ $subCategory->id }}" {{ $subCategory->id == $product->sub_category_id ? 'selected' : '' }}>
                                        {{ $subCategory->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="productName">Product Name:</label>
                            <input type="text" value="{{ $product->product_name }}" class="form-control" name="product_name">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="productPrice">Product Price:</label>
                            <input type="text" value="{{ $product->price }}" class="form-control" name="price">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="productDiscount">Product Discount:</label>
                            <input type="text" value="{{ $product->discount }}" class="form-control" name="discount">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="finalPrice">Final Price:</label>
                            <input type="text" value="{{ $product->final_price }}" class="form-control" name="final_price">
                        </div>

                        <div class="col-md-4">
                            <label for="image">Product Image:</label>
                            <input type="file" class="form-control" id="image" name="image">
                            @if ($product->image)
                                <img src="{{ asset($product->image) }}" alt="Product Image" width="100">
                            @endif
                        </div>
                    </div>

                    <div class="mt-2">
                        <input type="submit" value="Update" class="btn btn-primary w-25">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endisset

@endsection
