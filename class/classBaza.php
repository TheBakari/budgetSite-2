<?php
class Baza{
    private $server="localhost";
    private $username="root";
    private $password="";
    private $database="kuvar2";
    private $db;

    public function connect(){
        $this->db=@mysqli_connect($this->server, $this->username, $this->password, $this->database);
        if(!$this->db)
            return false;
        $this->query("SET NAMES UTF8");
        return $this->db;
    }

    public function query($sql){
        return mysqli_query($this->db, $sql);
    }

    public function num_rows($rez){
        return mysqli_num_rows($rez);
    }

    public function fetch_object($rez){
        return mysqli_fetch_object($rez);
    }

    public function fetch_assoc($rez){
        return mysqli_fetch_assoc($rez);
    }
    public function fetch_row($rez){
        return mysqli_fetch_row($rez);
    }
    public function affected_rows(){//koliko redova je izmenjeno
        return mysqli_affected_rows($this->db);

    }
    public function insert_id(){//vraca koji je poslednji id vracen u bazy
            return mysqli_insert_id($this->db);
    }
    public function error(){// ako ima greka prilikom upita koja je greska
        return mysqli_error($this->db);
    }
    
    public function add_prod($header,$description,$categoryRecepta,$headTwoRecept, $descriptionTwoRecept,$Ingredients,$instruction )
    {
        $upit="INSERT INTO recept(headRecept,descriptionRecept,	category_idKategorije, headerTwoRecept,descriptionTwoRecept,ingredientsRecept,instructionRecept) VALUES ('{$header}','{$description}',{$categoryRecepta},'{$headTwoRecept}','{$descriptionTwoRecept}','{$Ingredients}','{$instruction}')";
        $this->db->query($upit);
    }
}
?>