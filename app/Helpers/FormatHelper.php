<?php

use Carbon\Carbon;

if (!function_exists('format_date')) {
    /**
     * Format khusus Tanggal (Contoh: Selasa, 4 November 2025).
     */
    function format_date($date, string $format = 'l, d F Y'): string
    {
        if (!$date) return '-';
        return Carbon::parse($date)->locale('id')->translatedFormat($format);
    }
}

if (!function_exists('format_time')) {
    /**
     * Format khusus Waktu 24 Jam (Contoh: 14:30).
     */
    function format_time($date, string $format = 'H:i'): string
    {   
        if (!$date) return '-';
        return Carbon::parse($date)->locale('id')->format($format);
    }
}

if (!function_exists('format_rupiah')) {
    /**
     * Format angka ke Rupiah (Rp 19.000.000).
     */
    function format_rupiah($amount): string
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}