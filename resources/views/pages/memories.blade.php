@extends('layouts.app', ['title' => 'Cat Deck - Rozhi Coffee Plan'])

@section('content')
<section class="safe-x mx-auto max-w-7xl py-10 md:py-16">
    <div class="mb-10 flex flex-col justify-between gap-4 md:flex-row md:items-end">
        <div>
            <p class="font-black text-blush-400">black cat deck</p>
            <h1 class="section-title mt-3">کارت‌های انتخاب برنامه</h1>
        </div>
        <p class="max-w-md leading-8 text-cocoa/70 dark:text-white/70">
            Memories قبلی تبدیل شده به کارت‌های انتخاب؛ روی هر کارت بزن تا متن آماده همان پلن را ببینی.
        </p>
    </div>

    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($memories as $memory)
            <button
                type="button"
                class="memory-card group glass-card overflow-hidden text-right transition hover:-translate-y-2"
                data-title="{{ $memory->title }}"
                data-place="{{ $memory->place }}"
                data-description="{{ $memory->description }}"
                data-image="{{ $memory->image_path ? asset($memory->image_path) : asset(config('rozhi.cat_image')) }}"
            >
                <div class="relative grid aspect-[4/3] place-items-center overflow-hidden bg-gradient-to-br from-night via-nightSoft to-[#3a264b] text-6xl">
                    <div class="absolute h-44 w-44 rounded-full bg-blush-300/20 blur-3xl"></div>
                    @if($memory->image_path)
                        <img src="{{ asset($memory->image_path) }}" alt="{{ $memory->title }}" class="relative z-10 h-full w-full object-cover opacity-95">
                    @else
                        <img src="{{ asset(config('rozhi.cat_image')) }}" onerror="this.onerror=null;this.src='{{ asset('images/black-kitten.svg') }}'" alt="black kitten" class="relative z-10 w-40 drop-shadow-2xl">
                    @endif
                </div>
                <div class="p-5">
                    <p class="text-xs font-black uppercase tracking-wide text-blush-400">{{ $memory->mood }}</p>
                    <h2 class="mt-2 text-xl font-black">{{ $memory->title }}</h2>
                    <p class="mt-2 text-sm text-cocoa/60 dark:text-white/60">{{ $memory->place }}</p>
                </div>
            </button>
        @endforeach
    </div>
</section>

<div id="memory-modal" class="memory-modal">
    <div class="glass-card max-h-[90vh] w-full max-w-3xl overflow-y-auto p-5">
        <button id="modal-close" class="secondary-button mb-4" type="button">بستن ✕</button>
        <div id="modal-image" class="mb-5 grid aspect-video place-items-center overflow-hidden rounded-[2rem] bg-gradient-to-br from-night to-nightSoft text-7xl">
            🐾
        </div>
        <h2 id="modal-title" class="text-3xl font-black"></h2>
        <p id="modal-place" class="mt-2 font-black text-blush-400"></p>
        <p id="modal-description" class="mt-5 leading-9 text-cocoa/75 dark:text-white/75"></p>
        <button id="modal-copy" class="cute-button mt-6" type="button">کپی متن همین پلن</button>
        <p id="modal-copy-status" class="mt-3 hidden text-sm font-black text-blush-400">کپی شد.</p>
    </div>
</div>
@endsection
