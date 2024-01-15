@extends('admin.layout.master')

@section('content')
@if (session('success'))
        <div id="alerts" class="alert alert-success inverse alert-dismissible fade show" role="alert"><i
                class="icon-thumb-up alert-center"></i>
            <p>{{ session('success') }}</p>
        </div>
    @endif
@isset($allproduct)
<div class="card-body">
    <div class="table-responsive theme-scrollbar">
        <table class="display" id="basic-1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Sub-Category Name</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Discount</th>
                    <th>Final Price</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allproduct as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->subcategory->name }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->discount }}%</td>
                        <td>{{ $product->final_price }}</td>
                        <td>
                            <img src="{{ asset($product->image) }}" alt="Product Image" width="50" height="50">
                        </td>
                        
                        <td>
                            <form action="{{route('manage.product.delete',$product->id)}}" method="Post">
                                @csrf
                                @method('delete')
                            <a href="{{ route('manage.product.edit', $product->id) }}" class="btn btn-primary"><i
                                class="fa fa-pencil"></i>&nbsp;Edit</a> 
                        <button class="btn btn-danger" type="submit"><i class="fa fa-trash-o"></i>&nbsp;Delete</button>
                        </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endisset


@endsection