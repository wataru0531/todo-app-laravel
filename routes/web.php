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


// ✅ 一覧ページ
Route::get("/tasks", [TasksController::class, "index"])->name("tasks.index");

// ✅ tasks/create
// Route::get("/tasks/create", function(){
// 	return view("tasks.create");
// })->name("tasks.create");
Route::get("/tasks/create", [TasksController::class, "create"])->name("tasks.create");

// ✅ コントローラに渡して対処する
// TasksControllerクラスのstoreメソッドを実行する
Route::post("/tasks/create", [TasksController::class, "store"])->name("tasks.store");

// ✅ 編集ページ
// ->name("tasks.edit") ... このルーティングに名前をつける
// 👉 bladeのテンプレートエンジンからコントローラに、idを渡せる
// <a href="{{ route('tasks.edit', $task->id) }}">
Route::get("/tasks/{id}/edit", [TasksController::class, "edit"])->name("tasks.edit");


// ✅ 編集する
Route::post("/tasks/{id}/edit", [TasksController::class, "update"])->name("tasks.update");

// ✅ 削除
Route::delete("/tasks/{id}/delete", [TasksController::class, "destroy"])->name("tasks.destroy");
