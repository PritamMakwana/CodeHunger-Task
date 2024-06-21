<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $Category = Category::count();
        return view('dashboard',compact('Category'));
    }
}
