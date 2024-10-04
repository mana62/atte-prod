@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/users-index.css') }}">
@endsection

@section('nav')
    @include('layouts.header-nav')
@endsection

@section('content')
    <div class="ttl">
        <h2 class="ttl-users">
            メンバー一覧表
        </h2>

        <div class="search-users">
            <form class="search-users__form" action="{{ route('attendance-index.search') }}" method="post">
                @csrf
                <input class="search-users__input" type="text" name="input" placeholder="お名前またはIDを入力してください"
                    value="{{ $input ?? '' }}">
                <button class="search-users__submit" type="submit">検索</button>
            </form>
        </div>
    </div>

    <div class="table">
        <table class="table-users">
            <tr class="table-users__row">
                <th class="table-users__ttl">ID</th>
                <th class="table-users__ttl">名前</th>
                <th class="table-users__ttl"></th>
            </tr>
            @foreach ($users as $user)
                @if ($user)
                    <!--userがnullでないことをチェック-->
                    <tr class="table-users__row">
                        <td class="table-users__contents">{{ $user->id }}</td>
                        <td class="table-users__contents">{{ $user->name }}</td>
                        <td class="table-users__contents"><a href="{{ route('users-attendance', $user->id) }}">詳細</a></td>
                    </tr>
                @endif
            @endforeach
        </table>
    </div>

    <div class="pagination">
        {{ $users->links('vendor.pagination.custom') }}
    </div>
@endsection
