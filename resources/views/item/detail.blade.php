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
				@auth('user')
					@if ($item->stock >= 1)
						<a href="{{ route('cart.add', ['item_id' => $item->id]) }}"><button>カートに追加</button></a>
						</form>
					@else
						<strong>在庫なし</strong>
					@endif
				@endauth
				@guest
					<strong>ログインしてください</strong>
				@endguest
				<div>
				<a href="{{ route('item.index') }}">一覧に戻る</a>
				</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
