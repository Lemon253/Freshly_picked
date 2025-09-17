<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ItemRequest;


class ItemController extends Controller
{
    //
    public function index()
    {

        // 検索フォームのセッションをリセット
        session()->forget('searches');

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
        $seasons = Season::all(); // 全ての季節データを取得
        return view('register' , compact('seasons'));
    }

    //商品登録処理
    public function store(ItemRequest $request)
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
            $item->seasons()->sync($request->input('seasons', []));

        return redirect()->route('products.index')->with('success', '商品が登録されました。');
    }

    //データのupdate
    public function update(ItemRequest $request, $id)
    {
        $item = Product::findOrFail($id);
        // 更新するデータを一つの配列にまとめる
        $updateData = $request->only(['name', 'price', 'description']);

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
            $updateData['image'] = $filename;

        }

        // データベースを一度だけ更新
        $item->update($updateData);

        // 季節の紐付けを更新
        $item->seasons()->sync($request->input('seasons', []));

        return redirect()->route('item', $id)->with('success', '商品を更新しました');
    }

    public function search(Request $request)
    {
        // 検索クエリが存在する場合のみセッションに保存
        if ($request->has('search')) {
            session(['searches.search' => $request->input('search')]);
        }

        // 並べ替え順が存在する場合のみセッションに保存
        if ($request->has('sort')) {
            session(['searches.sort' => $request->input('sort')]);
        }

        // クエリビルダを開始
        $products = Product::query();

        // 検索キーワードで絞り込み
        if ($request->has('search') && $request->input('search') != '') {
            $products->where('name', 'like', '%' . $request->input('search') . '%');
        }

        // 価格順で並べ替え
        if ($request->has('sort')) {
            if ($request->input('sort') === 'asc' || $request->input('sort') === 'desc') {
                $products->orderBy('price', $request->input('sort'));
            }
        }

        //ページネーションの設定
        $perPage = 6; // 例: 1件表示
        $products = $products->paginate($perPage);
        // ページネーションリンクに検索条件を引き継ぐ
        $products->appends($request->except('page'));

        return view('index', compact('products'));
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

