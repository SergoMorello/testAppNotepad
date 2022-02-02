@extends('lay.html')

@section('content')
	<div class="container">
		<div class="block">
			<div class="blockChild">
				@include('inc.list', ['list' => $list])
				<div class="blockButtons">
					<a href="{{route('home')}}" class="button2 getNotes">Получить список</a>
				</div>
			</div>
		</div>
		<div class="block">
			<div class="blockChild noteForm">
			@include('inc.note', ['id'=>($id ?? 0), 'text' => ($text ?? ''), 'date' => ($date ?? '')])
			</div>
		</div>
	</div>
@endsection