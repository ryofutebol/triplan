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

	public function add(CartRequest $request)
	{
		$result = (new Cart)->add($request);
		return $result;
	}

}
