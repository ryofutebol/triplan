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
		$carts = (new Cart)->getCart();
		//ユーザーがカートに入れている個数取得
		$count = $carts->count();
		//合計金額
		$total = $carts->sum('subtotal');
		return view('cart.index', compact('carts', 'count', 'total'));
	}

	public function delete(Request $request)
	{
		$cart_user_id = (new Cart)->findUser($request);
		$user_id = Auth::id();
		//渡されたidを取得して対象レコードをソフトデリート
		$delete = Cart::find($request->id);
		//ログインユーザーとカートユーザーのチェック
		if ($user_id === $cart_user_id->user_id) {
			$delete->delete();
		} else {
			return redirect()->route('cart.index')->with('d_message', 'ユーザーを確認してください');
		}
		return redirect()->route('cart.index')->with('d_message', '商品をカートから削除しました');
	}

	public function add(Request $request)
	{
		$item = (new Cart)->findItem($request);
		$user_id = Auth::id();//ログインユーザーID
		$count = $request->count;//追加されたitemの個数
		$subtotal = $item->price * $count;//小計
		$valdatedData = $request->validate([
			'count' => "integer|min:1|max:{$item->stock}",
		], [
			'count.max' => '在庫数以上は選択できません',
		]);

		$cart_item = Cart::firstOrCreate([
			'user_id' => $user_id,
			'item_id' => $item->id
		], [
			'count' => $count,
			'subtotal' => $subtotal
		]);
		DB::transaction(function () use ($request, $cart_item, $item,  $subtotal) {
			//追加された個数を在庫数から減少
			$item->decrement('stock', $request->count);
			if ($cart_item->wasRecentlyCreated == false) {//レコードが作成されたかのチェック
				$cart_item->increment('count', $request->count);
				$cart_item->increment('subtotal', $subtotal);
			}
		});
		return redirect(route('cart.index'))->with('s_message', '商品をカートに追加しました');
	}

}
