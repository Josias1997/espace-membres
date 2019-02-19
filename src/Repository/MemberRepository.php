<?php
namespace Repository;

use Database\Connect;
use Entity\Members;

class MemberRepository {

    private $db;

    public function __construct()
    {
        $connection = new Connect();

        $this->db = $connection->getConnection();
    }

    public function findAll() {
        $query = $this->db->query("SELECT * from members");

        return $query->fetchAll();
    }

    public function findBy($attribute, $value) {
        $member = array();
        $query = null;
        switch($attribute)
        {
            case 'id':
                $query = $this->db->prepare("SELECT * from members WHERE id = ?");
            break;

            case 'pseudo':
                $query = $this->db->prepare("SELECT * from members WHERE pseudo = ?");
            break;

            case 'password':
                $query = $this->db->prepare("SELECT * from members WHERE pwd = ?");
            break;

            case 'email':
                $query = $this->db->prepare("SELECT * from members WHERE email = ?");
            break;
        }
        if ($query != null)
        {
            $query->bindValue(1, $value);
            $query->execute();
        }
        
        return $query->fetchAll();
    }

    public function update(Members $member) {

    }

    public function remove($id) {

    }

    public function insert(Members $member) {
        $query = $this->db->prepare("INSERT INTO members(pseudo, pwd, email, date_inscription) 
        VALUES (?, ?, ?, ?)");

        $query->bindValue(1, $member->getPseudo());
        $query->bindValue(2, $member->getPassword());
        $query->bindValue(3, $member->getEmail());
        $query->bindValue(4, $member->getDate_inscription());

        return $query->execute();
    }

}
?>