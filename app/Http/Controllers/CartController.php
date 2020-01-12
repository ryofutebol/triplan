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

	public function delete()
	{


}
