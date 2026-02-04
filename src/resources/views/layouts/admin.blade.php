<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理者画面</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        /* ===== ヘッダー ===== */
        .admin-header {
            background: #343a40;
            color: #fff;
            padding: 15px 20px;
        }

        .admin-header a {
            color: #fff;
            text-decoration: none;
            margin-left: 20px;
        }

        .admin-header a:hover {
            text-decoration: underline;
        }

        /* ===== メインコンテンツ ===== */
        .content {
            padding: 30px;
        }
    </style>
</head>
<body>

    <!-- ヘッダー -->
    <div class="admin-header d-flex justify-content-between align-items-center">
        <div>
            <strong></strong>
        </div>
        <div>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.corrections.index') }}">修正申請一覧</a>
            <a href="{{ route('admin.users.index') }}">スタッフ一覧</a>
            <a href="{{ route('admin.attendances') }}">📅 勤怠一覧</a>
            <a href="#"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                ログアウト
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
        </div>
    </div>

    <!-- メインコンテンツ -->
    <div class="content">
        @yield('content')
    </div>

</body>
</html>
