<?php

// ✅ migrationファイルは、まだ実行していないマイグレーションファイルだけが
// 　　実行される

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 * php artisan migrate で実行
	 */
	public function up(): void {
		// ✅ Scheme:table() → すでに存在するtasksテーブルを変更するメソッド
		// Blueprint → 型。テーブルの設計図を書くためのオブジェクト
		Schema::table("tasks", function(Blueprint $table) {
			// date型のdue_dateカラム、nullを許容、taskカラムの後に追加(sqliteでは効かない)
			$table->date("due_date")->nullable()->after("task");
		});
	}

	/**
	 * ✅ upで行ったことを元に戻すための処理
	 * php artisan migrate:rollback で実行
	 */
	public function down(): void {
		Schema::table("tasks", function(Blueprint $table) {
			$table->dropColumn("due_date");
		});
	}
};
