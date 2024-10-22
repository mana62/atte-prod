@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/attendance-sheet.css') }}">
@endsection

@section('nav')
    @include('layouts.header-nav')
@endsection

@section('content')
    @php
        use Carbon\Carbon;
        $currentDate = isset($date) ? Carbon::parse($date) : Carbon::now('Asia/Tokyo');
    @endphp
    {{-- 日付の前後リンク --}}
    <div class="date">
        <a class="date-search__a" href="{{ route('date.show', ['date' => $currentDate->copy()->subDay()->format('Y-m-d')]) }}">〈</a>
        <div class="date-search">{{ $currentDate->format('Y年m月d日') }}</div>
        <a class="date-search__a" href="{{ route('date.show', ['date' => $currentDate->copy()->addDay()->format('Y-m-d')]) }}">〉</a>
    </div>

    <div class="content">
        <table class="content-table">
            <tr class="content-table__ttl">
                <th class="content-table__name">名前</th>
                <th class="content-table__name">勤務開始</th>
                <th class="content-table__name">勤務終了</th>
                <th class="content-table__name">休憩時間</th>
                <th class="content-table__name">勤務時間</th>
            </tr>

            {{-- ユーザーをループして表示 --}}
            @foreach ($users as $user)
                @foreach ($user->attendanceSheets as $attendance)
                    @php
                        // 休憩時間の合計計算
                        $totalBreakTime = $attendance->breakTimes->reduce(function ($carry, $break) {
                            $startBreak = Carbon::parse($break->start_break);
                            $finishBreak = Carbon::parse($break->finish_break);
                            return $carry + $finishBreak->diffInMinutes($startBreak);
                        }, 0);

                        // 勤務時間の合計計算
                        $startTime = Carbon::parse($attendance->start_time);
                        $finishTime = Carbon::parse($attendance->finish_time);
                        $totalWorkTime = $finishTime->diffInMinutes($startTime) - $totalBreakTime;
                    @endphp

                    <tr class="content-table__items">
                        <td class="content-table__item">{{ $user->name }}</td>
                        <td class="content-table__item">{{ $startTime->format('H時i分') }}</td>
                        <td class="content-table__item">{{ $finishTime->format('H時i分') }}</td>
                        <td class="content-table__item">
                            {{ floor($totalBreakTime / 60) }}時{{ str_pad($totalBreakTime % 60, 2, '0', STR_PAD_LEFT) }}分
                        </td>
                        <td class="content-table__item">
                            {{ floor($totalWorkTime / 60) }}時{{ str_pad($totalWorkTime % 60, 2, '0', STR_PAD_LEFT) }}分
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </table>

        {{-- ページネーションリンク --}}
        <div class="pagination">
            {{ $users->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection
