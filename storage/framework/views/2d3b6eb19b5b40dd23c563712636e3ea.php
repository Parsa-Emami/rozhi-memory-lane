<?php $__env->startSection('content'); ?>
<section class="safe-x mx-auto max-w-4xl py-10 md:py-16">
    <div class="glass-card p-8 md:p-12">
        <?php if (! ($unlocked)): ?>
            <div class="text-center">
                <img src="<?php echo e(asset(config('rozhi.cat_image'))); ?>" onerror="this.onerror=null;this.src='<?php echo e(asset('images/black-kitten.svg')); ?>'" alt="black kitten" class="mx-auto w-44 animate-floaty">
                <h1 class="mt-6 text-4xl font-black">یادداشت کوتاه</h1>
                <p class="mx-auto mt-4 max-w-xl leading-8 text-cocoa/70 dark:text-white/70">
                    رمز پیش‌فرض این بخش: <strong>coffee</strong>
                </p>
            </div>

            <form method="POST" action="<?php echo e(route('letter.unlock')); ?>" class="mx-auto mt-8 max-w-md">
                <?php echo csrf_field(); ?>

                <label class="mb-2 block font-bold" for="password">رمز یادداشت</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="cozy-input"
                    placeholder="coffee"
                    required
                >

                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-3 text-sm font-bold text-rose-500"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <button class="cute-button mt-5 w-full" type="submit">
                    باز کردن
                </button>
            </form>
        <?php else: ?>
            <article class="prose prose-lg max-w-none dark:prose-invert">
                <div class="text-center text-7xl">☕🎸🚗</div>
                <h1 class="text-center">برای <span data-rozhi>Rozhi</span></h1>

                <p>
                    سه تا پیشنهاد گذاشتم: قهوه کوتاه، گیتار زدن، یا رودتریپ سبک روزانه.
                    هر کدام به نظرت بهتر بود همان را انتخاب کن.
                </p>

                <p>
                    ایده‌اش ساده است: زمان مشخص، جای مشخص، و یک برنامه‌ای که حس خوبی داشته باشد.
                    قهوه کوتاه اگر بخواهی ساده شروع کنیم؛ گیتار اگر وایب متفاوت‌تر خواستی؛ رودتریپ هم فقط در حد مسیر کوتاه و برگشت همان روز.
                </p>

                <p>
                    من انتخاب را گذاشتم روی میز. تو فقط بگو کدامش بیشتر به مودت می‌خورد.
                </p>
            </article>

            <form method="POST" action="<?php echo e(route('letter.reply')); ?>" class="mt-10 grid gap-4">
                <?php echo csrf_field(); ?>

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block font-bold">اسم یا لقب</label>
                        <input name="nickname" class="cozy-input" placeholder="اختیاری">
                    </div>
                    <div>
                        <label class="mb-2 block font-bold">انتخاب تو</label>
                        <input name="mood" class="cozy-input" placeholder="قهوه، گیتار، رودتریپ...">
                    </div>
                </div>

                <div>
                    <label class="mb-2 block font-bold">جواب کوتاه</label>
                    <textarea name="answer" rows="6" class="cozy-input" placeholder="همینجا بنویس کدوم پلن بهتره..." required></textarea>
                    <?php $__errorArgs = ['answer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm font-bold text-rose-500"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <button class="cute-button" type="submit">ثبت جواب</button>
            </form>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['title' => 'Note - Rozhi Coffee Plan'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\alienware\Desktop\rozhi-memory-lane\resources\views\pages\letter.blade.php ENDPATH**/ ?>