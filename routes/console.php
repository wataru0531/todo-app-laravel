<?php

// artisanコマンド用のルーティング

// ✅ Artisan(アーティザン)
// → Laravel専用のコマンドラインツール(Laravelをターミナルから操作するためのツール)
// さまざまなコマンドを持つ

// 実行例
// php artisan serve → serveという機能を実行してください
// php artisan migrate → DBを更新

// Artisan
// ├ serve
// ├ migrate
// ├ make:model
// ├ make:controller
// └ inspire


use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
	$this->comment(Inspiring::quote()); // ターミナルに表示
})->purpose('Display an inspiring quote');
