<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $Category = Category::count();
        $Product = Products::count();
        return view('dashboard', compact('Category', 'Product'));
    }
}
