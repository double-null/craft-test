<?php

namespace App\Controllers;

use App\Models\{ApiKey, User};
use Flight;

class ApiKeyController
{
    public static function generate()
    {
        $user = new User($_SESSION['user']);
        if ($user->isActive()) {
            if ($_GET['create'] == 1) {
                $newKey = new ApiKey;
                $newKey->save();
            }
            Flight::render('api_key/generate', [
                'key' => (new ApiKey)->getTokenForUser(),
            ]);
        }
    }
}
