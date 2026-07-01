<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minimal Task Manager Mockup</title>

    <!-- <script src="https://cdn.tailwindcss.com"></script> -->

    <!-- 
      CSSとJSをvite経由で読み込みませる 

      LaravelがViteへのリンクをHTMLに埋め込む

      ブラウザ
          │
          ▼
      Laravel(8000)
          │
      BladeをHTMLへ変換
          │
          ▼
      HTML
        ↓
      <link href="http://localhost:5173/...">
      <script src="http://localhost:5173/...">
          │
          ▼
      ブラウザが5173へCSS・JSを取りに行く
    -->
    @vite(["resources/css/app.css", "resources/js/app.js"])
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Noto Sans JP', sans-serif;
            -webkit-font-smoothing: antialiased;
            background-color: #fcfcfc;
        }
        
        /* チェック状態のスタイル */
        .task-item.completed .task-text {
            text-decoration: line-through;
            color: #9ca3af;
        }
        .task-item.completed .task-meta {
            opacity: 0.5;
        }
        
        /* アニメーション */
        @keyframes slideUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-slide-up {
            animation: slideUp 0.4s ease-out forwards;
        }
    </style>
</head>
<body class="text-gray-800 min-h-screen flex items-center justify-center p-4 selection:bg-gray-200">

  <!-- Main Container -->
  <main class="w-full max-w-lg animate-slide-up pb-20">

    <!-- $tasksを1つずつ取り出して、その1つを$taskとして使う -->
    <!-- 
      @foreach ($tasks as $task)
        <p>{{ $task->task }}</p>
      @endforeach
    -->
    <!-- Header Area -->
    <header class="mb-8 flex justify-between items-end px-2">
        <div>
            <p class="text-xs font-bold tracking-widest text-gray-400 uppercase mb-1">TODAY</p>
            <h1 class="text-3xl font-light tracking-tight text-[#1a1a1a]">Tasks</h1>
        </div>
        <div class="text-right">
            <span class="text-sm font-medium text-gray-500">3 tasks left</span>
        </div>
    </header>

    <!--
    <div class="mb-6 px-4">
        <div class="bg-green-100 border border-green-200 text-green-800 text-sm rounded-lg px-4 py-3" role="alert">
        </div>
    </div>
    -->


    <!-- Task List (Static Content) -->
    <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden min-h-[300px]">
      <ul class="divide-y divide-gray-50">
        @foreach($tasks as $task)
          <!-- Task 1: Normal -->
          <li class="task-item group flex items-start justify-between p-5 hover:bg-gray-50 transition-colors duration-200">
            <div class="flex items-start gap-4 flex-1 min-w-0">
              <!-- Checkbox Icon Link -->
              <a href="#" class="mt-1 text-gray-300 hover:text-[#1a1a1a] transition-colors text-xl" aria-label="完了にする">
                <i class="fa-regular fa-square"></i>
              </a>
              <div class="flex flex-col gap-1 w-full">

                <!-- 
                  編集ページに遷移させる
                  wet.phpのルーティングに、id を渡す
                  Route::get("/tasks/{id}/edit", [TasksController::class, "edit"])->name("tasks.edit");
                -->
                <a href="{{ route('tasks.edit', $task->id) }}" class="task-text text-lg font-light text-gray-700 leading-snug hover:text-[#3b82f6] transition-colors block">
                  {{ $task->task }}
                </a>

                @if($task->due_date)
                  <div class="task-meta flex items-center gap-2 text-xs text-gray-400">
                    <i class="fa-regular fa-calendar w-3.5"></i>
                    <span>{{ date("Y年n月j日 H:1", strtotime($task->due_date)) }}</span>
                  </div>
                @endif
              </div>
            </div>
            <button class="text-gray-300 hover:text-red-500 p-2 rounded-full hover:bg-red-50 transition-all opacity-0 group-hover:opacity-100">
              <i class="fa-solid fa-trash text-sm"></i>
            </button>
          </li>
        @endforeach
      </ul>
    </div>

    <!-- Footer -->
    <div class="mt-6 flex justify-between items-center px-4">
        <div class="w-1/3"></div>
        <div class="w-1/3 text-center"></div>
        <div class="w-1/3 text-right">
            <button class="text-xs font-medium text-gray-400 hover:text-red-500 transition-colors">
                完了済みを削除
            </button>
        </div>
    </div>

  </main>

  <!-- Floating Action Button for Add -->
  <button class="fixed bottom-8 right-8 w-14 h-14 bg-[#1a1a1a] text-white rounded-full shadow-lg hover:shadow-xl hover:bg-black hover:scale-105 transition-all duration-300 flex items-center justify-center group z-50 focus:outline-none focus:ring-4 focus:ring-gray-200">
      <i class="fa-solid fa-plus text-xl group-hover:rotate-90 transition-transform duration-300"></i>
  </button>

</body>
</html>