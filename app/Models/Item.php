<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
	//データ挿入を許可するカラムを指定
	protected $fillable = ['name', 'description', 'price',  'stock'];

	protected $table = 'items';
}
