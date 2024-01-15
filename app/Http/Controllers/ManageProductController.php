<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\ManageProduct;
use App\Models\SubCategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ManageProductController extends Controller
{
    public function index()
    {
        $category = CategoryModel::all();
        return view('admin.index', compact('category'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'product_name' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'final_price' => 'required',

        ]);

        $categoryIds = $request->input('category_id');
        $subCategoryIds = $request->input('sub_category_id');
        $productNames = $request->input('product_name');
        $prices = $request->input('price');
        $discounts = $request->input('discount');
        $finalPrices = $request->input('final_price');
        $images = $request->file('image');

        foreach ($categoryIds as $index => $categoryId) {
            $image = $images[$index];
            $imagess = date('YmdHis') . random_int(1, 10000) . "." . $image->getClientOriginalExtension();
            $destinationPath = 'images';
            $image->move($destinationPath, $imagess);
            $pathcover = $destinationPath . '/' . $imagess;

            ManageProduct::create([
                'category_id' => $categoryId,
                'sub_category_id' => $subCategoryIds[$index],
                'product_name' => $productNames[$index],
                'price' => $prices[$index],
                'discount' => $discounts[$index],
                'final_price' => $finalPrices[$index],
                'image' => $pathcover,
            ]);
        }

        return redirect()->back()->with('success', 'Product(s) added successfully');
    }


    public function category($categoryId)
    {
        $subCategories = SubCategoryModel::where('category_id', $categoryId)->get();
        return response()->json($subCategories);
    }
    public function show()
    {
        $allproduct = ManageProduct::all();
        return view('admin.manageProduct.all_product', compact('allproduct'));
    }
    public function edit($id)
    {
        $categories = CategoryModel::all();
        $subCategories = SubCategoryModel::all();
        $product = ManageProduct::find($id);
        return view('admin.manageProduct.edit', compact('product', 'categories', 'subCategories'));
    }
    public function update(Request $request, $id)
    {
        $product = ManageProduct::find($id);

        $product->category_id = $request->input('category_id');
        $product->sub_category_id = $request->input('sub_category_id');
        $product->product_name = $request->input('product_name');
        $product->price = $request->input('price');
        $product->discount = $request->input('discount');
        $product->final_price = $request->input('final_price');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagess = date('YmdHis') . random_int(1, 10000) . "." . $image->getClientOriginalExtension();
            $destinationPath = 'images';
            $image->move($destinationPath, $imagess);

            if ($product->image && File::exists($product->image)) {
                File::delete($product->image);
            }
            $product->image = $destinationPath . '/' . $imagess;
        }

        $product->save();
        return redirect()->back()->with('success', 'update product successfully');
    }
    public function destroy($id)
    {
        $product = ManageProduct::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('success', 'Product Delete Successfully');
    }
}
