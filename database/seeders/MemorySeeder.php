<?php

namespace Database\Seeders;

use App\Models\Memory;
use Illuminate\Database\Seeder;

class MemorySeeder extends Seeder
{
    public function run(): void
    {
        Memory::query()->delete();

        $plans = [
            [
                'title' => 'قهوه کوتاه',
                'place' => 'یک کافه خلوت و جمع‌وجور',
                'memory_date' => '2026-06-15',
                'description' => 'Rozhi، بیا یه قهوه کوتاه بزنیم. ساده و جمع‌وجور؛ زمان و جاش رو خودت راحت‌تر بودی انتخاب کن.',
                'image_path' => null,
                'mood' => 'coffee',
                'sort_order' => 1,
                'is_featured' => true,
            ],
            [
                'title' => 'گیتار زدن',
                'place' => 'یک گوشه آرام با وایب خوب',
                'memory_date' => '2026-06-15',
                'description' => 'یه پیشنهاد ساده: یه جای آروم بریم، من یه قطعه کوتاه با گیتار بزنم، بعدش قهوه. بدون اجرای سنگین و شلوغ‌کاری.',
                'image_path' => 'images/memories/music.svg',
                'mood' => 'guitar',
                'sort_order' => 2,
                'is_featured' => true,
            ],
            [
                'title' => 'رودتریپ کوتاه',
                'place' => 'مسیر امن، روزانه، برگشت همان روز',
                'memory_date' => '2026-06-15',
                'description' => 'اگه حسش رو داشتی یه رودتریپ کوتاه روزانه بریم؛ مسیر سبک، رفت‌وبرگشت همان روز، بعدش قهوه.',
                'image_path' => 'images/memories/night.svg',
                'mood' => 'road',
                'sort_order' => 3,
                'is_featured' => true,
            ],
            [
                'title' => 'نوشیدنی و قدم کوتاه',
                'place' => 'بعد از گرفتن نوشیدنی',
                'memory_date' => '2026-06-15',
                'description' => 'یه نوشیدنی بگیریم و چند دقیقه قدم بزنیم؛ اگر حوصله‌اش نبود همان نوشیدنی کافی است.',
                'image_path' => 'images/memories/walk.svg',
                'mood' => 'easy',
                'sort_order' => 4,
            ],
            [
                'title' => 'بردگیم کافه‌ای',
                'place' => 'کافه‌ای که بازی سبک داشته باشد',
                'memory_date' => '2026-06-15',
                'description' => 'یه بازی ساده که مکالمه را خشک نکند. بیشتر فان، کمتر رسمی.',
                'image_path' => 'images/memories/cafe-1.svg',
                'mood' => 'fun',
                'sort_order' => 5,
            ],
            [
                'title' => 'کافه وابی — جای عکس',
                'place' => 'همان جایی که دیدمت',
                'memory_date' => '2026-06-15',
                'description' => 'این کارت فقط رفرنس لوکیشن است تا بعداً عکس کافه وابی را همین‌جا اضافه کنم.',
                'image_path' => null,
                'mood' => 'reference',
                'sort_order' => 6,
            ],
        ];

        foreach ($plans as $plan) {
            Memory::create($plan);
        }
    }
}
