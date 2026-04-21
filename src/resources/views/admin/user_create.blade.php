@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection
@section('content')
    <div class="auth-form__content">
        <div class="auth-form__content-wrapper">
            <div class="auth-form__heading">
                <h1 class="auth-form__heading-title">User Create</h1>
            </div>
            <form action="{{ route('admin.register') }}" method="POST" class="auth-form" novalidate>
                @csrf
                <div class="auth-form__group">
                    <div class="auth-form__group-title">
                        <label for="login_id" class="auth-form__label-item">ID</label>
                    </div>
                    <div class="auth-form__group-content">
                        <div class="auth-form__input-text">
                            <input type="text" name="login_id" value="{{ old('login_id') }}" id="login_id"
                                class="auth-form__input" placeholder="例: 2">
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
                        <label for="name" class="auth-form__label-item">お名前</label>
                    </div>
                    <div class="auth-form__group-content">
                        <div class="auth-form__input-text">
                            <input type="text" name="name" value="{{ old('name') }}" id="name"
                                class="auth-form__input" placeholder="例: 山田 太郎">
                        </div>
                        <div class="auth-form__error">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="auth-form__group">
                    <div class="auth-form__group-title">
                        <label for="email" class="auth-form__label-item">メールアドレス</label>
                    </div>
                    <div class="auth-form__group-content">
                        <div class="auth-form__input-text">
                            <input type="email" name="email" value="{{ old('email') }}" id="email"
                                class="auth-form__input" placeholder="例: test@example.com">
                        </div>
                        <div class="auth-form__error">
                            @error('email')
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
                            <input type="password" name="password" class="auth-form__input" id="password"
                                placeholder="例: coachtech1106">
                        </div>
                        <div class="auth-form__error">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="auth-form__group">
                    <div class="auth-form__group-title">
                        <label for="password_confirmation" class="auth-form__label-item">確認用パスワード</label>
                    </div>
                    <div class="auth-form__group-content">
                        <div class="auth-form__input-text">
                            <input type="password" name="password_confirmation" class="auth-form__input"
                                id="password_confirmation" placeholder="例: coachtech1106">
                        </div>
                        <div class="auth-form__error">
                            @error('password_confirmation')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- <div class="auth-form__group">
                    <div class="auth-form__group-title">
                        <label for="is_admin" class="auth-form__label-item">管理者にしますか</label>
                    </div>
                    <div class="auth-form__group-content">
                        <div class="auth-form__input-text">
                            <input type="radio" name="is_admin" value="0" id="is_admin"
                                class="auth-form__input">一般
                            <input type="radio" name="is_admin" value="1" id="is_admin"
                                class="auth-form__input">管理者
                        </div>
                        <div class="auth-form__error">
                            @error('is_admin')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div> --}}
                <div class="auth-form__button">
                    <button class="auth-form__button-submit">登録</button>
                </div>
            </form>
        </div>
    </div>
@endsection
