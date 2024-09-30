@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
    <div class="register">
        <h2 class="register-ttl">会員登録</h2>

        <form class="register-form" action="{{ route('register') }}" method="post">
            @csrf
            <div class="register-form__item">
                <input type="text" name="name" class="register-form__item-input" placeholder="名前"
                    value="{{ old('name') }}" autocomplete="name" />
                @error('name')
                    <div class="register__error">{{ $message }}</div>
                @enderror
            </div>
            <div class="register-form__item">
                <input type="email" name="email" class="register-form__item-input" placeholder="メールアドレス"
                    value="{{ old('email') }}" autocomplete="email" />
                @error('email')
                    <div class="register__error">{{ $message }}</div>
                @enderror
            </div>
            <div class="register-form__item">
                <div class="password-container">
                    <input type="password" id="password" name="password" class="register-form__item-input"
                        placeholder="パスワード" autocomplete="new-password" />
                    <button type="button" id="togglePassword1" class="toggle-password">🙉</button>
                </div>
                @error('password')
                    <div class="register__error">{{ $message }}</div>
                @enderror
            </div>
            <div class="register-form__item">
                <div class="password-container">
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="register-form__item-input" placeholder="確認用パスワード" autocomplete="new-password" />
                    <button type="button" id="togglePassword2" class="toggle-password">🙉</button>
                </div>
                @error('password_confirmation')
                    <div class="register__error">{{ $message }}</div>
                @enderror
            </div>

            <div class="register-form__button">
                <button class="register-form__button-submit" type="submit">会員登録</button>

                <div class="form-login">
                    <p class="form-login__p">アカウントをお持ちの方はこちら</p>
                    <a href="{{ route('login') }}" class="form-login__link">ログイン</a>
                </div>
        </form>
    </div>

    @section('js')
    <script src="{{ asset('js/register.js') }}"></script>
    @endsection
@endsection
