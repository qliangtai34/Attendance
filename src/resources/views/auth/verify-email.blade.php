@extends('layouts.app')

@section('content')
<h1>メール認証が必要です</h1>

<p>
登録したメールアドレスに確認メールを送信しました。  
メール内のリンクをクリックしてください。
</p>

@if (session('status') == 'verification-link-sent')
    <p style="color: green;">
        認証メールを再送しました。
    </p>
@endif

<form method="POST" action="{{ route('verification.send') }}">
    @csrf
    <button type="submit">
        認証メールを再送
    </button>
</form>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">
        ログアウト
    </button>
</form>
@endsection
