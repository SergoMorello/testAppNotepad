@extends('lay.html')

@section('content')
	<div class="container">
		<div class="block">
			<div class="blockChild">
				@if($list->count())
				<ul class="listMessage">
					@foreach($list as $item)
					<li>
						<div class="blockBox">
							<div class="blockMessage">
								<div>
									<a href="{{route('get', [$item->id])}}" class="blockMessageName">{{app('mainClass')->cuteText($item->text, 40)}}</a>
									<span class="blockMessageDate">{{app('mainClass')->showDate($item->date)}}</span>
								</div>
								<div>
									<a href="" class="blockMessageDelete"></a>
								</div>
							</div>
						</div>
					</li>
					@endforeach
				</ul>
				@endif
				<div class="blockButtons">
					<a href="" class="button2">Получить список</a>
				</div>
			</div>
		</div>
		<div class="block">
			<form method="POST" action="{{route('submit', [$id ?? 0])}}" class="blockChild">
				<div class="blockBox">
					<textarea class="blockMessageText" name='text' placeholder="Текст заметки">{{old('text', $text ?? '')}}</textarea>
					<span class="blockMessageDate">{{app('mainClass')->showDate($date ?? null)}}</span>
				</div>
				<div class="blockButtons">
					<a href="" class="button1">Удалить</a>
					<button type="submit" class="button2">Сохранить</button>
				</div>
			</form>
		</div>
	</div>
@endsection