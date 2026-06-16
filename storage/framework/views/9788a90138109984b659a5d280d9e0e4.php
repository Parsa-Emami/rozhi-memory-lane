<!doctype html>
<html lang="fa" dir="rtl" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title><?php echo e($title ?? 'Rozhi Coffee Plan'); ?></title>

    <meta name="theme-color" content="#11101a">
    <meta name="description" content="A clean, cool and direct coffee plan page for Rozhi.">

    <link rel="manifest" href="/manifest.webmanifest">
    <link rel="icon" href="/icons/icon.svg" type="image/svg+xml">

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body>
<div class="page-shell">
    <div id="star-field" aria-hidden="true"></div>
    <div class="mesh-orb mesh-orb-one" aria-hidden="true"></div>
    <div class="mesh-orb mesh-orb-two" aria-hidden="true"></div>

    <header class="sticky top-0 z-40 border-b border-white/35 bg-white/55 backdrop-blur-2xl dark:border-white/10 dark:bg-night/70">
        <nav class="safe-x mx-auto flex max-w-7xl items-center justify-between gap-3 py-3 sm:py-4">
            <a href="<?php echo e(route('home')); ?>" class="brand-mark">
                <span class="brand-icon"><img src="<?php echo e(asset(config('rozhi.cat_image'))); ?>" onerror="this.onerror=null;this.src='<?php echo e(asset('images/black-kitten.svg')); ?>'" alt="black kitten"></span>
                <span class="hidden sm:inline">Rozhi Coffee Plan</span>
            </a>

            <div class="hidden items-center gap-1 lg:flex">
                <a class="nav-link" href="<?php echo e(route('story')); ?>">Spin</a>
                <a class="nav-link" href="<?php echo e(route('memories')); ?>">Cat Deck</a>
                <a class="nav-link" href="<?php echo e(route('quiz')); ?>">Plan Picker</a>
                <a class="nav-link" href="<?php echo e(route('letter')); ?>">Note</a>
                <a class="nav-link" href="<?php echo e(route('future')); ?>">Ideas</a>
                <a class="nav-link nav-link-strong" href="<?php echo e(route('invite')); ?>">Send Invite</a>
            </div>

            <div class="flex items-center gap-2">
                <button id="mobile-menu-toggle" class="secondary-button px-4 lg:hidden" type="button">☰</button>
                <button id="theme-toggle" class="secondary-button text-sm" type="button">🌙 Night</button>
            </div>
        </nav>

        <div id="mobile-menu" class="safe-x mx-auto hidden max-w-7xl pb-4 lg:hidden">
            <div class="glass-card grid gap-2 p-3">
                <a class="nav-link" href="<?php echo e(route('story')); ?>">Spin</a>
                <a class="nav-link" href="<?php echo e(route('memories')); ?>">Cat Deck</a>
                <a class="nav-link" href="<?php echo e(route('quiz')); ?>">Plan Picker</a>
                <a class="nav-link" href="<?php echo e(route('letter')); ?>">Note</a>
                <a class="nav-link" href="<?php echo e(route('future')); ?>">Ideas</a>
                <a class="nav-link nav-link-strong" href="<?php echo e(route('invite')); ?>">Send Invite</a>
            </div>
        </div>
    </header>

    <main class="relative z-10">
        <?php if(session('status')): ?>
            <div class="mx-auto mt-6 max-w-3xl px-4">
                <div class="glass-card p-4 text-center font-bold">
                    <?php echo e(session('status')); ?>

                </div>
            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <aside class="cat-companion" aria-label="black cat companion">
        <img src="<?php echo e(asset(config('rozhi.cat_image'))); ?>" onerror="this.onerror=null;this.src='<?php echo e(asset('images/black-kitten.svg')); ?>'" alt="گربه مشکی کوچک">
        <span>Pick a plan, keep it clean.</span>
    </aside>

    <div class="music-dock" aria-label="background music player">
        <audio id="bg-audio" preload="auto" loop data-src="<?php echo e(asset('audio/lana-let-the-light-in.mp3')); ?>"></audio>
        <button id="music-toggle" type="button" class="music-button">♫</button>
        <div>
            <p class="text-xs font-black">Lana mood</p>
            <p id="music-status" class="text-[11px] opacity-70">فایل آهنگ را داخل public/audio بگذار</p>
        </div>
    </div>

    <footer class="relative z-10 mx-auto max-w-7xl px-4 py-10 text-center text-sm text-cocoa/70 dark:text-white/60">
        سه گزینه ساده: قهوه، گیتار، رودتریپ کوتاه. همین.
    </footer>
