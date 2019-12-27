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
		session(['id' => '']);//sessionの初期化
		$items = Item::get();
		return view('admin.home', compact('items'));
	}

	public function detail($id)
	{
		session(['id' => $id]);//getパラメータの{id}をセッションに保存
		$item = Item::findOrFail($id);
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
		$name = $request->input('name');
		$description = $request->description;
		$price = $request->input('price');
		$stock = $request->input('stock');
		$item = Item::create(compact('name', 'description', 'price', 'stock'));
		return redirect(route('admin.home'))->with('message', '商品を追加しました。');
	}

	public function edit()
	//編集フォーム表示
	{
		$id = session('id');//sessionに保存したdetailのidを取得
		$item = Item::findOrFail($id);//入力フォームに現在のデータを表示するために取得
		return view('admin.edit', compact('item'));
	}

	public function update(Request $request)
	//情報編集したものをDB保存
	{
		$id = session('id');
		$item = Item::findOrFail($id);
		$item->fill(['name' => $request->input('name')]);
		$item->fill(['description' => $request->description]);
		$item->fill(['stock' => $request->input('stock')]);
		$item->save();

		$detail_route = route('admin.detail', ['id' => $id]);//編集した商品のrouteを取得
		return redirect($detail_route)->with('message', '商品情報を編集しました。');
	}
}

