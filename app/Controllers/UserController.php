<?php

namespace App\Controllers;

use App\Core\Mailer;
use App\Models\{User, ActivationCode, EmailMessage};
use Flight;


class UserController
{
    /*
     * Регистрация
    */
    public static function registration()
    {
        $_SESSION['csrf_token'] = md5(uniqid(mt_rand() . microtime()));
        Flight::render('user/registration');
    }

    /**
     * Регистрации с использованием AJAX
     */
    public static function asyncReg()
    {
        if (!empty($_POST)) {
            $user = new User();
            $user->setData($_POST['User']);
            if($_SESSION['csrf_token'] !== $_POST['csrf_token']) {
                $csrfError = 1;
            }
            if (strtolower($_POST['code']) != $_SESSION['code']) {
                $captchaError = 1;
            }
            if ($user->validate() && !$captchaError && !$csrfError) {
                $user_id = $user->save();
                $activationCode = new ActivationCode();
                $activationCode->user_id = $user_id;
                $activationCode->create();
                $_SESSION['user'] = $user_id;
                $emailObject = EmailMessage::generate([
                    ':domain:' => $_SERVER['HTTP_HOST'],
                    ':user:' =>  $user_id,
                    ':code:' => $activationCode->code,
                ]);
                Mailer::send($_POST['User']['email'], $emailObject['title'], $emailObject['message']);
                $response = ['status' => 1];
            } else {
                $response = [
                    'status' => 0,
                    'errors' => $user->errors,
                    'code_error' => $captchaError,
                ];
            }
            Flight::json($response);
        }
    }

    /**
     * Активация аккаунта
     */
    public static function activation()
    {
        if (!empty($_GET['code']) && !empty($_GET['user'])) {
            $activationCode = new ActivationCode();
            $activationCode->user_id = (int)$_GET['user'];
            $activationCode->code = $_GET['code'];
            if ($activationCode->checkCode()) {
                $activationCode->delete();
                $user = new User($_GET['user']);
                $user->activate();
                Flight::redirect('/user_listing/');
            }
        }
    }

    /**
     * Список пользователей
     */
    public static function listing()
    {
        $user = new User($_SESSION['user']);
        if ($user->isActive()) {
            $sort = (int)$_GET['sort'];
            Flight::render('user/listing', ['users' => $user->getAll($sort)]);
        } else {
            echo "Активируйте аккаунт!";
        }
    }
}
