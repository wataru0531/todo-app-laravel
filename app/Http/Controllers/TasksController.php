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
		return view("tasks.index", [ // tasks/index.blade.php
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

	// ✅ 編集ページ
	// → Routingのweb.phpから、idを受け取る
	public function edit(int $id) {
		// echo $id . "を編集します。";
		$task = Task::findOrFail($id); // ないなら404を返す
		// dd($task); // attributes に配列でデータが格納されている
		
		return view("tasks.edit", [
			"task" => $task, // 👉 editページに$taskのデータを渡す
		]);
	}

	// ✅ 編集する
	// → web.phpからリクエスト内容と$idが渡ってくる
	public function update(Request $request, int $id) {
		$task = Task::findOrFail($id); // 該当するデータを取得
		// dd($task); // attributesに配列でデータが格納

		// バリデーションを適用。OKなら$validatedに入る
		$validated = $request->validate(Task::$rules, Task::$messages);

		$task->update($validated); // 👉 更新。TaskはModelを継承しているのでupdateメソッドが使える

		return redirect()->route("tasks.index");
	}

	// ✅ 作成ページに移動
	public function create() {
		return view("tasks.create"); // tasks/create.php を返すだけ
	}

	// ✅ 削除
	public function destroy(int $id) {
		$task = Task::findOrFail($id); // データを取得
		$task->delete($id);

		return redirect()->route("tasks.index");
	}


}
