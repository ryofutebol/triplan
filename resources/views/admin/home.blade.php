@extends('layouts.admin')

@section('content')
<div class="container">
	<div class="row center-block">
		<div class="panel-heading">Adimn</div>
		{{-- フラッシュメッセージの表示 --}}
		@if (session('message'))
			<div class="alert alert-success">{{ session('message') }}</div>
		@endif
		<h1>プランの一覧</h1>
		<h3>
			<a href="{{ route('admin.add') }}">プラン追加</a>
		</h3>
		@foreach ($items as $item)
		<div class="col-md-6 com-lg-4">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h4>{{ $item->plan_name }}</h4>
				</div>
				<div class="panel-body">
					<h4 class="panel-title">
						{{ $item->prefecture }}
					</h4>
					<h6 class="panel-subtitle mb-2 text-muted">
						{{ $item->planner }}
					</h6>
					<p class="panel-text">
						{{ $item->comment }}
					</p>
					<h3>
						¥{{ number_format($item->price) }}
					</h3>
					<a href="{{ route('admin.detail', ['id' => $item->id]) }}" class="btn btn-primary mt-2">
						More
					</a>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
@endsection

