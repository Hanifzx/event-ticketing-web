<?php

use Carbon\Carbon;

if (!function_exists('format_date')) {
    /**
     * Format tanggal standar aplikasi (Selasa, 4 November 2025 • 14:00).
     */
    function format_date($date, string $format = 'l, d F Y • H:i'): string
    {
        if (!$date) return '-';
        return Carbon::parse($date)->locale('id')->translatedFormat($format);
    }
}

if (!function_exists('format_currency')) {
    /**
     * Format angka ke Rupiah (Rp 10.000).
     */
    function format_currency($amount): string
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}