@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/attendances/index.css') }}">
@endsection
@section('content')


    <div class="attendance">
        <div class="attendance__inner">

            {{-- 現在時刻 --}}
            <div class="attendance__clock">
                <p class="attendance__clock-time" id="js-clock">00:00:00</p>
                <p class="attendance__clock-date" id="js-date"></p>
            </div>

            {{-- 現在のステータス --}}
            <div class="attendance__status">
                <span class="attendance__status-badge attendance__status-badge--{{ $status ?? 'none' }}">
                    @switch($status ?? 'none')
                        @case('working')
                            出勤中
                        @break

                        @case('break')
                            休憩中
                        @break

                        @case('done')
                            退勤済
                        @break

                        @default
                            未出勤
                    @endswitch
                </span>
            </div>

            {{-- 打刻ボタン --}}
            <div class="attendance__actions">
                <form action="{{ route('attendance.clockIn') }}" method="post" class="attendance__form">
                    @csrf
                    <button type="submit" class="attendance__button attendance__button--in"
                        {{ $status !== null && $status !== 'none' ? 'disabled' : '' }}>
                        出勤
                    </button>
                </form>

                <form action="{{ route('attendance.clockOut') }}" method="post" class="attendance__form">
                    @csrf
                    <button type="submit" class="attendance__button attendance__button--out"
                        {{ $status !== 'working' ? 'disabled' : '' }}>
                        退勤
                    </button>
                </form>

                <form action="{{ route('attendance.breakStart') }}" method="post" class="attendance__form">
                    @csrf
                    <button type="submit" class="attendance__button attendance__button--break-start"
                        {{ $status !== 'working' ? 'disabled' : '' }}>
                        休憩入
                    </button>
                </form>

                <form action="{{ route('attendance.breakEnd') }}" method="post" class="attendance__form">
                    @csrf
                    <button type="submit" class="attendance__button attendance__button--break-end"
                        {{ $status !== 'break' ? 'disabled' : '' }}>
                        休憩戻
                    </button>
                </form>
            </div>

            {{-- 詳細ページへ --}}
            <div class="attendance__detail">
                <a href="{{ route('attendance.index') }}" class="attendance__detail-link">
                    勤怠一覧を見る →
                </a>
            </div>

        </div>
    </div>

    <script>
        function updateClock() {
            const now = new Date();

            const h = String(now.getHours()).padStart(2, '0');
            const m = String(now.getMinutes()).padStart(2, '0');
            const s = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('js-clock').textContent = `${h}:${m}:${s}`;

            const days = ['日', '月', '火', '水', '木', '金', '土'];
            const year = now.getFullYear();
            const month = now.getMonth() + 1;
            const date = now.getDate();
            const day = days[now.getDay()];
            document.getElementById('js-date').textContent =
                `${year}年${month}月${date}日（${day}）`;
        }

        updateClock();
        setInterval(updateClock, 1000);
    </script>

@endsection
@endsection
