<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
	public function __construct()
	{
		$this->middleware('auth:admin');
	}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	public function index()
	{
		$items = Item::get();
		return view('admin.home', compact('items'));
	}

	public function detail($id)
	{
		$item = Item::findOrFail($id);
		//該当するレコードが見つからない場合にエラー
		return view('admin.detail', compact('item'));
	}

	public function add()
	//商品追加フォーム表示
	{
		return view('admin.add');
	}

	public function create(Request $request)
	//formを受け取った後の処理 DB保存
	{
		$name = $request->name;
		$description = $request->description;
		$price = $request->price;
		$stock = $request->stock;
		$validatedData = $request->validate([
			'name' => 'required',
			'description' => 'required',
			'price' => 'required|numeric|min:0',//数値が0以上である
			'stock' => 'required|numeric|min:0',//数値が0以上である
		]);
		$item = Item::create(compact('name', 'description', 'price', 'stock'));//インスタンスの作成→属性の代入→データの保を一気に行う
		return redirect(route('admin.home'))->with('message', '商品を追加しました。');
	}

	public function edit($id)
	//編集フォーム表示
	{
		$item = Item::findOrFail($id);//入力フォームに現在のデータを表示するために取得
		return view('admin.edit', compact('item'));
	}

	public function update(Request $request, $id)//パラメータからid取得
	//情報編集したものをDB保存
	{
		$validatedData = $request->validate([
			'name' => 'required',
			'description' => 'required',
			'stock' => 'required|numeric|min:0',//数値が0以上である
		]);
		$item = Item::findOrFail($id);
		$item->fill(['name' => $request->name]);
		$item->fill(['description' => $request->description]);
		$item->fill(['stock' => $request->stock]);
		$item->save();

		$detail_route = route('admin.detail', ['id' => $id]);//編集した商品のrouteを取得
		return redirect($detail_route)->with('message', '商品情報を編集しました。');
	}
}

