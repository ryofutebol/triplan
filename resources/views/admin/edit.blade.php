@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
				<h1>商品編集</h1>
				<div>
				<a href="{{ route('admin.home') }}">一覧に戻る</a>
				</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
