<?php

namespace App\Models;

use App\Core\DB;
use PDO;

class ApiKey
{
    public $user_id;

    public $token_key;

    public $period;

    public function __construct()
    {
        $this->user_id = (int)$_SESSION['user'];
    }

    public function getOneByToken($token_key)
    {
        $sql = 'SELECT * FROM api_keys WHERE token_key = ?';
        $query = DB::pdo()->prepare($sql);
        $query->execute([$token_key]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getTokenForUser()
    {
        $sql = 'SELECT * FROM api_keys WHERE user_id = ?';
        $query = DB::pdo()->prepare($sql);
        $query->execute([$this->user_id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function save()
    {
        $this->token_key = md5(time() + rand(10000, 99999) + $this->user_id);
        $sql = 'SELECT COUNT(*) FROM api_keys WHERE user_id = ?';
        $query = DB::pdo()->prepare($sql);
        $query->execute([$this->user_id]);
        if ((bool)$query->fetch(7)) {
            $sql = 'UPDATE api_keys 
                    SET token_key = :token_key, period = :period
                    WHERE user_id = :user_id LIMIT 1';
        } else {
            $sql = 'INSERT INTO api_keys (user_id, token_key, period) 
                    VALUES (:user_id, :token_key, :period)';
        }
        $query = DB::pdo()->prepare($sql);
        $query->execute([
            'user_id' => $this->user_id,
            'token_key' => $this->token_key,
            'period' => time() + 60 * 60,
        ]);
    }
}
