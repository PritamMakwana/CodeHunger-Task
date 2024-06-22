<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::with('category')->orderBy('id', 'desc')->paginate(5);
        $categories = Category::all();
        return view('products.index', compact('products', 'categories'));
    }

    public function ajaxProducts()
    {
        $products = Products::with('category')->orderBy('id', 'desc')->paginate(5);
        return view('products.partials.table', compact('products'))->render();
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
            'name' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {

            $products = Products::where('id', $id)->first();

            if ($products) {
                $products->name = $request->input('name');
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
