@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				{{-- フラッシュメッセージの表示 --}}
				@if (session('message'))
					<div class="alert alert-success">{{ session('message') }}</div>
				@endif
				<h2 class="panel-headin text-center">プラン詳細</h2>
				<div class="panel panel-info">
					<div class="panel-heading">
						<h4>{{ $item->plan_name }}</h4>
					</div>
					<div class="panel-body">
						<h5>{{ $item->prefecture }}</h5>
						<h4>プランナー名：{{ $item->planner }}</h4>
						<p>{{ $item->comment }}</p>
						<h4>在住歴：{{ $item->residence_history }}年</h4>
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
						<input type="hidden" name="id" value="{{ $item->id }}">
						<div>
						<a href="{{ route('admin.edit', $item->id) }}"><button class="btn btn-primary">編集</button></a>
						{{-- item/edit/{id}を指定 --}}
						</div>
					</div>
				</div>
				<div>
				<a href="{{ route('admin.home') }}">一覧に戻る</a>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
