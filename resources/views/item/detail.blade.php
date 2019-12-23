@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
				<h1>商品詳細</h1>
				<h2>{{ $item->name }}</h2>
				<p>【商品説明】</p>
				<p>{{ $item->description }}</p>
				<h3>価格：¥{{ number_format($item->price) }}</h3>
				<p>在庫の有無：
				<strong>
				@if ($item->stock >= 1)
				有り
				@else
				無し
				@endif
				</strong>
				</p>
				<div>
				<a href="{{ route('item.index') }}">一覧に戻る</a>
				</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
