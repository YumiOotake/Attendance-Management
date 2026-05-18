@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/edit.css') }}">
@endsection
@section('content')
    <div class="attendance">
        <div class="attendance__inner">
            <form action="{{ route('admin.request.update', $attendanceRequest) }}" method="POST" class="auth-form" novalidate>
                @csrf
                @method('PATCH')
                <div class="auth-form__group">
                    <div class="auth-form__group-title">
                        <label for="name" class="auth-form__label-item">お名前</label>
                    </div>
                    <div class="auth-form__group-content">
                        <div class="auth-form__input-text">
                            <p>{{ old('name', $attendanceRequest->user->name) }}</p>
                        </div>
                    </div>
                </div>
                <div class="auth-form__group">
                    <div class="auth-form__group-title">
                        <label for="date" class="auth-form__label-item">日付</label>
                    </div>
                    <div class="auth-form__group-content">
                        <div class="auth-form__input-text">
                            <p>{{ old('date', $attendanceRequest->attendance->date->format('m-d')) }}</p>
                        </div>
                    </div>
                </div>
                <div class="auth-form__group">
                    <div class="auth-form__group-title">
                        <label for="date" class="auth-form__label-item">勤怠</label>
                    </div>
                    <div class="auth-form__group-content">
                        <p>{{ $attendanceRequest->attendance->type_label }}</p>
                        <select name="type">
                            <option value="1" @if (old('type', $attendanceRequest->attendance->type) == 1) selected @endif>出勤</option>
                            <option value="2" @if (old('type', $attendanceRequest->attendance->type) == 2) selected @endif>有給</option>
                            <option value="3" @if (old('type', $attendanceRequest->attendance->type) == 3) selected @endif>欠勤</option>
                            <option value="4" @if (old('type', $attendanceRequest->attendance->type) == 4) selected @endif>遅刻</option>
                            <option value="5" @if (old('type', $attendanceRequest->attendance->type) == 5) selected @endif>早退</option>
                            <option value="6" @if (old('type', $attendanceRequest->attendance->type) == 6) selected @endif>休日出勤</option>

                        </select>
                    </div>
                </div>
                <div class="auth-form__group">
                    <div class="auth-form__group-title">
                        <label for="clock_in" class="auth-form__label-item">出勤時刻</label>
                    </div>
                    <div class="auth-form__group-content">
                        <div class="auth-form__input-text">
                            <p>{{ $attendanceRequest->attendance->clock_in_formatted() }}→</p>
                            <input type="clock_in" name="clock_in" class="auth-form__input" id="clock_in"
                                value="{{ old('clock_in', $attendanceRequest->clock_in_formatted()) }}">
                        </div>
                        <div class="auth-form__error">
                            @error('clock_in')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="auth-form__group">
                    <div class="auth-form__group-title">
                        <label for="clock_out" class="auth-form__label-item">退勤時刻</label>
                    </div>
                    <div class="auth-form__group-content">
                        <div class="auth-form__input-text">
                            <p>{{ $attendanceRequest->attendance->clock_out_formatted() }}→</p>
                            <input type="clock_out" name="clock_out" class="auth-form__input" id="clock_out"
                                value="{{ old('clock_out', $attendanceRequest->clock_out_formatted()) }}">
                        </div>
                        <div class="auth-form__error">
                            @error('clock_out')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                @foreach ($breakTimes as $breakTime)
                    <div class="auth-form__group">
                        <div class="auth-form__group-title">
                            <label for="break_start" class="auth-form__label-item">休憩入</label>
                        </div>
                        <div class="auth-form__group-content">
                            <div class="auth-form__input-text">
                                <p>{{ $breakTime->break_start_formatted() }}→</p>
                                <input type="break_start" name="break_start[{{ $breakTime->id }}]" class="auth-form__input" id="break_start"
                                    value="{{ old('break_start', $attendanceRequest->break_start_formatted()) }}">
                            </div>
                            <div class="auth-form__error">
                                @error('break_start')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="auth-form__group">
                        <div class="auth-form__group-title">
                            <label for="break_end" class="auth-form__label-item">休憩戻</label>
                        </div>
                        <div class="auth-form__group-content">
                            <div class="auth-form__input-text">
                                <p>{{ $breakTime->break_end_formatted() }}→</p>
                                <input type="break_end" name="break_end[{{ $breakTime->id }}]" class="auth-form__input" id="break_end"
                                    value="{{ old('break_end', $attendanceRequest->break_end_formatted()) }}">
                            </div>
                            <div class="auth-form__error">
                                @error('break_end')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                @endforeach


                <div class="auth-form__button">
                    <button class="auth-form__button-submit">登録</button>
                </div>
            </form>
        </div>
    </div>
@endsection
