<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use Illuminate\Http\Request;

class CategoryCntroller extends Controller
{
    public function index()
    {
        $data = CategoryModel::all();
        return view('category.index', compact('data'));
    }
    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $data = CategoryModel::create($request->all());
        return redirect()->back()->with('success', 'Category Created Successfully');
    }

    public function redirect()
    {
        return redirect(route('admin.dashboard'));
    }
    public function admindashbaord()
    {
        $category = CategoryModel::all();
        return view('admin.index', compact('category'));
    }
    public function edit($id)
    {
        $category = CategoryModel::find($id);
        return view('category.index', compact('category'));
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);
        $category = CategoryModel::findOrFail($id);
        $category->update($data);
        return redirect()->back()->with('success', 'Category Update');
    }
    public function destroy($id)
    {
        $category = CategoryModel::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success', 'Category Delete Successfully');
    }
}
