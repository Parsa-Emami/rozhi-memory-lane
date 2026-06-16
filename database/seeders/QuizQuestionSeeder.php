<?php

namespace Database\Seeders;

use App\Models\QuizQuestion;
use Illuminate\Database\Seeder;

class QuizQuestionSeeder extends Seeder
{
    public function run(): void
    {
        QuizQuestion::query()->delete();

        $questions = [
            [
                'question' => 'اول برنامه چه وایبی بهتره؟',
                'options' => [
                    ['text' => 'خیلی ساده؛ یه قهوه کوتاه', 'score' => 2],
                    ['text' => 'یه چیز متفاوت‌تر، مثل گیتار', 'score' => 4],
                    ['text' => 'یه مسیر کوتاه و بیرون از شهر', 'score' => 6],
                ],
                'sort_order' => 1,
            ],
            [
                'question' => 'چقدر زمان برای برنامه خوبه؟',
                'options' => [
                    ['text' => 'کم و جمع‌وجور', 'score' => 2],
                    ['text' => 'متوسط؛ نه خیلی کوتاه نه طولانی', 'score' => 4],
                    ['text' => 'چند ساعت برای مسیر روزانه اوکیه', 'score' => 6],
                ],
                'sort_order' => 2,
            ],
            [
                'question' => 'برنامه چقدر خاص باشد؟',
                'options' => [
                    ['text' => 'کلاسیک و تمیز', 'score' => 2],
                    ['text' => 'کمی خاص و موزیکال', 'score' => 4],
                    ['text' => 'خاص‌تر و ماجراجویانه‌تر', 'score' => 6],
                ],
                'sort_order' => 3,
            ],
            [
                'question' => 'آخرش چه چیزی بهتره؟',
                'options' => [
                    ['text' => 'همان قهوه کافی است', 'score' => 2],
                    ['text' => 'قهوه بعد از گیتار', 'score' => 4],
                    ['text' => 'قهوه بعد از رودتریپ کوتاه', 'score' => 6],
                ],
                'sort_order' => 4,
            ],
            [
                'question' => 'کدام جمله بیشتر به مودت می‌خورد؟',
                'options' => [
                    ['text' => 'آروم و ساده شروع کنیم', 'score' => 2],
                    ['text' => 'یه وایب متفاوت داشته باشه', 'score' => 4],
                    ['text' => 'یه مسیر کوتاه و خاطره‌ساز باشه', 'score' => 6],
                ],
                'sort_order' => 5,
            ],
        ];

        foreach ($questions as $question) {
            QuizQuestion::create($question);
        }
    }
}
