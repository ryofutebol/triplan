@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
				<div class="panel-heading">Admin</div>
				{{-- フラッシュメッセージの表示 --}}
				@if (session('message'))
					<div class="alert alert-success">{{ session('message') }}</div>
				@endif
				<h1>商品の一覧</h1>
				<h3>
					<a href="{{ route('admin.add') }}">商品追加</a>
				</h3>
				<table border=1>
				<tr>
					<th>商品名</th>
					<th>値段</th>
					<th>在庫の有無</th>
				</tr>
				@foreach ($items as $item)
				<tr>
					<td>
					<a href="{{ route('admin.detail', ['id' => $item->id]) }}">
						{{ $item->name }}
					</a>
					</td>
					<td>¥{{ number_format($item->price) }}</td>
					<td>
					@if ($item->stock >= 1)
					在庫有り
					@else
					在庫無し
					@endif
					</td>
				</tr>
				@endforeach
				</table>
            </div>
        </div>
    </div>
</div>
@endsection

