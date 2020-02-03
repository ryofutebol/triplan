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
}
