<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$items = Item::get();
        return view('admin.home', compact('items'));
    }

    public function detail($id)
    {
		$item = Item::findOrFail($id);
        return view('admin.detail', compact('item'));
    }

	public function add()
	//商品追加フォーム表示
    {
        return view('admin.add');
    }

	public function create(Request $request)
	//formを受け取った後の処理 DB保存
	{
		$name = $request->input('name');
		$description = $request->description;
		$price = $request->input('price');
		$stock = $request->input('stock');
		$item = Item::create(compact('name', 'description', 'price', 'stock'));
		return redirect(route('admin.home'))->with('message', '商品を追加しました。');
    }

    public function edit()
    {
        return view('admin.edit');
    }
}

