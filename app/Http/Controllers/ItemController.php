<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Item;
use App\Models\Cart;
use App\User;

class ItemController extends Controller
{
	public function index()
	{
		$items = Item::get();
		return view('item.index', compact('items'));
	}

	public function detail($id)
	{
		$item = Item::findOrFail($id);
		return view('item.detail', compact('item'));
	}

}
