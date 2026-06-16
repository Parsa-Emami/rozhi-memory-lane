<?php

namespace App\Http\Controllers;

use App\Models\LetterReply;
use App\Models\Memory;
use App\Models\QuizQuestion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Throwable;

class PageController extends Controller
{
    public function home(): View
    {
        return view('pages.home', [
            'featuredMemories' => $this->planItems()
                ->where('is_featured', true)
                ->sortBy('sort_order')
                ->take(3)
                ->values(),
        ]);
    }

    public function story(): View
    {
        return view('pages.story', [
            'memories' => $this->planItems(),
        ]);
    }

    public function memories(): View
    {
        return view('pages.memories', [
            'memories' => $this->planItems(),
        ]);
    }

    public function quiz(): View
    {
        $questions = $this->quizQuestions();

        $quizPayload = $questions->map(function ($question) {
            return [
                'id' => $question->id,
                'question' => $question->question,
                'options' => $question->options ?? [],
            ];
        })->values();

        return view('pages.quiz', [
            'questions' => $questions,
            'quizPayload' => $quizPayload,
        ]);
    }

    public function letter(Request $request): View
    {
        return view('pages.letter', [
            'unlocked' => (bool) $request->session()->get('letter_unlocked', false),
        ]);
    }

    public function unlockLetter(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'password' => ['required', 'string', 'max:120'],
        ]);

        $expected = (string) config('rozhi.letter_password');

        if (! hash_equals($expected, $data['password'])) {
            return back()
                ->withErrors(['password' => 'رمز درست نیست؛ رمز پیش‌فرض coffee است.'])
                ->withInput();
        }

        $request->session()->put('letter_unlocked', true);

        return redirect()->route('letter')->with('status', 'یادداشت باز شد.');
    }

    public function storeLetterReply(Request $request): RedirectResponse
    {
        abort_unless((bool) $request->session()->get('letter_unlocked', false), 403);

        $data = $request->validate([
            'nickname' => ['nullable', 'string', 'max:80'],
            'mood' => ['nullable', 'string', 'max:80'],
            'answer' => ['required', 'string', 'min:3', 'max:3000'],
        ]);

        try {
            LetterReply::create([
                'nickname' => $data['nickname'] ?? null,
                'mood' => $data['mood'] ?? null,
                'answer' => $data['answer'],
                'ip_hash' => hash_hmac('sha256', (string) $request->ip(), (string) config('app.key')),
            ]);
        } catch (Throwable) {
            // The UI should still work even on hosts without an enabled database driver.
        }

        return back()->with('status', 'جواب ذخیره شد.');
    }

    public function future(): View
    {
        return view('pages.future');
    }

    public function invite(): View
    {
        return view('pages.invite');
    }

    private function planItems(): Collection
    {
        try {
            return Memory::query()->orderBy('sort_order')->get();
        } catch (Throwable) {
            return collect($this->fallbackMemories())->map(fn (array $item) => (object) $item);
        }
    }

    private function quizQuestions(): Collection
    {
        try {
            return QuizQuestion::query()->orderBy('sort_order')->get();
        } catch (Throwable) {
            return collect($this->fallbackQuestions())->map(fn (array $item) => (object) $item);
        }
    }

    private function fallbackMemories(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'قهوه کوتاه',
                'place' => 'یک کافه خلوت و جمع‌وجور',
                'memory_date' => Carbon::parse('2026-06-15'),
                'description' => 'Rozhi، بیا یه قهوه کوتاه بزنیم. ساده و جمع‌وجور؛ زمان و جاش رو خودت راحت‌تر بودی انتخاب کن.',
                'image_path' => null,
                'mood' => 'coffee',
                'sort_order' => 1,
                'is_featured' => true,
            ],
            [
                'id' => 2,
                'title' => 'گیتار زدن',
                'place' => 'یک گوشه آرام با وایب خوب',
                'memory_date' => Carbon::parse('2026-06-15'),
                'description' => 'یه پیشنهاد ساده: یه جای آروم بریم، من یه قطعه کوتاه با گیتار بزنم، بعدش قهوه. بدون اجرای سنگین و شلوغ‌کاری.',
                'image_path' => 'images/memories/music.svg',
                'mood' => 'guitar',
                'sort_order' => 2,
                'is_featured' => true,
            ],
            [
                'id' => 3,
                'title' => 'رودتریپ کوتاه',
                'place' => 'مسیر امن، روزانه، برگشت همان روز',
                'memory_date' => Carbon::parse('2026-06-15'),
                'description' => 'اگه حسش رو داشتی یه رودتریپ کوتاه روزانه بریم؛ مسیر سبک، رفت‌وبرگشت همان روز، بعدش قهوه.',
                'image_path' => 'images/memories/night.svg',
                'mood' => 'road',
                'sort_order' => 3,
                'is_featured' => true,
            ],
            [
                'id' => 4,
                'title' => 'نوشیدنی و قدم کوتاه',
                'place' => 'بعد از گرفتن نوشیدنی',
                'memory_date' => Carbon::parse('2026-06-15'),
                'description' => 'یه نوشیدنی بگیریم و چند دقیقه قدم بزنیم؛ اگر حوصله‌اش نبود همان نوشیدنی کافی است.',
                'image_path' => 'images/memories/walk.svg',
                'mood' => 'easy',
                'sort_order' => 4,
                'is_featured' => false,
            ],
            [
                'id' => 5,
                'title' => 'بردگیم کافه‌ای',
                'place' => 'کافه‌ای که بازی سبک داشته باشد',
                'memory_date' => Carbon::parse('2026-06-15'),
                'description' => 'یه بازی ساده که مکالمه را خشک نکند. بیشتر فان، کمتر رسمی.',
                'image_path' => 'images/memories/cafe-1.svg',
                'mood' => 'fun',
                'sort_order' => 5,
                'is_featured' => false,
            ],
            [
                'id' => 6,
                'title' => 'کافه وابی — جای عکس',
                'place' => 'همان جایی که دیدمت',
                'memory_date' => Carbon::parse('2026-06-15'),
                'description' => 'این کارت فقط رفرنس لوکیشن است تا بعداً عکس کافه وابی را همین‌جا اضافه کنم.',
                'image_path' => null,
                'mood' => 'reference',
                'sort_order' => 6,
                'is_featured' => false,
            ],
        ];
    }

    private function fallbackQuestions(): array
    {
        return [
            [
                'id' => 1,
                'question' => 'اول برنامه چه وایبی بهتره؟',
                'options' => [
                    ['text' => 'خیلی ساده؛ یه قهوه کوتاه', 'score' => 2],
                    ['text' => 'یه چیز متفاوت‌تر، مثل گیتار', 'score' => 4],
                    ['text' => 'یه مسیر کوتاه و بیرون از شهر', 'score' => 6],
                ],
                'sort_order' => 1,
            ],
            [
                'id' => 2,
                'question' => 'چقدر زمان برای برنامه خوبه؟',
                'options' => [
                    ['text' => 'کم و جمع‌وجور', 'score' => 2],
                    ['text' => 'متوسط؛ نه خیلی کوتاه نه طولانی', 'score' => 4],
                    ['text' => 'چند ساعت برای مسیر روزانه اوکیه', 'score' => 6],
                ],
                'sort_order' => 2,
            ],
            [
                'id' => 3,
                'question' => 'برنامه چقدر خاص باشد؟',
                'options' => [
                    ['text' => 'کلاسیک و تمیز', 'score' => 2],
                    ['text' => 'کمی خاص و موزیکال', 'score' => 4],
                    ['text' => 'خاص‌تر و ماجراجویانه‌تر', 'score' => 6],
                ],
                'sort_order' => 3,
            ],
            [
                'id' => 4,
                'question' => 'آخرش چه چیزی بهتره؟',
                'options' => [
                    ['text' => 'همان قهوه کافی است', 'score' => 2],
                    ['text' => 'قهوه بعد از گیتار', 'score' => 4],
                    ['text' => 'قهوه بعد از رودتریپ کوتاه', 'score' => 6],
                ],
                'sort_order' => 4,
            ],
            [
                'id' => 5,
                'question' => 'کدام جمله بیشتر به مودت می‌خورد؟',
                'options' => [
                    ['text' => 'آروم و ساده شروع کنیم', 'score' => 2],
                    ['text' => 'یه وایب متفاوت داشته باشه', 'score' => 4],
                    ['text' => 'یه مسیر کوتاه و خاطره‌ساز باشه', 'score' => 6],
                ],
                'sort_order' => 5,
            ],
        ];
    }
}
