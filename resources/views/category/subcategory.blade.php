
@extends('admin.layout.master')

@section('content')
@if (session('success'))
    <div id="message-success" class="alert alert-success inverse alert-dismissible fade show" role="alert"><i
        class="icon-thumb-up alert-center"></i>
    <p>{{ session('success') }}</p>
    </div>
@endif
<div class="container-fluid">
    <form method="post" action="{{url('category/manage')}}">
    <div class="row">
                @csrf
                <div class="col-sm-6">
                    <div class="non">
                    <label for="name"> Select Category</label>
                    <select class="form-select form-control" id="" name="category_id" required>
                        <option value="" disabled selected>Select Category</option>
                        @foreach ($categorie as $categorys)
                            <option value="{{ $categorys->id }}">{{ $categorys->name }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="non">
                        <label for="sub-category">Sub-Category Name</label>
                        <input type="text" name="name" class="form-control " placeholder="Enter Sub-Category">
                        <br>
                        <button type="submit" class="btn btn-primary float-none float-sm-right d-block mt-3 mt-sm-0 text-center">Save</button>
                    </div>
                </div>
            </div>
        </form>
        
        
  
  @isset($categories)   
  <div class="row">
    <div class="col-md-12">
    <div class="card-body">
        <div class="table-responsive theme-scrollbar">
            <table class="display" id="basic-1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Sub-Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $asset)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <th>{{$asset->category->name??''}}</th>
                            <td>{{ $asset->name ??''}}</td>
                            <td>
                                <form action="{{route('sub.category.delete',$asset->id)}}" method="Post">
                                    @csrf
                                    @method('delete')
                                <a href="{{ route('sub.category.edit', $asset->id) }}" class="btn btn-primary"><i
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

@endisset

</div>  
@endsection









