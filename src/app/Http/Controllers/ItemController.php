<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;

class ItemController extends Controller
{
    //
    public function index()
    {
        // 1ページ7件ずつ表示
        $products = Product::with('seasons')->paginate(7);
        return view('index', compact('products'));
    }
}
