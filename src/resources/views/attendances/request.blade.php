@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/attendances/request.css') }}">
@endsection
@section('content')
    <div class="request-form__content">
        <form action="{{ route('confirm') }}" method="POST" class="request-form" novalidate>
            @csrf
            <div class="request-form__group">
                <div class="request-form__group-title">
                    <label for="type" class="request-form__label">勤怠</label>
                </div>
                <div class="request-form__group-content">
                    <input type="type" id="type" name="type" value="{{ old('type', $attendance->type) }}"
                        class="request-form__input--text">
                    <div class="request-form__error">
                        @error('type')
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
                    <input type="requested_clock_in" id="requested_clock_in" name="requested_clock_in" value="{{ old('requested_clock_in', $attendance->clock_in) }}"
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
                    <input type="requested_clock_out" id="requested_clock_out" name="requested_clock_out" value="{{ old('requested_clock_out', $attendance->clock_out) }}"
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
                    <input type="requested_break_start" id="requested_break_start" name="requested_break_start" value="{{ old('requested_break_start', $break->break_start) }}"
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
                    <input type="requested_break_end" id="requested_break_end" name="requested_break_end" value="{{ old('requested_break_end', $break->break_end) }}"
                        class="request-form__input--text">
                    <div class="request-form__error">
                        @error('requested_break_end')
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
