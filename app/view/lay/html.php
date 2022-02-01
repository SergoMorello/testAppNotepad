<!DOCTYPE HTML>
<html lang="ru">
    <head>
        <title>{{ config('app.appName')}}</title>
        <meta http-equiv="Content-Type" content="text/html charset=utf-8">
        <meta name="description" content="Notepad">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="{{compressor(['css/reset.css', 'css/style.css'], 'styles.css')}}" rel="stylesheet">
		<script src="{{compressor(['js/script.js'], 'scripts.js')}}" crossorigin="anonymous"></script>
    </head>
    <body>
		<div class="root">
			@yield('content')
		</div>
	</body>
</html>