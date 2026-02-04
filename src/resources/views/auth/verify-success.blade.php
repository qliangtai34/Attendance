@extends('layouts.app')

@section('content')
<h1>メール認証が完了しました</h1>

<p>ログインできるようになりました。</p>

<a href="{{ route('login') }}">ログインへ</a>
@endsection
