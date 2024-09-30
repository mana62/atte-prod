@extends('layouts.app')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <div class="mb-4 text-sm text-gray-600 text-center">
                {{ __('パスワードをお忘れですか？ 下記ボタンからパスワードのリセットを行なってください。') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-label for="email" :value="__('メールアドレス')" class="text-center" />

                    <x-input id="email" class="block mt-1 w-full border-2 border-gray-800 rounded-md" type="email" name="email"
                        :value="old('email')" required autofocus />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="w-full justify-center">
                        {{ __('パスワードリセットリンクをメールで送信') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
@endsection