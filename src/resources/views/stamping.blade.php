@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/stamping.css') }}">
@endsection

@section('nav')
    @include('layouts.header-nav')
@endsection

@section('content')
    <div class="message">
        <p class="message-p">{{ Auth::user()->name }}さんお疲れ様です！</p>

        @if (session('message'))
            <div class="message-session">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <div class="attendance">
        <div class="attendance-buttons">
            <div class="attendance-row">

                <!-- 勤務開始ボタン -->
                <form action="{{ route('stamping.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="start_time" value="1">
                    <div class="attendance-button">
                        <button id="startButton" class="attendance-button__submit" type="submit"
                            {{ $attendance && \Carbon\Carbon::parse($attendance->start_time)->isToday() && !$attendance->finish_time ? 'disabled' : '' }}>
                            {{-- attendanceがあるか確認、かつ今日の出勤タイムがあるか確認、かつ出勤がまだ終了していない場合無効化 --}}
                            勤務開始
                        </button>
                    </div>
                </form>

                <!-- 休憩開始ボタン -->
                <form action="{{ route('stamping.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="start_break" value="1">
                    <div class="attendance-button">
                        <button id="startBreakButton" class="attendance-button__submit" type="submit" {{-- 勤務開始がされており、休憩中でない場合に有効 --}}
                            {{ !$attendance || !$attendance->start_time || $attendance->finish_time || $attendance->breakTimes->whereNull('finish_break')->count() > 0 ? 'disabled' : '' }}>
                            {{-- attendanceがない、または出勤が開始していない、または勤務終了している、または、まだ終了していない休憩が存在する場合は無効化 --}}
                            休憩開始
                        </button>
                    </div>
                </form>
            </div>
            <div class="attendance-row">

                <!-- 勤務終了ボタン -->
                <form action="{{ route('stamping.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="finish_time" value="1">
                    <div class="attendance-button">
                        <button id="finishButton" class="attendance-button__submit" type="submit" {{-- 勤務が開始されており、まだ終了していない場合に有効 --}}
                            {{ !$attendance || !$attendance->start_time || $attendance->finish_time ? 'disabled' : '' }}>
                            勤務終了
                        </button>
                    </div>
                </form>

                <!-- 休憩終了ボタン -->
                <form action="{{ route('stamping.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="finish_break" value="1">
                    <div class="attendance-button">
                        <button id="finishBreakButton" class="attendance-button__submit" type="submit"
                            {{-- 勤務が開始されており、休憩中の場合に有効 --}}
                            {{ !$attendance || !$attendance->start_time || $attendance->breakTimes->whereNull('finish_break')->count() === 0 ? 'disabled' : '' }}>
                            休憩終了
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('js')
    <script>
        window.attendanceData = @json($attendance);
    </script>

    <script src="{{ asset('js/stamping.js') }}"></script>
    @endsection
@endsection
