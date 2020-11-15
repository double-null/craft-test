<?php

namespace App\Models;

use App\Core\DB;

class EmailMessage
{
    public static function generate($replaceArgs)
    {
        $sql = "SELECT title, message FROM email_templates 
                WHERE mark = 'activate_message' 
                LIMIT 1";
        $query = DB::pdo()->prepare($sql);
        $query->execute();
        $mailObject = $query->fetch(2);
        $mailObject['message'] = str_replace(
            array_keys($replaceArgs),
            $replaceArgs,
            $mailObject['message']
        );
        return $mailObject;
    }
}