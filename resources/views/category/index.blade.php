
@extends('admin.layout.master')

@section('content')
@if (session('success'))
        <div id="alerts" class="alert alert-success inverse alert-dismissible fade show" role="alert"><i
                class="icon-thumb-up alert-center"></i>
            <p>{{ session('success') }}</p>
        </div>
    @endif
<div class="container-fluid mt-2">
    <form method="post" action="{{route('manage.category.save')}}">
        <div class="row">
            <div class="col-sm-6">
        @csrf
        <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Category</label>
        <input type="name" name="name" class="form-control" placeholder="Enter Category Name">
        </div>
        <button type="submit" class="btn btn-primary float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Save</button>
    </div>
    </div>
  </form>
  @isset($data)   
  <div class="row">
    <div class="col-md-12">
    <div class="col-md-6">
    <div class="card-body">
        <div class="table-responsive theme-scrollbar">
            <table class="display" id="basic-1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $asset)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $asset->name }}</td>
                            <td>
                                <form action="{{route('category.delete',$asset->id)}}" method="Post">
                                    @csrf
                                    @method('delete')
                                <a href="{{ route('category.edit', $asset->id) }}" class="btn btn-primary"><i
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
</div>
</div>
@endisset
@isset($category)    
<div class="col-md-6 mt-2">
<form class="needs-validation" method="POST" action="{{ route('category.update', $category->id) }}">
    @csrf
    @method('PUT')
<label for="category">Category Name</label>
<input type="text" value="{{$category->name}}" class="form-control" name="name">
<button class="btn btn-warning mt-2">Update</button>
<a href="{{route('manage.category')}}" class="btn btn-info">Back</a>
</form>
</div>
</div>
@endisset

</div>  
@endsection