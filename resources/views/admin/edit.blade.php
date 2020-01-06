@extends('layouts.admin')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<h2>商品情報編集</h2>
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
				<form method="post" action="{{ route('admin.edit', $item->id) }}">
				{{-- item/edit/{id}を指定 --}}
					{{ csrf_field() }} {{-- CSRFトークンを記述 --}}
					<div>
						<label>商品名：</label>
						<input type="text" name="name" value="{{ $item->name }}" required>
					</div>
					<div>
						<label>商品説明：</label>
						<textarea name="description" rows="3" cols="50" required>{{ $item->description }}</textarea>
					</div>
					<div>
						<label>在庫数</label>
						<input type="number" name="stock" value="{{ $item->stock }}" required>
					</div>
					<div><input type="submit" value="編集"></div>
				</form>
				<a href="{{ route('admin.home') }}">一覧に戻る</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
