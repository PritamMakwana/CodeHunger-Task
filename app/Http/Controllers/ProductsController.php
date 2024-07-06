<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ProductsController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('products.index', compact('categories'));
    }

    public function ajaxProducts()
    {

        $products = Products::with('category')->orderBy('id', 'desc')->get();
        return response()->json([
            'products' => $products,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
            'name' => 'required|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $filename = "";
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->storeAs('public/products', $filename);
        }

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            $products = new Products();
            $products->category_name = $request->input('category_name');
            $products->name = $request->input('name');
            $products->image = $filename;
            $products->save();
            return response()->json([
                'status' => 200,
                'message' => 'Products Added Successfully.'
            ]);
        }
    }

    public function edit($id)
    {
        $products = Products::find($id);

        if ($products) {
            return response()->json([
                'status' => 200,
                'products' => $products,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Product Found.'
            ]);
        }

    }

    public function updateProduct(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'name' => 'required|max:100',
            'image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);



        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {

            $products = Products::where('id', $id)->first();

            if ($products) {

                if ($request->hasFile('image')) {
                    if ($products->image && Storage::exists('public/products/' . $products->image)) {
                        Storage::delete('public/products/' . $products->image);
                    }
                    $file = $request->file('image');
                    $filename = time() . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('public/products', $filename);
                    $products->image = $filename;
                }
                $products->name = $request->input('name');
                $products->category_name = $request->input('category');
                $products->update();

                return response()->json([
                    'status' => 200,
                    'message' => 'Product Updated Successfully.'
                ]);

            } else {

                return response()->json([
                    'status' => 404,
                    'message' => 'No Product Found.'
                ]);
            }

        }
    }


    public function destroy($id)
    {
        $Products = Products::find($id);
        if ($Products) {

            if ($Products->image) {
                Storage::delete('public/products/' . $Products->image);
            }

            $Products->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Product Deleted Successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Product Found.'
            ]);
        }
    }

}
