<?php

if (!function_exists('generateRandomPassword')) {
    function generateRandomPassword($length = 12)
    {
        return substr(str_shuffle(
            str_repeat('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()', $length)
        ), 0, $length);
    }

    function getInitialAppPage()
    {
        return 'dashboard';
    }
}
