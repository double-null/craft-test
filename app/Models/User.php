<?php

namespace App\Models;
use App\Core\DB;


class User
{
    public $id;

    private $data;

    public $errors = [];

    public function __construct($id = null)
    {
        if (!empty($id)) {
            $this->id = (int)$id;
        }
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function activate()
    {
        $sql = 'UPDATE users SET active = 1 WHERE id = ? LIMIT 1';
        $query = DB::pdo()->prepare($sql);
        $query->execute([$this->id]);
    }

    public function emailExist($email)
    {
        $sql = 'SELECT COUNT(*) FROM users WHERE email = ?';
        $query = DB::pdo()->prepare($sql);
        $query->execute([$email]);
        return (bool)$query->fetch(7);
    }

    public function getOneById()
    {
        $sql = 'SELECT * FROM users WHERE id = ?';
        $query = DB::pdo()->prepare($sql);
        $query->execute([$this->id]);
        return $query->fetch(2);
    }

    public function getAll($sort = 0)
    {
        $sql = 'SELECT * FROM users';
        switch ($sort) {
            case 1: $sql .= ' ORDER BY name ASC'; break;
            case 2: $sql .= ' ORDER BY email ASC'; break;
        }
        $query = DB::pdo()->prepare($sql);
        $query->execute();
        return $query->fetchAll(2);
    }

    public function isActive()
    {
        $sql = 'SELECT active FROM users WHERE id = ?';
        $query = DB::pdo()->prepare($sql);
        $query->execute([$this->id]);
        return (bool)$query->fetch(7);
    }

    public function save()
    {
        $sql = 'INSERT INTO users (name, email, password, photo, active) 
                  VALUES (:name, :email, :password, :photo, :active)';
        $query = DB::pdo()->prepare($sql);
        $query->execute([
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'password' => md5(md5($this->data['password'])),
            'photo' => 'default.jpg',
            'active' => 0,
        ]);
        return DB::pdo()->lastInsertId();
    }

    public function validate()
    {
        if (empty($this->data['name'])) {
            $this->errors['name'] = 'Имя не заполнено';
        }
        if (empty($this->data['email'])) {
            $this->errors['email'] = 'Поле E-mail не заполнено';
        } elseif (!filter_var($this->data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Поле E-mail введено не корректно';
        } elseif ($this->emailExist($this->data['email'])) {
            $this->errors['email'] = 'Введённый E-mail уже существует';
        }
        if (empty($this->data['password'])) {
            $this->errors['password'] = 'Пароль не заполнен';
        } elseif ($this->data['password'] != $this->data['repswd']) {
            $this->errors['password'] = 'Пароли не совпадают';
        }
        return (bool) !count($this->errors);
    }
}
