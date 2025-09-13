<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Support\Facades\Storage;

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
        $item = Product::with('seasons')->findOrFail($id);
        $seasons = Season::all();
        return view('item', compact('item', 'seasons'));
    }

    //登録画面表示
    public function register()
    {
        return view('register');
    }

    //商品登録処理
    public function store(Request $request)
    {
        //フォームデータ受け取り
        $parameters = $request->only([
            'name',
            'price',
            'description',
        ]);

        if ($request->hasFile('image')) {
            // アップロードされた元のファイル名を取得
            $originalName = $request->file('image')->getClientOriginalName();
            $filename = $originalName;
            $counter = 1;

            // 指定したディレクトリに同じファイル名が存在するかチェック
            while (Storage::disk('public')->exists('img/' . $filename)) {
                // ファイル名と拡張子を分割
                $extension = pathinfo($originalName, PATHINFO_EXTENSION);
                $baseName = pathinfo($originalName, PATHINFO_FILENAME);

                // "コピー(数字)" を追加してファイル名を再生成
                $filename = "{$baseName}_({$counter}).{$extension}";
                $counter++;
            }
            // `storeAs`メソッドでファイル名を指定して保存
            $path = $request->file('image')->storeAs('img', $filename, 'public');

            //最終的なファイル名
            $filename = basename($path);

            //配列[image]を追加
            $parameters['image'] = $filename;

        }

        //テーブル登録処理
        // `$item`変数に作成したモデルインスタンスを格納
        $item = Product::create($parameters);

        //中間テーブルの更新
        if ($request->has('season')) {
            $item->seasons()->sync($request->input('season'));
        }

        return redirect()->route('products.index')->with('success', '商品が登録されました。');
    }

    //データのupdate
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
        return redirect()->route('products.index')->with('success', 'アイテムが削除されました。');
    }

}

