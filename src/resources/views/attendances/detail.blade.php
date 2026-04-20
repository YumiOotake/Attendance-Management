@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/attendances/detail.css') }}">
@endsection
@section('content')
    <div class="attendance">
        <div class="attendance__inner">
            <div class="attendance__top">
                <form class="search-form" action="{{ route('search') }}" method="get">
                    <div class="search-form__item">
                        <div class="search-form__select-wrapper">
                            <select name="date" class="search-form__item-input search-form__select">
                                <option value="">月</option>
                                @foreach ($attendances as $attendance)
                                    <option value="{{ $category->id }}"
                                        {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $index + 1 }}. {{ $category->content }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="search-form__button">
                        <button class="search-form__button--submit" type="submit">検索</button>
                    </div>
                </form>
                <div class="attendance-content__export">
                    <a href="{{ route('export', request()->query()) }}"
                        class="attendance-content__export--button">エクスポート</a>
                </div>
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
                                        <a href="#modal-{{ $attendance->id }}" class="attendance-table__request-button">修正</a>
                                    </div>
                                </td>
                                <td class="attendance-table__item">{{ $attendance->date }}</td>
                                <td class="attendance-table__item">{{ $attendance->type }}</td>
                                <td class="attendance-table__item">{{ $attendance->clock_in }}</td>
                                <td class="attendance-table__item">{{ $attendance->clock_out }}</td>
                                <td class="attendance-table__item">{{ $attendance->break_in }}</td>
                                <td class="attendance-table__item">{{ $attendance->break_out }}</td>
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
