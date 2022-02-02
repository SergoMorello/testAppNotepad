<div class="blockChild noteForm">
	<form method="POST" action="{{route('submit', [$id ?? 0])}}">
		<div class="blockBox">
			<textarea class="blockMessageText noteText" name='text' placeholder="Текст заметки" required>{{old('text', $text ?? '')}}</textarea>
			<span class="blockMessageDate">{{app('mainClass')->showDate($date ?? null)}}</span>
		</div>
		<div class="blockButtons">
			<a href="{{route('delete', [$id ?? 0])}}" class="button1 deleteNote">Удалить</a>
			<button type="submit" class="button2">Сохранить</button>
		</div>
	</form>
</div>