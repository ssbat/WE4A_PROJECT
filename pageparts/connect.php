<?php 
    define('USER', 'root');
    define('PASSWD', '');
    define('SERVER', 'localhost');
    define('BASE', 'users_projet');//constante
    function connect_db()
    {
        $dsn="mysql:dbname=".BASE.";host=".SERVER;
        try{
            $conn=new PDO($dsn,USER,PASSWD);
            //printf($conn->query('SELECT * FROM personne'));
        }
        catch (PDOException $e){
            printf("ECHEC DE connexion %s\n",$e->getMessage());
            exit();

        }   
        // printf("HI");
        return $conn;
    }
?>