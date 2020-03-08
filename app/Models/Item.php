<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
	//データ挿入を許可するカラムを指定
	protected $fillable = ['plan_name', 'prefecture', 'planner', 'comment', 'residence_history', 'stock', 'price'];

	//使用するテーブルを指定
	protected $table = 'items';

	public function carts()
	{
		return $this->belongsTo('App\Models\Cart');
	}

}
