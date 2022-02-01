<?php
class Notes extends model {
	// Если нужно переназначить имя таблицы
	protected $table = 'notes';
	
	public function listAll() {
		return self::select(
			'id',
			'text',
			'date'
			)->get();
	}

	public function getNote($id) {
		return self::select(
			'id',
			'text',
			'date'
			)->find($id)->first();
	}

	public function edit($id, $params) {
		$text = $params['text'] ?? '';
		return self::find($id)->update([
			'text' => $text
		]);
	}

	public function add($params) {
		$text = $params['text'] ?? '';
		$note = new self;
		$note->text = $text;
		
		return $note->save();
	}
}