<?php

namespace App\Http\Middleware;

use App\Models\Visit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class TrackVisitor
{
    public function handle(Request $request, Closure $next): Response
    {
        if (config('rozhi.track_visits') && $request->isMethod('GET') && ! $request->is('build/*')) {
            try {
                Visit::create([
                    'path' => '/'.ltrim($request->path(), '/'),
                    'session_id' => $request->hasSession() ? $request->session()->getId() : null,
                    'ip_hash' => hash_hmac('sha256', (string) $request->ip(), (string) config('app.key')),
                    'user_agent' => str((string) $request->userAgent())->limit(250),
                    'visited_at' => now(),
                ]);
            } catch (Throwable) {
                // Ignore tracking errors so the invite page stays available on minimal PHP hosts.
            }
        }

        return $next($request);
    }
}
