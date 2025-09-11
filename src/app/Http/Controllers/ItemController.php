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
        // 1ページ6件ずつ表示
        $products = Product::with('seasons')->paginate(6);
        return view('index', compact('products'));
    }

    //商品詳細用
    public function item(string $id)
    {
        //itemを検索
        //$item = Product::find($id);
        $item = Product::with('seasons')->findOrFail($id);
        $seasons = Season::all();
        return view('item', compact('item', 'seasons'));
    }
    
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

    // コントローラのupdate例
    public function update(Request $request, $id)
    {
        $item = Product::findOrFail($id);
        $item->update($request->only(['name', 'price', 'description', 'image']));

        // 季節の紐付けを更新
        $item->seasons()->sync($request->input('seasons', []));

        return redirect()->route('item', $id)->with('success', '商品を更新しました');
    }
    //データの削除
    public function destroy(string $id)
    {
        // IDに基づいてアイテムを検索し、存在しない場合は404エラーを返す
        $item = Product::findOrFail($id);

        // アイテムをデータベースから削除
        $item->delete();

        // 削除が完了したら、適切なページにリダイレクトする
        return redirect()->route('products')->with('success', 'アイテムが削除されました。');
    }

}

