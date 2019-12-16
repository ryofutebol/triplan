@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品詳細</title>
</head>
<body>
<h1>商品詳細</h1>
<h2>{{ $items->name }}</h2>
<p>【商品説明】</p>
<p>{{ $items->description }}</p>
<h3>価格：¥{{ number_format($items->price) }}</h3>
<p>在庫の有無：
<strong>
@if ($items->stock >= 1)
有り
@else
無し
@endif
</strong>
</p>
<div>
<a href="{{ route('item.index') }}">一覧に戻る</a>
</div>
</body>
</html>
@endsection('content')
