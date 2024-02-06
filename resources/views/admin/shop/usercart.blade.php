@extends('admin.layout.master')
@section('content')
    @isset($usercard)
        <div class="card-body">
            <div class="table-responsive theme-scrollbar">
                <table class="display" id="basic-1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usercard as $products)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $products->product->product_name ?? '' }}</td>
                                <td>{{ $products->total_price ?? '' }}</td>
                                <td>
                                    <img src="{{ asset($products->product->image ?? '') }}" alt="Product Image" width="50"
                                        height="50">
                                </td>

                                <td>
                                    <a class="btn btn-danger" href="{{ url('remove/user/card', $products->id) }}">Remove</a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endisset
@endsection
