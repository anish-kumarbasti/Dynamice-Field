
@extends('admin.layout.master')

@section('content')
<div class="container-fluid">
    <form method="post" action="{{route('sub.category.edit.update',$subcategories->id)}}">
    <div class="row">
                @csrf
                @method('PUT')
                <div class="col-sm-6">
                    <div class="non">
                    <label for="name"> Select Category</label>
                    <select class="form-select form-control" id="" name="category_id" required>
                        <option value="" disabled selected>Select Category</option>
                        @foreach ($category as $categorys)
                            <option value="{{ $categorys->id }}" @if($categorys->id == $subcategories->category_id) selected @endif>{{ $categorys->name ??''}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="non">
                        <label for="sub-category">Sub-Category Name</label>
                        <input type="text" name="name" class="form-control " value="{{$subcategories->name}}">
                        <br>
                        <button type="submit" class="btn btn-info float-none float-sm-right d-block mt-3 mt-sm-0 text-center">Update</button>
                    </div>
                </div>
            </div>
        </form> 
</div>  
@endsection









