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

    //商品詳細用
    /*
    public function item(string $id)
    {
        //itemを検索
        //$item = Item::find($id);
        //compactの意味
        return view('item', compact('item'));
    }
    */


    //パラメータ取得
    public function store(Request $request)
    {
        $parameters = $request->only([
            'name',
            'price',
            'description',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('public/img');
            $filename = basename($path);
            $parameters['image'] = 'img/' . $filename;
        }

        // Item::create($parameters);

        return redirect('/');
    }
}

