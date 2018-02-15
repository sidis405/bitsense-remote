<?php

namespace App\Http\Middleware;

use Closure;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = $request->segment(1);

        if (!in_array($locale, config('app.locales'))) {
            $segments = $request->segments();
            $segments[0] = config('app.fallback_locale');

            $newUrl = implode('/', $segments);

            return redirect($newUrl);
        }

        app()->setLocale($locale);

        // dd("The lang middleware");
        return $next($request);
    }
}
