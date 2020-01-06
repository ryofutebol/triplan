@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
				<h1>商品の一覧</h1>
				<table border=1>
				<tr>
					<th>商品名</th>
					<th>値段</th>
					<th>在庫の有無</th>
				</tr>
				@foreach ($items as $item)
				<tr>
					<td>
					<a href="{{ route('item.detail', ['id' => $item->id]) }}">
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

