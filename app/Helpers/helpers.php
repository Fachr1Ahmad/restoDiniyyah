<?php

if (!function_exists('format_date')) {
    /**
     * Format tanggal menjadi format yang lebih mudah dibaca.
     *
     * @param string $date
     * @return string
     */
    function format_date($date)
    {
        return \Carbon\Carbon::parse($date)->format('d F Y');
    }
}
