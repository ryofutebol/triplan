@extends('layouts.app')

@section('content')
<div class="container">
	<h1>Triplan</h1>
	<p>
	そこに住む人があなたにあった最高の旅行プランを考えます！
	</p>
</div>
<div class="container">
    <div class="row center-block">
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
								<a href="{{ route('item.detail', ['id' => $item->id]) }}" class="btn btn-primary mt-2">
									More
								</a>
							</div>
						</div>
					</div>
				@endforeach
    </div>
</div>
@endsection

