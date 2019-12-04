<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ItemController extends Controller
{
	public function index()
	{
		$var = 'Hello World';
		return view('item.index', ['var' => $var]);
		//1つ目の引数にディレクトリとファイル名指定
		//2つ目の引数でビューに$var変数を渡す
	}
}
