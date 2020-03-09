@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<h2 class="panel-headin text-center">プラン詳細</h2>
				{{-- エラーメッセージ表示 --}}
				@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
				<div class="panel panel-info">
					<div class="panel-heading">
						<h4>{{ $item->plan_name }}</h4>
					</div>
					<div class="panel-body">
						<h5>{{ $item->prefecture }}</h5>
						<h4>プランナー：{{ $item->planner }}</h4>
						<p>{{ $item->comment }}</p>
						<h4>在住歴：{{ $item->residence_history }}年</h4>
						<h3>価格：¥{{ number_format($item->price) }}</h3>
						@auth('user')
							@if ($item->stock >= 1)
								{{ Form::open(['route' => 'cart.add']) }}
								{{ Form::selectRange('count', 1, $item->stock) }}
								{{ Form::hidden('item_id', $item->id) }}
								<a href="{{ route('cart.add') }}"><button>カートに追加</button></a>
								{{ Form::close() }}
							@else
								<strong>在庫なし</strong>
							@endif
						@endauth
						<input type="hidden" name="id" value="{{ $item->id }}">
						@guest
							<strong>カートに追加するにはログインしてください</strong>
						@endguest
					</div>
				</div>
				<div>
					<a href="{{ route('item.index') }}">一覧に戻る</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
