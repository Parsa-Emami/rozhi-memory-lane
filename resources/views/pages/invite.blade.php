@extends('layouts.app', ['title' => 'Send Invite - Rozhi Coffee Plan'])

@section('content')
<section class="safe-x mx-auto grid max-w-6xl items-center gap-8 py-10 text-center md:grid-cols-[1.05fr_.95fr] md:py-16 md:text-right">
    <div>
        <p class="font-black text-blush-400">send this</p>
        <h1 class="mt-3 text-4xl font-black leading-tight sm:text-5xl md:text-6xl">
            دعوت اصلی برای <span data-rozhi>Rozhi</span>
        </h1>
        <p class="mt-6 leading-9 text-cocoa/70 dark:text-white/70">
            متن‌ها مستقیم‌اند: قهوه، گیتار، یا رودتریپ کوتاه. هر کدام را خواستی با یک کلیک کپی کن.
        </p>

        <div class="mt-8 grid gap-4">
            @php
                $messages = [
                    [
                        'emoji' => '☕',
                        'title' => 'نسخه قهوه',
                        'text' => 'Rozhi، بیا یه قهوه کوتاه بزنیم. ساده و جمع‌وجور؛ زمان و جاش رو خودت راحت‌تر بودی انتخاب کن.'
                    ],
                    [
                        'emoji' => '🎸',
                        'title' => 'نسخه گیتار',
                        'text' => 'Rozhi، یه پیشنهاد ساده دارم: یه جای آروم بریم، من یه قطعه کوتاه با گیتار بزنم، بعدش قهوه. کدوم روز برات بهتره؟'
                    ],
                    [
                        'emoji' => '🚗',
                        'title' => 'نسخه رودتریپ',
                        'text' => 'Rozhi، اگه حسش رو داشتی یه رودتریپ کوتاه روزانه بریم؛ مسیر سبک، رفت‌وبرگشت همان روز، بعدش قهوه.'
                    ],
                ];
            @endphp

            @foreach($messages as $message)
                <article class="glass-card p-5">
                    <div class="flex items-center justify-between gap-3">
                        <h2 class="text-xl font-black">{{ $message['emoji'] }} {{ $message['title'] }}</h2>
                        <button class="copy-text secondary-button text-sm" type="button" data-copy="{{ $message['text'] }}">کپی</button>
                    </div>
                    <p class="mt-4 leading-8 text-cocoa/75 dark:text-white/75">{{ $message['text'] }}</p>
                </article>
            @endforeach
        </div>

        <div class="mt-8 flex flex-wrap justify-center gap-3 md:justify-start">
            <button id="copy-invite" class="cute-button" type="button" data-link="{{ route('home') }}">
                کپی لینک پروژه
            </button>
            <a class="secondary-button" href="{{ route('future') }}">دیدن همه ایده‌ها</a>
        </div>

        <p id="copy-message" class="mt-4 hidden font-black text-blush-400">کپی شد.</p>
    </div>

    <div class="glass-card p-8 text-center">
        <img src="{{ asset(config('rozhi.cat_image')) }}" onerror="this.onerror=null;this.src='{{ asset('images/black-kitten.svg') }}'" alt="black kitten" class="mx-auto w-64 animate-floaty">
        <h2 class="mt-6 text-3xl font-black">No drama, just a plan.</h2>
        <p class="mt-4 leading-8 text-cocoa/70 dark:text-white/70">
            ظاهر نرم، متن مستقیم، انتخاب‌ها واضح؛ قهوه، گیتار یا مسیر کوتاه.
        </p>
    </div>
</section>
@endsection
