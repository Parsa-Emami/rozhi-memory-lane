<?php $__env->startSection('content'); ?>
<section class="safe-x mx-auto max-w-4xl py-10 md:py-16">
    <div class="text-center">
        <p class="font-black text-blush-400">quick picker</p>
        <h1 class="section-title mt-3">کوییز خیلی کوتاه انتخاب پلن</h1>
        <p class="mx-auto mt-5 max-w-2xl leading-8 text-cocoa/70 dark:text-white/70">
            چند سوال سریع؛ آخرش می‌گوید قهوه، گیتار یا رودتریپ بیشتر می‌خورد.
        </p>
    </div>

    <div id="quiz-root" class="mt-10"></div>

    <div id="quiz-result" class="glass-card mt-8 hidden p-8 text-center">
        <img src="<?php echo e(asset(config('rozhi.cat_image'))); ?>" onerror="this.onerror=null;this.src='<?php echo e(asset('images/black-kitten.svg')); ?>'" alt="black kitten" class="mx-auto w-36">
        <h2 class="mt-4 text-3xl font-black">پیشنهاد برنامه</h2>
        <p id="quiz-result-text" class="mx-auto mt-4 max-w-2xl leading-9 text-cocoa/75 dark:text-white/75"></p>
        <a href="<?php echo e(route('invite')); ?>" class="cute-button mt-7">رفتن به متن دعوت</a>
    </div>

    <canvas id="confetti-canvas" class="pointer-events-none fixed inset-0 z-[60]"></canvas>
</section>

<script>
    window.RML_QUIZ = <?php echo \Illuminate\Support\Js::from($quizPayload)->toHtml() ?>;
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['title' => 'Plan Picker - Rozhi Coffee Plan'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\alienware\Desktop\rozhi-memory-lane\resources\views\pages\quiz.blade.php ENDPATH**/ ?>