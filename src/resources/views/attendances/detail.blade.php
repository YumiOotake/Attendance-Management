@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/attendances/detail.css') }}">
@endsection
@section('content')
    <div class="attendance">
        <div class="attendance__inner">
            @if (session('success'))
                <div class="attendance__result">
                    {{ session('success') }}
                </div>
            @endif
            <div class="attendance__top">
                <div class="attendance__month">
                    <p class="attendance__month-text">{{ request('month') }}月</p>
                </div>
                <form class="search-form" action="{{ route('attendance.detail') }}" method="get">
                    <div class="search-form__item">
                        <div class="search-form__select-wrapper">
                            <select name="month" class="search-form__item-input search-form__select">
                                <option value="">月</option>
                                @foreach ($months as $month)
                                    <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                                        {{ $month }}月
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="search-form__button">
                        <button class="search-form__button--submit" type="submit">検索</button>
                    </div>
                </form>
                {{-- <div class="attendance-content__export">
                    <a href="{{ route('export', request()->query()) }}"
                        class="attendance-content__export--button">エクスポート</a>
                </div> --}}
            </div>
            <div class="attendance__back">
                <a href="{{ route('attendance.index') }}" class="attendance__back-button">打刻ページへ戻る</a>
            </div>
            <div class="attendance__result">
                <table class="attendance-table">
                    <thead class="attendance-table__thead">
                        <tr class="attendance-table__row">
                            <th class="attendance-table__header"></th>
                            <th class="attendance-table__header">日</th>
                            <th class="attendance-table__header">勤怠</th>
                            <th class="attendance-table__header">出勤時刻</th>
                            <th class="attendance-table__header">退勤時刻</th>
                            <th class="attendance-table__header">休憩入</th>
                            <th class="attendance-table__header">休憩戻</th>
                        </tr>
                    </thead>
                    <tbody class="attendance-table__tbody">
                        @forelse ($attendances as $attendance)
                            <tr class="attendance-table__row">
                                <td class="attendance-table__item">
                                    <div class="attendance-table__request">
                                        <a href="{{ route('attendance.requestForm', $attendance->id) }}"
                                            class="attendance-table__request-button">修正</a>
                                    </div>
                                </td>
                                <td class="attendance-table__item">{{ $attendance->date->format('d') }}</td>
                                <td class="attendance-table__item">{{ $attendance->type_label }}</td>
                                <td class="attendance-table__item">{{ $attendance->clock_in_formatted() }}</td>
                                <td class="attendance-table__item">{{ $attendance->clock_out_formatted() }}</td>
                                <td class="attendance-table__item">
                                    @foreach ($attendance->breakTimes as $breakTime)
                                        <div>{{ $breakTime->break_start_formatted() }}</div>
                                    @endforeach
                                </td>
                                <td class="attendance-table__item">
                                    @foreach ($attendance->breakTimes as $breakTime)
                                        <div>{{ $breakTime->break_end_formatted() }}</div>
                                    @endforeach
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="attendance-table__empty">
                                    勤怠記録がありません。
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
