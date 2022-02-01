<?php

class MainController extends controller {

	public function __construct() {
		$this->notes = $this->model('Notes');
	}

	public function index() {
		return view('home', [
			'list' => $this->notes->listAll(),
			'date' => date("Y-m-d H:i:s")
		]);
	}

	public function get() {
		$id = request()->route('id');
		$note = $this->notes->getNote($id);
		
		return view('home', [
			'id' => $id,
			'list' => $this->notes->listAll(),
			'text' => $note->text,
			'date' => $note->date
		]);
	}

	public function submit() {
		$text = request()->input('text');
		if (request()->has('id')) {
			$id = request()->route('id');
			$this->notes->edit($id, [
				'text' => $text
			]);
		}else{
			$this->notes->add([
				'text' => $text
			]);
		}

		return redirect()->route('home');
	}
}