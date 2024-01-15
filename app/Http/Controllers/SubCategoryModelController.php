<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use Illuminate\Http\Request;

class SubCategoryModelController extends Controller
{
    public function index()
    {
        $categories = SubCategoryModel::with('category')->get();
        $categorie = CategoryModel::all();
        // dd($categories);
        return view('category.subcategory', compact('categories', 'categorie'));
    }
    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required'
        ]);
        $asset = new SubCategoryModel();
        $asset->name = $request->name;
        $asset->category_id = $request->category_id;
        $asset->save();

        session()->flash('success', 'Data has been successfully stored.');
        return redirect()->back();
    }
    public function edit($id)
    {
        $subcategories = SubCategoryModel::findOrFail($id);
        $category = CategoryModel::all();
        return view('category.sub_categor_edit', compact('subcategories', 'category'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required'
        ]);

        $category = SubCategoryModel::findOrFail($id);
        $category->name = $request->name;
        $category->category_id = $request->category_id;
        $category->save();
        return redirect()->route('sub.category.manage')->with('success', 'SubCategory updated successfully!');
    }

    public function destroy($id)
    {
        $category = SubCategoryModel::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success', 'SubCategory deleted successfully!');
    }
}
