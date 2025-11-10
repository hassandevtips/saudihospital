<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Language;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get locale from session or use default
        $locale = session('locale');

        if (!$locale) {
            try {
                $defaultLanguage = Language::getDefault();
                $locale = $defaultLanguage ? $defaultLanguage->code : config('app.locale', 'en');
            } catch (\Exception $e) {
                $locale = config('app.locale', 'en');
            }
        }

        // Verify the language exists and is active
        try {
            $language = Language::where('code', $locale)
                ->where('is_active', true)
                ->first();

            if ($language) {
                app()->setLocale($locale);
            } else {
                // Fallback to default locale
                $defaultLanguage = Language::getDefault();
                $locale = $defaultLanguage ? $defaultLanguage->code : config('app.locale', 'en');
                app()->setLocale($locale);
                session(['locale' => $locale]);
            }
        } catch (\Exception $e) {
            // If database is not available or table doesn't exist, use config default
            $locale = config('app.locale', 'en');
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
