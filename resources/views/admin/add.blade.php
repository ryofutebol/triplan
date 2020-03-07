@extends('layouts.admin')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<h2>商品追加</h2>
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
				<form method="post" action="{{ route('admin.home') }}">
					{{ csrf_field() }} {{-- CSRFトークンを記述 --}}
					<div class="form-group">
						<label>プラン名</label>
						<input type="text" name="plan_name" class="form-control">
					</div>
					<div class="form-group">
						<label>県名</label>
						<input type="text" name="prefecture" class="form-control">
					</div>
					<div class="form-group">
						<label>プランナー</label>
						<input type="text" name="planner" class="form-control">
					</div>
					<div class="form-group">
						<label>コメント</label>
						<textarea name="comment" rows="3" cols="50" class="form-control"></textarea>
					</div>
					<div class="form-group">
						<label>在住歴</label>
						<input type="number" name="residence_history" class="form-control">
					</div>
					<div class="form-group">
						<label>在庫数</label>
						<input type="number" name="stock" class="form-control">
					</div>
					<div class="form-group">
						<label>料金</label>
						<input type="number" name="price" class="form-control">
						円
					</div>
					<button type="submit" class="btn btn-primary">登録</button>
				</form>
				<a href="{{ route('admin.home') }}">一覧に戻る</a>
			</<button>
		 </div>
	</div>
</div>
@endsection
