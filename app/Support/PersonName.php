<?php

namespace App\Support;

/** One place that decides how a person's name is written, so every screen shows it the same way. */
final class PersonName
{
    /** "Juan D. Cruz Jr." (middle name shortened to an initial). */
    public static function full(?string $first, ?string $middle, ?string $last, ?string $suffix = null): string
    {
        $middle = trim((string) $middle);

        $parts = [
            trim((string) $first),
            $middle !== '' ? mb_strtoupper(mb_substr($middle, 0, 1)) . '.' : '',
            trim((string) $last),
            trim((string) $suffix),
        ];

        return implode(' ', array_filter($parts, fn(string $part) => $part !== ''));
    }

    /** "Juan Cruz Jr." (used as the name of a login account). */
    public static function short(?string $first, ?string $last, ?string $suffix = null): string
    {
        return self::full($first, null, $last, $suffix);
    }
}
