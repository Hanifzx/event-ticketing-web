<?php

if (!function_exists('get_status_badge_class')) {
    /**
     * Mengembalikan class Tailwind untuk badge status (User/Event).
     */
    function get_status_badge_class(string $status): string
    {
        return match (strtolower($status)) {
            'approved', 'active', 'paid' => 'bg-green-100 text-green-800',
            'rejected', 'canceled'       => 'bg-red-100 text-red-800',
            'pending', 'waiting'         => 'bg-yellow-100 text-yellow-800',
            default                      => 'bg-gray-100 text-gray-800',
        };
    }
}

if (!function_exists('get_role_badge_class')) {
    /**
     * Mengembalikan class Tailwind untuk badge role user.
     */
    function get_role_badge_class(string $role): string
    {
        return match (strtolower($role)) {
            'admin'     => 'bg-purple-100 text-purple-800',
            'organizer' => 'bg-blue-100 text-blue-800',
            'user'      => 'bg-gray-100 text-gray-800',
            default     => 'bg-gray-100 text-gray-800',
        };
    }
}