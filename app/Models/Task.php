<?php

namespace App\Models;

// Taskテーブルとのやりとりを行うファイル。
// → Controllerで使う。
// TaskController.phpで使う

use Illuminate\Database\Eloquent\Model;


// LaravelのModelクラスを継承
class Task extends Model {
  // protected → アクセス修飾子。
	//             このクラスと子クラスだけアクセスできる。
	//             他に、public、private など
	// $fillableに配列を参照させる
	// $fillable 👉 予約語。変更不可
	//            fillableに指定してあるtaskカラムだけは一括代入して良いと許可をだしている
	//            一括代入 ... 1つづつではなくて配列で代入するということ
	//            例えば、Task.create()で指定したカラムを一括でDBに入れることができる
	//            ただし、ここではtaskしかないので、taskのみ書いている
	protected $fillable = [
		"task", // カラム名
		"due_date"
	];

	// ✅ バリデーション
	public static $rules = [
		"task" => "required",
		"due_date" => "nullable|date", // nullを許容、date型
	];

	// ✅ バリデーションのエラーメッセージ
	public static $messages = [
		"task.required" => "タスクの内容を入力してください",
	];
}
