@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
				<h2>商品追加</h2>
				<form method="post" action="{{ route('admin.home') }}">
					{{ csrf_field() }} {{-- CSRFトークンを記述 --}}
					<div>
						<label>商品名：</label>
						<input type="text" name="name" required>
					</div>
					<div>
						<label>商品説明：</label>
						<textarea name="description" rows="3" cols="50" required></textarea>
					</div>
					<div>
						<label>価格：</label>
						<input type="number" name="price" required>
						円
					</div>
					<div>
						<label>在庫数</label>
						<input type="number" name="stock" required>
					</div>
					<div><input type="submit" value="登録"></div>
				</form>
				<a href="{{ route('admin.home') }}">一覧に戻る</a>
            </div>
        </div>
    </div>
</div>
@endsection
