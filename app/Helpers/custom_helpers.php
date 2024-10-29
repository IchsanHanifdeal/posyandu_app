<?php

if (!function_exists('calculateMeanWeightForAge')) {
    function calculateMeanWeightForAge($usia_bulan, $jenis_kelamin) {
        // Placeholder: Replace with actual WHO median weight values based on the child's age and gender
        // Example logic
        if ($jenis_kelamin == 'Laki-laki') {
            return 9 + ($usia_bulan * 0.3);  // Approximation for boys
        } else {
            return 8.5 + ($usia_bulan * 0.28);  // Approximation for girls
        }
    }
}

if (!function_exists('calculateSDWeightForAge')) {
    function calculateSDWeightForAge($usia_bulan, $jenis_kelamin) {
        // Placeholder: Replace with actual WHO SD values for weight-for-age based on the child's age and gender
        return 1.5;  // Example: Standard deviation placeholder
    }
}

if (!function_exists('calculateMeanHeightForAge')) {
    function calculateMeanHeightForAge($usia_bulan, $jenis_kelamin) {
        // Placeholder: Replace with actual WHO median height values based on the child's age and gender
        if ($jenis_kelamin == 'Laki-laki') {
            return 75 + ($usia_bulan * 1.2);  // Approximation for boys
        } else {
            return 74 + ($usia_bulan * 1.1);  // Approximation for girls
        }
    }
}

if (!function_exists('calculateSDHeightForAge')) {
    function calculateSDHeightForAge($usia_bulan, $jenis_kelamin) {
        // Placeholder: Replace with actual WHO SD values for height-for-age based on the child's age and gender
        return 2;  // Example: Standard deviation placeholder
    }
}

if (!function_exists('calculateMeanWeightForHeight')) {
    function calculateMeanWeightForHeight($tinggi_saat_ini, $jenis_kelamin) {
        // Placeholder: Replace with actual WHO median weight-for-height based on the child's height and gender
        return 12 + (($tinggi_saat_ini - 85) * 0.5);  // Example logic
    }
}

if (!function_exists('calculateSDWeightForHeight')) {
    function calculateSDWeightForHeight($tinggi_saat_ini, $jenis_kelamin) {
        // Placeholder: Replace with actual WHO SD values for weight-for-height
        return 1.2;  // Example standard deviation
    }
}
