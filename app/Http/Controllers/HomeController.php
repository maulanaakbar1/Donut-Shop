<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Donut;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        $donuts = Donut::with('category')
            ->where('is_active', true)
            ->where('stock', '>', 0)
            ->latest()
            ->get();

        return view('home', compact('categories', 'donuts'));
    }
}