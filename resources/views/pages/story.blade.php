@extends('layouts.app', ['title' => 'Spin - Rozhi Coffee Plan'])

@section('content')
<section class="safe-x mx-auto max-w-6xl py-10 md:py-16">
    <div class="text-center">
        <p class="font-black text-blush-400">random plan spinner</p>
        <h1 class="section-title mt-3">شانسی بنداز، ببین کدوم پلن درمیاد</h1>
        <p class="mx-auto mt-5 max-w-2xl leading-8 text-cocoa/70 dark:text-white/70">
            این بخش جای Story قبلی آمده؛ یک فیچر سریع برای انتخاب وایب برنامه.
        </p>
    </div>

    <div class="mt-12 grid items-center gap-8 lg:grid-cols-[.85fr_1.15fr]">
        <div class="glass-card p-7 text-center">
            <div id="vibe-spinner-display" class="spin-display">
                <img src="{{ asset(config('rozhi.cat_image')) }}" onerror="this.onerror=null;this.src='{{ asset('images/black-kitten.svg') }}'" alt="black kitten" class="mx-auto w-44">
                <h2 class="mt-5 text-3xl font-black">Black Cat says…</h2>
                <p class="mt-3 leading-8 text-cocoa/70 dark:text-white/70">روی دکمه بزن تا یک پلن پیشنهاد بده.</p>
            </div>
            <button id="vibe-spin" class="cute-button mt-7 w-full" type="button">Spin the plan 🎛️</button>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            @php
                $spinCards = [
                    ['emoji' => '☕', 'title' => 'Coffee Run', 'text' => 'یه قهوه کوتاه؛ تایمش جمع‌وجور و ساده.', 'tag' => 'safe start'],
                    ['emoji' => '🎸', 'title' => 'Guitar Corner', 'text' => 'یه گوشه آروم، یه قطعه ساده با گیتار؛ نه اجرای سنگین.', 'tag' => 'cool'],
                    ['emoji' => '🚗', 'title' => 'Day Road Trip', 'text' => 'مسیر کوتاه، روزانه، امن، برگشت همان روز.', 'tag' => 'adventure'],
                    ['emoji' => '🧋', 'title' => 'Drink & Walk', 'text' => 'یه نوشیدنی بگیریم، بعد چند دقیقه قدم سبک.', 'tag' => 'easy'],
                ];
            @endphp

            @foreach($spinCards as $card)
                <article class="spin-card glass-card p-6" data-emoji="{{ $card['emoji'] }}" data-title="{{ $card['title'] }}" data-text="{{ $card['text'] }}">
                    <div class="flex items-center justify-between gap-4">
                        <span class="text-5xl">{{ $card['emoji'] }}</span>
                        <span class="rounded-full bg-white/60 px-3 py-1 text-xs font-black dark:bg-white/10">{{ $card['tag'] }}</span>
                    </div>
                    <h2 class="mt-5 text-2xl font-black">{{ $card['title'] }}</h2>
                    <p class="mt-3 leading-8 text-cocoa/70 dark:text-white/70">{{ $card['text'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endsection
