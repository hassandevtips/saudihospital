<?php

if (!function_exists('gt')) {
    /**
     * Get a general translation by key.
     * 
     * @param string $key The translation key
     * @param string|null $default The default value if translation not found
     * @param string|null $locale The locale to use (defaults to current locale)
     * @return string|null
     */
    function gt(string $key, ?string $default = null, ?string $locale = null): ?string
    {
        return \App\Models\GeneralTranslation::get($key, $locale, $default);
    }
}

if (!function_exists('gt_group')) {
    /**
     * Get all general translations by group.
     * 
     * @param string $group The group name
     * @param string|null $locale The locale to use (defaults to current locale)
     * @return array
     */
    function gt_group(string $group, ?string $locale = null): array
    {
        return \App\Models\GeneralTranslation::getByGroup($group, $locale);
    }
}

