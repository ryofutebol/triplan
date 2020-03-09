@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<h1 class="text-center">カート一覧</h1>
				{{-- フラッシュメッセージの表示 --}}
				@if (session('s_message'))
					<div class="alert alert-success">{{ session('s_message') }}</div>
				@elseif (session('d_message'))
					<div class="alert alert-danger">{{ session('d_message') }}</div>
				@endif
				@if ($count)
					@foreach ($carts as $cart)
					<div class="panel panel-info">
						<div class="panel-heading">
							<a href="{{ route('item.detail', ['id' => $cart->item->id]) }}">
								<h4>{{ $cart->item->plan_name }}</h4>
							</a>
						</div>
						<div class="panel-body">
							<p>{{ $cart->item->prefecture }}</p>
							<p>プランナー：{{ $cart->item->planner }}</p>
							<p>価格：{{ number_format($cart->subtotal) }}円</p>
							{{-- idを渡し対象レコードを判断 --}}
							<a href="{{ route('cart.delete', ['id' => $cart->id]) }}" class="btn btn-primary mt-2">削除</a>
						</div>
					</div>
					@endforeach
					<h3>合計金額：{{ $total }} 円</h3>
					<button class="btn btn-success"><h4>決済に進む</h4></button>
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
