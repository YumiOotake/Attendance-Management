@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection
@section('content')
    <div class="auth-form__content">
        <div class="auth-form__content-wrapper">
            <div class="auth-form__heading">
                <h1 class="auth-form__heading-title">Login</h1>
            </div>
            <form action="{{ route('login') }}" method="POST" class="auth-form" novalidate>
                @csrf
                <div class="auth-form__group">
                    <div class="auth-form__group-title">
                        <label for="login_id" class="auth-form__label-item">ID</label>
                    </div>
                    <div class="auth-form__group-content">
                        <div class="auth-form__input-text">
                            <input type="text" name="login_id" value="{{ old('login_id') }}" id="login_id"
                                class="auth-form__input" placeholder="例: 1">
                        </div>
                        <div class="auth-form__error">
                            @error('login_id')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="auth-form__group">
                    <div class="auth-form__group-title">
                        <label for="password" class="auth-form__label-item">パスワード</label>
                    </div>
                    <div class="auth-form__group-content">
                        <div class="auth-form__input-text">
                            <input type="password" name="password" id="password" class="auth-form__input"
                                placeholder="例: coachtech1106">
                        </div>
                        <div class="auth-form__error">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="auth-form__button">
                    <button class="auth-form__button-submit">ログイン</button>
                </div>
            </form>
        </div>
    </div>
@endsection
