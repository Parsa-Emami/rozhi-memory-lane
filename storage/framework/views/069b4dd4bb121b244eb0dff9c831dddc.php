<?php $__env->startSection('content'); ?>
<section class="safe-x mx-auto grid max-w-7xl items-center gap-10 py-10 text-center md:grid-cols-[1.05fr_.95fr] md:py-20 md:text-right">
    <div class="animate-fadeUp">
        <div class="mb-5 inline-flex items-center gap-2 rounded-full bg-white/70 px-4 py-2 text-sm font-black shadow-soft dark:bg-white/10">
            <span>🐈‍⬛</span>
            <span>سه تا پلن ساده روی میز</span>
        </div>

        <h1 class="text-4xl font-black leading-tight sm:text-5xl md:text-7xl">
            <span data-rozhi>Rozhi</span>، یکی از اینا؟
        </h1>

        <p class="mt-6 max-w-xl text-lg leading-9 text-cocoa/75 dark:text-white/75">
            قهوه کوتاه، یه اجرای گیتار ساده، یا یه رودتریپ سبکِ روزانه. خودت انتخاب کن کدوم وایبش بهتره و نتیجه رو بهم بگو.
        </p>

        <div class="mt-8 flex flex-wrap justify-center gap-3 md:justify-start">
            <a href="<?php echo e(route('invite')); ?>" class="cute-button w-full sm:w-auto">دیدن دعوت اصلی ☕</a>
            <a href="<?php echo e(route('story')); ?>" class="secondary-button w-full sm:w-auto">بذار شانسی انتخاب کنه 🎛️</a>
        </div>

        <div class="mx-auto mt-8 grid max-w-xl gap-3 sm:grid-cols-3 md:mx-0">
            <a href="<?php echo e(route('future')); ?>" class="mini-plan-card">
                <span>☕</span>
                <strong>قهوه</strong>
                <small>کوتاه و تمیز</small>
            </a>
            <a href="<?php echo e(route('future')); ?>" class="mini-plan-card">
                <span>🎸</span>
                <strong>گیتار</strong>
                <small>یه قطعه ساده</small>
            </a>
            <a href="<?php echo e(route('future')); ?>" class="mini-plan-card">
                <span>🚗</span>
                <strong>رودتریپ</strong>
                <small>مسیر امن روزانه</small>
            </a>
        </div>
    </div>

    <div class="relative animate-floaty">
        <div class="hero-phone glass-card p-4">
            <div class="relative overflow-hidden rounded-[2.25rem] bg-gradient-to-br from-night via-nightSoft to-[#3a264b] p-6 text-white shadow-nightGlow">
                <div class="absolute -left-16 -top-16 h-44 w-44 rounded-full bg-blush-300/25 blur-3xl"></div>
                <div class="absolute -bottom-20 -right-14 h-52 w-52 rounded-full bg-softPurple/25 blur-3xl"></div>

                <div class="relative z-10 flex items-center justify-between">
                    <span class="rounded-full bg-white/10 px-4 py-2 text-xs font-black">Black Cat Mode</span>
                    <span class="rounded-full bg-white/10 px-3 py-2">✦</span>
                </div>

                <img src="<?php echo e(asset(config('rozhi.cat_image'))); ?>" onerror="this.onerror=null;this.src='<?php echo e(asset('images/black-kitten.svg')); ?>'" alt="black kitten" class="relative z-10 mx-auto mt-5 w-52 drop-shadow-2xl">

                <div class="relative z-10 mt-6 rounded-[2rem] border border-white/10 bg-white/10 p-5 backdrop-blur-xl">
                    <h2 class="text-2xl font-black">Pick the vibe</h2>
                    <p class="mt-2 leading-8 text-white/75">یه صفحه سبک و کول برای انتخاب برنامه، بدون شلوغ‌کاری.</p>

                    <div class="mt-5 grid gap-3">
                        <a href="<?php echo e(route('future')); ?>" class="hero-list-item">☕ قهوه کوتاه</a>
                        <a href="<?php echo e(route('future')); ?>" class="hero-list-item">🎸 گیتار زدن</a>
                        <a href="<?php echo e(route('future')); ?>" class="hero-list-item">🚗 رودتریپ کوتاه</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="safe-x mx-auto max-w-7xl pb-16">
    <div class="grid gap-5 md:grid-cols-3">
        <?php $__currentLoopData = $featuredMemories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $memory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <article class="glass-card p-6 transition hover:-translate-y-2">
                <p class="text-4xl"><?php echo e($memory->mood === 'coffee' ? '☕' : ($memory->mood === 'guitar' ? '🎸' : '🚗')); ?></p>
                <h2 class="mt-4 text-2xl font-black"><?php echo e($memory->title); ?></h2>
                <p class="mt-2 text-sm font-black text-blush-400"><?php echo e($memory->place); ?></p>
                <p class="mt-4 leading-8 text-cocoa/70 dark:text-white/70"><?php echo e($memory->description); ?></p>
            </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['title' => 'Rozhi Coffee Plan'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\alienware\Desktop\rozhi-memory-lane\resources\views/pages/home.blade.php ENDPATH**/ ?>