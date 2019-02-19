<?php
namespace Members_space\Database;

class Connect {
    private $db;

    public function getConnection() {
        $db = null;
        try {
    
            $db = new PDO("mysql:host=localhost;dbname=members_space;charset=utf8", 'root', '');
        }
        catch(Exception $e)
        {
            die('Error : '.$e->getMessage());
        }
        return $db;
    }
}
?>