<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
	use SoftDeletes;

	protected $dates = ['deleted_at'];//削除したら自動で日付入る

	protected $fillable = ['user_id', 'item_id', 'count', 'subtotal'];

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function item()
	{
		return $this->belongsTo('App\Models\Item');
	}

	public function getCart()
	{
		$id = Auth::id();
		$carts = Cart::where('user_id', $id)->get();
		return $carts;
	}

	public function findUser($request)
	{
		$cart_user_id = Cart::where('id', $request->id)->first();
		return $cart_user_id;
	}

	public function findItem($request)
	{
		$item_id = $request->item_id;//追加されたitemのID
		$item = Item::where('id', $item_id)->first();
		return $item;
	}

	public function add($request)
	{
		$item = (new Cart)->findItem($request);
		$user_id = Auth::id();//ログインユーザーID
		$count = $request->count;//追加されたitemの個数
		$subtotal = $item->price * $count;//小計
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
