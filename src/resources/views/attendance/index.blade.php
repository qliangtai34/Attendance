@extends('layouts.app')

@section('content')
<div class="container">

    <h2>勤怠打刻</h2>

    {{-- 👤 ユーザー名表示 --}}
<p>
    ログインユーザー：
    <strong>{{ auth()->user()->name }}</strong>
</p>

    <p>現在時刻：{{ now()->format('Y-m-d H:i:s') }}</p>

    <h3>今日のステータス：{{ $attendance->status }}</h3>

    {{-- メッセージ --}}
    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- 出勤 --}}
    @if ($attendance->status === '勤務外')
        <form action="{{ route('attendance.clockIn') }}" method="POST">
            @csrf
            <button class="btn btn-primary">出勤</button>
        </form>
    @endif

    {{-- 休憩開始 --}}
    @if ($attendance->status === '出勤中')
        <form action="{{ route('attendance.breakStart') }}" method="POST" class="mt-2">
            @csrf
            <button class="btn btn-warning">休憩開始</button>
        </form>
    @endif

    {{-- 休憩終了 --}}
    @if ($attendance->status === '休憩中')
        <form action="{{ route('attendance.breakEnd') }}" method="POST" class="mt-2">
            @csrf
            <button class="btn btn-success">休憩戻</button>
        </form>
    @endif

    {{-- 退勤 --}}
    @if ($attendance->status === '出勤中')
        <form action="{{ route('attendance.clockOut') }}" method="POST" class="mt-2">
            @csrf
            <button class="btn btn-danger">退勤</button>
        </form>
    @endif

    {{-- ⭐ 勤怠詳細画面へ遷移するボタン（追加） --}}
    <div class="mt-4">
        <a href="{{ route('attendance.detail', ['id' => $attendance->id]) }}"
   class="btn btn-info">
    今日の勤怠詳細を見る
</a>

    </div>

    <div class="mt-4">
    <a href="{{ route('attendance.list') }}" class="btn btn-secondary">
        勤怠一覧へ
    </a>
</div>


</div>
@endsection