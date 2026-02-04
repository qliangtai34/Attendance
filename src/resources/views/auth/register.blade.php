<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>新規登録</title>
</head>
<body>
    <h1>新規登録</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- 名前 --}}
        <div>
            <label for="name">名前</label><br>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
            >
            @error('name')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        {{-- メールアドレス --}}
        <div>
            <label for="email">メールアドレス</label><br>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
            >
            @error('email')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        {{-- パスワード --}}
        <div>
            <label for="password">パスワード</label><br>
            <input
                type="password"
                id="password"
                name="password"
            >
            @error('password')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        {{-- パスワード確認 --}}
        <div>
            <label for="password_confirmation">パスワード（確認）</label><br>
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
            >
            @error('password_confirmation')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">登録する</button>
    </form>

    <p>
        <a href="{{ route('login') }}">ログインはこちら</a>
    </p>
</body>
</html>
