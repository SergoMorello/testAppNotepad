$(function(){
	form();
	control();
});

var note = {
	obj: function() {
		return $('.noteForm')
	},
	show: function(content) {
		this.obj().html(content);
		control();
		form();
	},
	error: function(name) {
		this.obj().find('[name="'+name+'"]').effect('highlight',{
			color: '#FFD800'
		});
	},
	flush: function(effect) {
		let obj = this.obj().find('.noteText').val("");
		let form = this.obj().find('form');
		let action = form.attr('action');
		let lastSlashIndex = action.lastIndexOf('/') + 1;
		let replace = '0';
		form.attr('action', action.substr(0, lastSlashIndex) + replace);
		if (effect)
			obj.effect('highlight',{
				color: '#7FC9FF'
			});
	}
};

var notes = {
	obj: function() {
		return $('.listNotes')
	},
	update: function(content){
		this.obj().html(content);
		control();
	},
	submit: function(action, data) {
		let xhr = new XMLHttpRequest();
		
		xhr.open('POST', action, false);
		xhr.send(data);
		let jsonResponse = JSON.parse(xhr.response);
		
		if (xhr.status != 200) {
			alert( xhr.status + ': ' + xhr.statusText );
		} else {
			if (jsonResponse.success) {
				this.update(jsonResponse.content);
				note.flush(true);
			}else{
				jsonResponse.errors.forEach(function(item){
					note.error(item.name);
				});
			}
			
		}
	},
	delete: function(id, reload) {
		this.obj().find('#note_'+id).hide('fade',function(){
			if (reload.status) {
				this.update(reload.content);
			}
		}.bind(this));
		note.flush();
	}
};

function control() {
	$('.deleteNote, .showNote, .getNotes').on('click', function(e){
		let href = $(this).attr('href');
		fetch(href+'?api=true')
		.then(response => response.json())
		.then(json => {
			if (json.success) {
				if ($(this).hasClass('deleteNote'))
					notes.delete(json.id, json.reload);
				if ($(this).hasClass('showNote'))
					note.show(json.content);
				if ($(this).hasClass('getNotes'))
					notes.update(json.content);
			}
		});
		
		return false;
	});
}

function form() {
	$('form').on('submit', function(e){
		let form = $(this);
		let action = form.attr('action');
		let formData = new FormData(this);
		formData.set('api', true);
		
		notes.submit(action, formData);
		
		return false;
	});
}