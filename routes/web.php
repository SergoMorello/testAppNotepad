<?php

route::get('/', 'MainController@index')->name('home');

route::get('/get/{id}', 'MainController@get')->name('get');

route::post('/submit/{id?}', 'MainController@submit')->name('submit');

route::get('/delete/{id}', 'MainController@delete')->name('delete');
