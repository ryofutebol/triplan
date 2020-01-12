@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
				<h1>カート一覧</h1>
				@if ($count)
					@foreach ($carts as $cart)
					<div class="panel panel-default">
						<h4>{{ $cart->item->name }}</h4>
						<p>数量：{{ $cart->count }}</p>
						<p>価格：{{ number_format($cart->item->price * $cart->count) }}円</p>
						<input type="submit" value="削除">
					</div>
					@endforeach
					<h3>合計金額：{{ $count }} 円</h3>
				@else
					<h2>カートが空です</h2>
				@endif
				<div>
				<a href="{{ route('item.index') }}">一覧に戻る</a>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
