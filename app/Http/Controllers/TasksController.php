<?php

// コントローラを記述
// リクエストを受け取り、どんな処理を行うかを決める役割
// → 必ずしもModelに渡さなくてもいい

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TasksController extends Controller {

  // actionを定義していく
	// リクエストを受け取って実行される関数のこと

	// Request ... 型宣言。タイプヒント。
	public function store(Request $request){
		$task =  $request->input("task");
		return $task . "が実行されました。";
	}
}
