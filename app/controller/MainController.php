<?php

class MainController extends controller {

	public function __construct() {
		$this->notes = $this->model('Notes');
	}

	public function index(request $req) {
		if ($req->has('api')) {
			return $this->apiGetList();
		}else{
			return view('home', [
				'list' => $this->notes->listAll(),
				'date' => date("Y-m-d H:i:s")
			]);
		}
	}

	public function get(request $req) {
		$id = $req->route('id');
		$note = $this->notes->getNote($id);
		
		if ($req->has('api')) {
			return [
				'success' => true,
				'content' => view('inc.note', [
					'id' => $id,
					'text' => $note->text,
					'date' => $note->date
				])->getContent()
			];
		}else{
			return view('home', [
				'id' => $id,
				'list' => $this->notes->listAll(),
				'text' => $note->text,
				'date' => $note->date
			]);
		}
		
	}

	public function apiGetList() {
		return [
			'success' => true,
			'content' => view('inc.list', [
				'list' => $this->notes->listAll()
			])->getContent()
		];
	}

	public function submit(request $req) {

		$req->validate([
			'text' => 'required'
		]);

		$text = $req->input('text');

		if ($req->has('id')) {
			$id = $req->route('id');
			$this->notes->edit($id, [
				'text' => $text
			]);
		}else{
			$this->notes->add([
				'text' => $text
			]);
		}
		if ($req->has('api')) {
			return $this->apiGetList();
		}else{
			return redirect()->route('home');
		}
		
	}

	public function delete(request $req) {
		$id = $req->route('id');

		$this->notes->remove($id);
		if ($req->has('api')) {
			$isEmpty = $this->notes->count() ? false : true;
			return [
				'success' => true,
				'id' => $id,
				'reload' => [
					'status' => $isEmpty,
					'content' => $isEmpty ? $this->apiGetList()['content'] : null
				]
			];
		}else{
			return redirect()->route('home');
		}
	}
}