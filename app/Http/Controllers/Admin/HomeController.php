<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;

class HomeController extends Controller
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
    {
        return view('admin.add');
    }

    public function edit()
    {
        return view('admin.edit');
    }
}

