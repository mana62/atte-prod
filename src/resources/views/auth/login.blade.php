@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <div class="login">
        <h2 class="login-ttl">ログイン</h2>

        <form class="login-form" action="{{ route('login') }}" method="post">
            @csrf
            <div class="login-form__item">
                <input type="email" name="email" class="login-form__item-input" placeholder="メールアドレス"
                    value="{{ old('email') }}" autocomplete="email" />
                @error('email')
                    <div class="login__error">{{ $message }}</div>
                @enderror
            </div>
            <div class="login-form__item">
                <div class="password-container">
                    <input type="password" id="password" name="password" class="login-form__item-input" placeholder="パスワード"
                        autocomplete="current-password" />
                    <button type="button" id="togglePassword" class="toggle-password">🙉</button>
                </div>
                @error('password')
                    <div class="login__error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        name="remember">
                    <span style="color: #787676;">{{ __('パスワードを記憶する') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a style="margin-top: 10px; color: #787676; text-decoration: none;"
                        href="{{ route('password.request') }}">
                        {{ __('パスワードを忘れた場合はこちら') }}
                    </a>
                @endif

                <div class="login-form__button">
                    <button class="login-form__button-submit" type="submit">ログイン</button>

                    <div class="form-register">
                        <p class="form-register__p">アカウントをお持ちでない方はこちら</p>
                        <a href="{{ route('register') }}" class="form-register__link">会員登録</a>
                    </div>
        </form>
    </div>

    @section('js')
    <script src="{{ asset('js/login.js') }}"></script>
    @endsection
@endsection
