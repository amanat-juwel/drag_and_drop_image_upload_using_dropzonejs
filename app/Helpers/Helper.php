<?php

namespace App\Helpers;

class Helper
{
    public static function diffForHumans($date)
    {
        return \Carbon\Carbon::parse($date)->diffForHumans();
    }
}