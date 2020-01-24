<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Cart;

class CartController extends Controller
{
	//CartControllerを経由して行われる処理はすべて認証によるアクセスの制限が行われる
	public function __construct()
	{
		$this->middleware('auth:user');
	}

	public function cart()
	{
		//ログインユーザーのid取得
		$id = Auth::id();
		//deleted_atがNULLの場合のみ取得
		$carts = Cart::where('user_id', $id)
			->whereNull('deleted_at')
			->get();

		//ユーザーがカートに入れている個数取得
		$count = Cart::where('user_id', $id)
			->whereNull('deleted_at')
			->count();

		//subtotalの合計
		$total = Cart::where('user_id', $id)
			->whereNull('deleted_at')
			->sum('subtotal');
		return view('cart.index',  compact('carts', 'count', 'total'));
	}

	public function delete(Request $request)
	{
		//渡されたidを取得して対象レコードをソフトデリート
		$delete = Cart::find($request->id);
		$delete->delete();
		return redirect()->route('cart.index')->with('d_message', '商品をカートから削除しました');
	}

	public function add(Request $request)
	{
		$user_id = Auth::id();
		$item_id = $request->item_id;
		$count = $request->count;
		$stock = Item::where('id', $item_id)->select('stock')->first();
		$price = Item::where('id', $item_id)->select('price')->first();
		$subtotal = $price->price * $count;
		$carts = Cart::where('user_id', $user_id)
			->where('item_id', $item_id)
			->whereNull('deleted_at')
			->first();

		if ($carts) {
			//追加されたcountを増やす
			$item_count = Cart::where('user_id', $user_id)
				->where('item_id', $item_id)
				->increment('count', $request->count);
			//追加されたsubtotalを増やす
			$upd_subtotal = Cart::where('user_id', $user_id)
				->where('item_id', $item_id)
				->increment('subtotal', $subtotal);
			//追加されたcountをItemテーブルのstockから減らす
			$stock = Item::where('id', $item_id)->decrement('stock', $request->count);
		} else {
			$item = Cart::create(compact('user_id', 'item_id', 'count', 'subtotal'));
		}
		return redirect(route('cart.index'))->with('s_message', '商品をカートに追加しました');

	}

}
