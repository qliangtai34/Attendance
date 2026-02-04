<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理者ログイン</title>

    <style>
        .error-message {
            color: red;
            font-size: 0.9rem;
            margin-top: 4px;
        }
    </style>
</head>
<body>
    <h1>管理者ログイン</h1>

    <form method="POST" action="{{ route('admin.login.post') }}">
        @csrf

        {{-- メールアドレス --}}
        <div>
            <label>メールアドレス：</label><br>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
            >
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        {{-- パスワード --}}
        <div style="margin-top:10px;">
            <label>パスワード：</label><br>
            <input
                type="password"
                name="password"
            >
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" style="margin-top:15px;">
            ログイン
        </button>
    </form>
</body>
</html>
