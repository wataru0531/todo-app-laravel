<?php

// コントローラを記述
// リクエストを受け取り、どんな処理を行うかを決める役割
// → 必ずしもModelに渡さなくてもいい

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task; // モデル(DB操作)

class TasksController extends Controller {
  // actionを定義していく
	// リクエストを受け取って実行される関数のこと

	// ✅ 一覧ページを返す
	public function index() {
		$tasks = Task::all(); // DBから全件取得

		// dd($tasks); // デバッグ Dump and Die

		// 変数をviewに渡す → ページを動的にしていく
		return view("tasks.index", [ // index.blade.php
			"tasks" => $tasks
		]);
	}

	// Request ... 型宣言。タイプヒント。
	public function store(Request $request){
		// ✅ バリデーションを適用
		$validated = $request->validate(
			Task::$rules,
			Task::$messages // エラーメッセージ
		);

		// ✅ DBに保存
		// create() → Taskの親のModelのメソッド
		$result = Task::create($validated); // バリデーション後の変数

		// バリデーションしたので下記は不要
		// $task = $request->input("task");
		// $due_date = $request->input("due_date");

		// // ✅ Taskモデルを使いDBに保存
		// $result = Task::create([
		// 	"task" => $task,
		// 	"due_date" => $due_date
		// ]);

		return $result->id . " 番目のタスクを追加しました。";
	}


}
