<?php

namespace App\Controllers;

use App\Models\{ApiKey, User};
use Flight;
use RefactorStudio\PhpArrayToXml\PhpArrayToXml;

class APIController
{
    public static function userlist()
    {
        $token = $_POST['key'];
        $responseType = $_POST['response_type']; //1 - XML, 2 - JSON
        $apiKey = (new ApiKey())->getOneByToken($token);
        if ($apiKey['token_key'] == $token && time() < $apiKey['period']) {
            $response = [
                'status' => 1,
                'data' => (new User())->getAll(),
            ];
        } else {
            $response = [
                'status' => 0,
                'error' => 'Ключ не действителен!',
            ];
        }
        switch ($responseType) {
            case 1: echo (new PhpArrayToXml)->toXmlString($response); break;
            case 2: Flight::json($response); break;
        }
    }

    public static function test()
    {
        $domain = $_SERVER['HTTP_HOST'];
        $params = [
            'key' => (new ApiKey)->getTokenForUser()['token_key'],
            'response_type' => $_GET['responce'],
        ];
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "http://$domain/api/users/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($params),
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;
    }
}
