<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '勤怠管理システム')</title>

    <style>
        /* ===== 全体 ===== */
        body {
            margin: 0;
            font-family: "Segoe UI", "Hiragino Kaku Gothic ProN", "Meiryo", sans-serif;
            background-color: #f4f6f8;
            color: #333;
        }

        /* ===== ヘッダー ===== */
        header {
            background-color: #2c3e50;
            padding: 12px 20px;
        }

        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            margin-right: 20px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        /* ログアウトボタン */
        nav button {
            background-color: #e74c3c;
            border: none;
            color: #fff;
            padding: 6px 14px;
            border-radius: 4px;
            cursor: pointer;
        }

        nav button:hover {
            background-color: #c0392b;
        }

        /* ===== メイン ===== */
        main {
            max-width: 1000px;
            margin: 30px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        /* ===== 見出し ===== */
        h1, h2, h3 {
            margin-top: 0;
            color: #2c3e50;
        }

        /* ===== ボタン共通 ===== */
        button {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }

        /* ===== メッセージ ===== */
        .alert {
            padding: 12px 16px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #eafaf1;
            color: #2ecc71;
            border: 1px solid #2ecc71;
        }

        .alert-danger {
            background-color: #fdecea;
            color: #e74c3c;
            border: 1px solid #e74c3c;
        }
    </style>
</head>
<body>

    <header>
        <nav>
            <a href="{{ route('attendance.index') }}">勤怠トップ</a>
            <a href="{{ route('attendance.list') }}">勤怠一覧</a>
            <a href="{{ route('admin.corrections.index') }}">申請一覧</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit">ログアウト</button>
            </form>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

</body>
</html>
