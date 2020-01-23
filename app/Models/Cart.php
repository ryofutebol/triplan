<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

}
