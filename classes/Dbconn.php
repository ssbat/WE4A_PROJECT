<?php
class Dbconn{
    private const USER='root';
    private const PASSWD='';
    private const SERVER='localhost';
    private const BASE='users_projet';
    public $conn=NULL;
    public $connSuccessful=[NULL,NULL];
    public function __construct()
    {
        $dsn="mysql:dbname=".$this::BASE.";host=".$this::SERVER;
        try{
            $connect=new PDO($dsn,$this::USER,$this::PASSWD);
            $this->conn=$connect;
            $this->connSuccessful=[true,"done"];
            //printf($conn->query('SELECT * FROM personne'));
        }
        catch (PDOException $e){
            
            $this->connSuccessful=[false,"ECHEC DE connexion avec la BD,à voir La class Dbconn "];
            // printf("ECHEC DE connexion %s\n",$e->getMessage());
            // exit();

        }   
        // printf("HI");
    }
}
    
function SecurizeString($string) {
    $string = trim($string);
    $string = stripcslashes($string);
    $string = addslashes($string);
    $string = htmlspecialchars($string);
    return $string;
}

?>