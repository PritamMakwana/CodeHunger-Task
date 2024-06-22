<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Imports\CategoriesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            Excel::import(new CategoriesImport, $request->file('file')->store('temp'));
            return redirect()->back()->with('success', 'Categories imported successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while importing the file. Please make sure the file is correctly formatted.(only upload xlsx file)(only upload excel file one column');
        }
    }

    public function index()
    {
        return view('categories.index');
    }

    public function fetchCategories()
    {
        $categories = Category::all();
        return response()->json([
            'categories' => $categories,
        ]);
    }

    public function editCategories($id)
    {
        $categories = Category::find($id);
        if ($categories) {
            return response()->json([
                'status' => 200,
                'categories' => $categories,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Category Found.'
            ]);
        }

    }

    public function updateCategories(Request $request, $id)
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
            $categories = Category::find($id);
            if ($categories) {
                $categories->name = $request->input('name');
                $categories->update();
                return response()->json([
                    'status' => 200,
                    'message' => 'Category Updated Successfully.'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No category Found.'
                ]);
            }

        }
    }

    public function deleteCategory($id)
    {
        Products::where('category_name', $id)->delete();

        $categories = Category::find($id);
        if ($categories) {
            $categories->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Category Deleted Successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No category Found.'
            ]);
        }
    }


}
