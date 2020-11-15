<?php

namespace App\Controllers;

use Royfj\Captcha\Builder;

class CaptchaController
{
    public static function index()
    {
        $captcha = new Builder();
        $_SESSION['code'] = $captcha->getCode();
        $captcha->output();
    }
}
