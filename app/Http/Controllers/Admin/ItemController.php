<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\planRequest;
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

	public function create(planRequest $request)
	//formを受け取った後の処理 DB保存
	{
		$plan_name = $request->plan_name;
		$prefecture = $request->prefecture;
		$planner = $request->planner;
		$comment = $request->comment;
		$residence_history = $request->residence_history;
		$stock = $request->stock;
		$price = $request->price;
		$item = Item::create(compact('plan_name', 'prefecture', 'planner', 'comment', 'residence_history', 'price'));//インスタンスの作成→属性の代入→データの保を一気に行う
		return redirect(route('admin.home'))->with('message', 'プランを追加しました。');
	}

	public function edit($id)
	//編集フォーム表示
	{
		$item = Item::findOrFail($id);//入力フォームに現在のデータを表示するために取得
		return view('admin.edit', compact('item'));
	}

	public function update(planRequest $request, $id)//パラメータからid取得
	//情報編集したものをDB保存
	{
		$item = Item::findOrFail($id);
		$item->fill(['plan_name' => $request->plan_name]);
		$item->fill(['prefecture' => $request->prefecture]);
		$item->fill(['planner' => $request->planner]);
		$item->fill(['comment' => $request->comment]);
		$item->fill(['residence_history' => $request->residence_history]);
		$item->fill(['stock' => $request->stock]);
		$item->fill(['price' => $request->price]);
		$item->save();

		$detail_route = route('admin.detail', ['id' => $id]);//編集した商品のrouteを取得
		return redirect($detail_route)->with('message', 'プラン情報を編集しました。');
	}
}

