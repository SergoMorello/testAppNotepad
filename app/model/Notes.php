<?php
class Notes extends model {
	// Если нужно переназначить имя таблицы
	protected $table = 'notes';
	
	public function listAll() {
		return self::select(
			'id',
			'text',
			'date'
			)->orderBy('id','DESC')->get();
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
			'text' => $text,
			'date' => DB::raw('NOW()')
		]);
	}

	public function add($params) {
		$text = $params['text'] ?? '';
		$note = new self;
		$note->text = $text;
		$note->date = DB::raw('NOW()');
		
		return $note->save();
	}

	public function remove($id) {
		return self::find($id)->delete();
	}
}