</div>

<script>
(() => {
    const audio = document.getElementById("bg-audio");
    const toggleBtn = document.getElementById("music-toggle");
    const status = document.getElementById("music-status");

    if (!audio) return;

    const STORAGE_KEY = "rozhi_music_state";
    const TIME_KEY = "rozhi_music_time";
    const CHANNEL = new BroadcastChannel("rozhi-music");

    audio.volume = 0.6;
    audio.loop = true;

    // -----------------------------
    // GLOBAL LOCK (IMPORTANT)
    // -----------------------------
    if (window.__ROZHI_AUDIO_INIT) return;
    window.__ROZHI_AUDIO_INIT = true;

    function saveState(isPlaying) {
        localStorage.setItem(STORAGE_KEY, isPlaying ? "1" : "0");
    }

    function getState() {
        return localStorage.getItem(STORAGE_KEY) === "1";
    }

    function saveTime() {
        localStorage.setItem(TIME_KEY, audio.currentTime);
    }

    function restoreTime() {
        const t = parseFloat(localStorage.getItem(TIME_KEY));
        if (!isNaN(t)) audio.currentTime = t;
    }

    // -----------------------------
    // PLAY SAFE
    // -----------------------------
    async function playMusic(fromSync = false) {
        try {
            restoreTime();
            await audio.play();

            saveState(true);

            if (!fromSync) {
                CHANNEL.postMessage({ type: "play", time: audio.currentTime });
            }

            if (status) status.innerText = "Playing";
        } catch (e) {
            document.addEventListener("click", async () => {
                restoreTime();
                await audio.play();
                saveState(true);
                CHANNEL.postMessage({ type: "play", time: audio.currentTime });
            }, { once: true });
        }
    }

    function pauseMusic(fromSync = false) {
        saveTime();
        audio.pause();

        saveState(false);

        if (!fromSync) {
            CHANNEL.postMessage({ type: "pause", time: audio.currentTime });
        }

        if (status) status.innerText = "Paused";
    }

    // -----------------------------
    // AUTO START (FIXED)
    // -----------------------------
    window.addEventListener("load", () => {
        setTimeout(() => {
            playMusic();
        }, 50);
    });

    // -----------------------------
    // TOGGLE
    // -----------------------------
    toggleBtn?.addEventListener("click", () => {
        if (audio.paused) playMusic();
        else pauseMusic();
    });

    // -----------------------------
    // SYNC BETWEEN TABS
    // -----------------------------
    CHANNEL.onmessage = (e) => {
        if (!e.data) return;

        if (e.data.type === "play") {
            audio.currentTime = e.data.time || audio.currentTime;
            playMusic(true);
        }

        if (e.data.type === "pause") {
            pauseMusic(true);
        }
    };

    // -----------------------------
    // KEEP STATE ON FOCUS
    // -----------------------------
    document.addEventListener("visibilitychange", () => {
        if (!document.hidden && getState()) {
            playMusic(true);
        }
    });

    // -----------------------------
    // SAVE TIME CONTINUOUSLY
    // -----------------------------
    setInterval(() => {
        if (!audio.paused) {
            saveTime();
        }
    }, 2000);

})();
</script>

<!-- LINKS NEW TAB (FIXED SAFE VERSION) -->
<script>
document.addEventListener("click", (e) => {
    const a = e.target.closest("a");
    if (!a) return;

    const href = a.getAttribute("href");
    if (!href) return;

    // ignore anchors + javascript links
    if (href.startsWith("#") || href.startsWith("javascript:")) return;

    e.preventDefault();

    window.open(a.href, "_blank", "noopener,noreferrer");
});
</script>
</body>
</html><?php /**PATH C:\Users\alienware\Desktop\rozhi-memory-lane\resources\views/layouts/app.blade.php ENDPATH**/ ?>