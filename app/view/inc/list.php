
<div class="listNotes">
	@if($list->count())
	<ul class="listMessage">
		@foreach($list as $item)
		<li id="note_{{$item->id}}">
			<div class="blockBox">
				<div class="blockMessage">
					<div>
						<a href="{{route('get', [$item->id])}}" class="blockMessageName showNote">{{app('mainClass')->cuteText($item->text, 40)}}</a>
						<span class="blockMessageDate">{{app('mainClass')->showDate($item->date)}}</span>
					</div>
					<div>
						<a href="{{route('delete', [$item->id])}}" class="blockMessageDelete deleteNote"></a>
					</div>
				</div>
			</div>
		</li>
		@endforeach
	</ul>
	@else
	<div class="listEmpty">Тут пока пусто</div>
	@endif
</div>
