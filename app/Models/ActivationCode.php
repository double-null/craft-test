<?php

namespace App\Models;

use App\Core\DB;
use PDO;

class ActivationCode
{
    public $user_id;

    public $code;

    public function create()
    {
        $this->code = substr(md5($this->user_id.rand(10000, 99999)),0, 16);
        $sql = 'INSERT INTO activation_codes (user_id, code) 
                  VALUES (:user_id, :code)';
        $query = DB::pdo()->prepare($sql);
        $query->execute([
            'user_id' => $this->user_id,
            'code' => $this->code,
        ]);
    }

    public function checkCode()
    {
        $sql = 'SELECT COUNT(*) FROM activation_codes 
                  WHERE code = ? AND user_id = ?';
        $query = DB::pdo()->prepare($sql);
        $query->execute([$this->code, $this->user_id]);
        return (bool)$query->fetch(PDO::FETCH_COLUMN);
    }

    public function delete()
    {
        $sql = 'DELETE FROM activation_codes WHERE code = ? AND user_id = ?';
        $query = DB::pdo()->prepare($sql);
        $query->execute([$this->code, $this->user_id]);
    }
}
