<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
	use SoftDeletes;

	  protected $table = 'items';
	  protected $dates = ['deleted_at'];
}
