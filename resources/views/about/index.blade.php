<!-- 
	✅ blade → テンプレートエンジン

-->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>About</title>

	<!-- 
		CSS取り込み 
		@vite ... LaravelがViteと連携しての機能
	-->
	@vite(["resources/css/app.css", "resources/js/app.js"])
</head>
<body>
	<h1 class="text-3xl text-red-500">About</h1>
	<p>概要ページ</p>
</body>
</html>