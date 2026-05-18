@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/attendances/request.css') }}">
@endsection
@section('content')
    <div class="request-form__content">
        <div class="attendance__back">
            <a href="{{ route('attendance.detail') }}" class="attendance__back-button">申請一覧へ戻る</a>
        </div>
        <form action="{{ route('attendance.request', $attendance) }}" method="POST" class="request-form" novalidate>
            @csrf
            <div class="request-form__group">
                <div class="request-form__group-title">
                    <label for="type" class="request-form__label">勤怠</label>
                </div>
                <div class="request-form__group-content">
                    <select class="search-form__category-select" name="requested_type">
                        <option value="1" @if (old('type', $attendance->type) == 1) selected @endif>出勤</option>
                        <option value="2" @if (old('type', $attendance->type) == 2) selected @endif>有給</option>
                        <option value="3" @if (old('type', $attendance->type) == 3) selected @endif>欠勤</option>
                        <option value="4" @if (old('type', $attendance->type) == 4) selected @endif>遅刻</option>
                        <option value="5" @if (old('type', $attendance->type) == 5) selected @endif>早退</option>
                        <option value="6" @if (old('type', $attendance->type) == 6) selected @endif>休日出勤</option>
                    </select>
                    <div class="request-form__error">
                        @error('requested_type')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="request-form__group">
                <div class="request-form__group-title">
                    <label for="requested_clock_in" class="request-form__label">出勤時刻</label>
                </div>
                <div class="request-form__group-content">
                    <input type="text" id="requested_clock_in" name="requested_clock_in"
                        value="{{ old('requested_clock_in', $attendance->clock_in_formatted()) }}"
                        class="request-form__input--text">
                    <div class="request-form__error">
                        @error('requested_clock_in')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="request-form__group">
                <div class="request-form__group-title">
                    <label for="requested_clock_out" class="request-form__label">退勤時刻</label>
                </div>
                <div class="request-form__group-content">
                    <input type="text" id="requested_clock_out" name="requested_clock_out"
                        value="{{ old('requested_clock_out', $attendance->clock_out_formatted()) }}"
                        class="request-form__input--text">
                    <div class="request-form__error">
                        @error('requested_clock_out')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="request-form__group">
                <div class="request-form__group-title">
                    <label for="requested_break_start" class="request-form__label">休憩入</label>
                </div>
                <div class="request-form__group-content">
                    <input type="requested_break_start" id="requested_break_start" name="requested_break_start"
                        value="{{ old('requested_break_start', $breakTime?->break_start_formatted()) }}"
                        class="request-form__input--text">
                    <div class="request-form__error">
                        @error('requested_break_start')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="request-form__group">
                <div class="request-form__group-title">
                    <label for="requested_break_end" class="request-form__label">休憩戻</label>
                </div>
                <div class="request-form__group-content">
                    <input type="text" id="requested_break_end" name="requested_break_end"
                        value="{{ old('requested_break_end', $breakTime?->break_end_formatted()) }}"
                        class="request-form__input--text">
                    <div class="request-form__error">
                        @error('requested_break_end')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="request-form__group">
                <div class="request-form__group-title">
                    <label for="requested_reason" class="request-form__label">理由</label>
                </div>
                <div class="request-form__group-content">
                    <textarea class="request-form__input--text request-form__textarea" name="requested_reason" id="requested_reason" cols="30" rows="10">{{ old('requested_reason')}}</textarea>
                    <div class="request-form__error">
                        @error('requested_reason')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="request-form__button">
                <button class="request-form__button-submit" type="submit">申請</button>
            </div>
        </form>
    </div>
@endsection
