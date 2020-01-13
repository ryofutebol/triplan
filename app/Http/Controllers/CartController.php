<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Cart;
use App\User;

class CartController extends Controller
{
	//CartControllerを経由して行われる処理はすべて認証によるアクセスの制限が行われる
	public function __construct()
	{
		$this->middleware('auth:user');
	}

	public function cart()
	{
		$id = Auth::id();
		//ログインユーザーのcartsテーブルのuser_id取得
		//deleted_atがNULLの場合のみ取得
		$carts = Cart::where('user_id', $id)->whereNull('deleted_at')->get();
		//ユーザーがカートに入れている個数取得
		$count = Cart::where('user_id', $id)->count();
		//dd($carts);
		return view('cart.index',  compact('carts', 'count'));
	}

	public function delete(Request $request)
	{
		//渡されたidを取得して対象レコードをソフトデリート
		$delete = Cart::find($request->id);
		$delete->delete();
		return redirect()->route('cart.index');
	}

	public function add(Request $request)
	{
		$user_id = Auth::id();
		$item_id = $request->item_id;
		$count = 1;
		$item = Cart::create(compact('user_id', 'item_id', 'count'));
		return redirect(route('cart.index'))->with('message', '商品をカートに追加しました');

	}

}
