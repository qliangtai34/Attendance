@extends('layouts.app')

@section('content')
<h2>メール認証が必要です</h2>

<p>
登録したメールアドレスに認証メールを送信します。<br>
下のボタンを押してください。
</p>

@if (session('status') === 'verification-link-sent')
    <p style="color: green;">
        認証メールを送信しました。
    </p>
@endif

<form method="POST" action="{{ route('verification.send') }}">
    @csrf
    <button type="submit">
        認証メールを送信
    </button>
</form>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">
        ログアウト
    </button>
</form>
@endsection
