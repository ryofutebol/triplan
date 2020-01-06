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
					<div>
						<label>商品名：</label>
						<input type="text" name="name">
					</div>
					<div>
						<label>商品説明：</label>
						<textarea name="description" rows="3" cols="50"></textarea>
					</div>
					<div>
						<label>価格：</label>
						<input type="number" name="price">
						円
					</div>
					<div>
						<label>在庫数</label>
						<input type="number" name="stock">
					</div>
					<div><input type="submit" value="登録"></div>
				</form>
				<a href="{{ route('admin.home') }}">一覧に戻る</a>
			</div>
		 </div>
	</div>
</div>
@endsection
