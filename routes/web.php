<?php

// ルーティングを定義するファイル
// ルーティングを定義するファイルなので余計なロジックなどは書かない


use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

// ルーティング定義
// GETでもらう場合
Route::get('/', function () {
  return view('welcome'); // → resources/views/welcome.blade.php をレンダリング 
});


// ✅ about
// フォルダ名 + ファイルの先頭名 ... about.index
Route::get("/about", function() { 
	return view("about.index"); // about/index.blade.php をレンダリング
});


// ✅ tasks/create
// GET
Route::get("/tasks/create", function(){
	return view("tasks.create");
});

// POST
// Route::post("/tasks/create", function(Request $request) {
// 	// フォームから値を取得。name属性から
// 	// $task = request("task");
	
// 	// $task = $request->input("task");

// 	$validate = $request->validate([
// 		"task" => ["required", "max:255"],
// 		"deadline" => ["nullable"],
// 	]);

// 	// return "タスクが送信されました";
// 	// return $task .  "が送信されました";
// 	return $validate["task"] . $validate["deadline"];
// });


// ✅ コントローラに渡して対処する
// TasksControllerクラスのstoreメソッドを実行する
Route::post("/tasks/create", [TasksController::class, "store"]);

