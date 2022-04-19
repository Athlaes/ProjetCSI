<?php 
class PdoDrive {
    private static $monPdo;
    private static $monPdoDrive;

    private function __construct(){
        try {
            $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''); 
            $monPdo = new PDO(DSN, DB_USER, DB_PWD, $options);
            $monPdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function __destruct(){
        $monPdo = null;
    }

    public static function getPdoDrive(){
        if(PdoDrive::$monPdoDrive == null){
            PdoDrive::$monPdoDrive = new PdoDrive();
        }
        return PdoDrive::$monPdoDrive;
    }

    public static function ajouterUtilisateur($user){
        try{
            $requete->$monPdo->prepare('');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}