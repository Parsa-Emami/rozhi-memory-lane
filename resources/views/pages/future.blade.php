@extends('layouts.app', ['title' => 'Ideas - Rozhi Coffee Plan'])

@section('content')
<section class="safe-x mx-auto max-w-7xl py-10 md:py-16">
    <div class="text-center">
        <p class="font-black text-blush-400">choose one</p>
        <h1 class="section-title mt-3">پیشنهاد دیت، صاف و ساده</h1>
        <p class="mx-auto mt-5 max-w-2xl leading-8 text-cocoa/70 dark:text-white/70">
            سه انتخاب اصلی اینجاست. نه متن کش‌دار، نه فاز عاشقانه؛ فقط یک برنامه مشخص.
        </p>
    </div>

    <div class="mt-12 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
        @php
            $cards = [
                [
                    'emoji' => '☕',
                    'title' => 'قهوه کوتاه',
                    'badge' => 'main pick',
                    'text' => 'یه قهوه جمع‌وجور بزنیم. تایمش مشخص، فضا ساده، شروعش راحت.',
                    'note' => 'انتخاب تمیز برای شروع.'
                ],
                [
                    'emoji' => '🎸',
                    'title' => 'گیتار زدن',
                    'badge' => 'cool',
                    'text' => 'یه جای آروم، من یه قطعه کوتاه با گیتار می‌زنم. ساده، متفاوت، بدون نمایش اضافه.',
                    'note' => 'برای وایب متفاوت‌تر.'
                ],
                [
                    'emoji' => '🚗',
                    'title' => 'رودتریپ کوتاه',
                    'badge' => 'day only',
                    'text' => 'یه مسیر کوتاه روزانه، امن و سبک. رفت‌وبرگشت همان روز، بدون طولانی‌کردن برنامه.',
                    'note' => 'فقط اگر خودت با مسیر راحت بودی.'
                ],
                [
                    'emoji' => '🧋',
                    'title' => 'نوشیدنی و قدم کوتاه',
                    'badge' => 'easy',
                    'text' => 'یه نوشیدنی بگیریم و چند دقیقه قدم بزنیم؛ اگر حوصله‌اش نبود همان نوشیدنی کافی است.',
                    'note' => 'سبک و کم‌هزینه.'
                ],
                [
                    'emoji' => '🎲',
                    'title' => 'بردگیم کافه‌ای',
                    'badge' => 'fun',
                    'text' => 'یه بازی ساده که مکالمه را خشک نکند. بیشتر فان، کمتر رسمی.',
                    'note' => 'برای شروع پرانرژی.'
                ],
                [
                    'emoji' => '📸',
                    'title' => 'کافه وابی — جای عکس',
                    'badge' => 'reference',
                    'text' => 'همان جایی که دیدمت. این کارت را گذاشتم تا بعداً عکس کافه وابی را همین‌جا اضافه کنم.',
                    'note' => 'فقط یک رفرنس لوکیشن.'
                ],
            ];
        @endphp

        @foreach($cards as $card)
            <article class="glass-card flex h-full flex-col p-7 transition hover:-translate-y-2">
                <div class="flex items-start justify-between gap-4">
                    <div class="text-6xl">{{ $card['emoji'] }}</div>
                    <span class="rounded-full bg-white/60 px-3 py-1 text-xs font-black text-cocoa/60 dark:bg-white/10 dark:text-white/60">
                        {{ $card['badge'] }}
                    </span>
                </div>
                <h2 class="mt-5 text-2xl font-black">{{ $card['title'] }}</h2>
                <p class="mt-3 leading-8 text-cocoa/70 dark:text-white/70">{{ $card['text'] }}</p>
                <p class="mt-auto pt-5 text-sm font-black text-blush-400">{{ $card['note'] }}</p>
            </article>
        @endforeach
    </div>
</section>
@endsection
