<?php

// ブラウザからのHTTPリクエストルーティングを定義するファイル

use Illuminate\Support\Facades\Route;

// ルーティング定義
Route::get('/', function () {
  return view('welcome'); // → resources/views/welcome.blade.php をレンダリング 
});



Route::get("/about", function() {
	return view("about.index"); // about/index.blade.php をレンダリング
});