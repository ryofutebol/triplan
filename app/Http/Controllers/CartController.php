<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Cart;
use DB;

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
		$user_id = Auth::id();//ログインユーザーID
		$item_id = $request->item_id;//追加されたitemのID
		$count = $request->count;//追加されたitemの個数
		$stock = Item::where('id', $item_id)->select('stock')->first();//追加されたitemの在庫数
		$price = Item::where('id', $item_id)->select('price')->first();//追加されたitemの価格
		$subtotal = $price->price * $count;//小計
		$stock = $stock->stock;
		$valdatedData = $request->validate([
			'count' => "integer|min:1|max:{$stock}",
		], [
			'count.max' => '在庫数以上は選択できません',
		]);

			$item = Cart::firstOrCreate([
				'user_id' => $user_id,
				'item_id' => $item_id
			], [
				'count' => $count,
				'subtotal' => $subtotal
			]);
		DB::transaction(function () use ($request, $item, $subtotal) {
			//追加された個数を在庫数から減少
			Item::where('id', $request->item_id)->decrement('stock', $request->count);
			if ($item->wasRecentlyCreated == false) {//レコードが作成されたかのチェック
				$item->increment('count', $request->count);
				$item->increment('subtotal', $subtotal);
			}
		});

		//if ($item) {
		//	$item_count = $item->increment('count', $count);
		//	$item_subtotal = $item->increment('subtotal', $subtotal);
		//}
		//if ($carts) {
		//	//追加されたcountを増やす
		//	$item_count = Cart::where('user_id', $user_id)
		//		->where('item_id', $item_id)
		//		->increment('count', $request->count);
		//	//追加されたsubtotalを増やす
		//	$upd_subtotal = Cart::where('user_id', $user_id)
		//		->where('item_id', $item_id)
		//		->increment('subtotal', $subtotal);
		//	//追加されたcountをItemテーブルのstockから減らす
		//	$stock = Item::where('id', $item_id)->decrement('stock', $request->count);
		//} else {
		//	$item = Cart::create(compact('user_id', 'item_id', 'count', 'subtotal'));
		//}
		return redirect(route('cart.index'))->with('s_message', '商品をカートに追加しました');

	}

}
