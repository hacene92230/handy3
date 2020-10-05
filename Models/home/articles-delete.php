<?php
namespace home;

use PDO;

class articles_delete
{

    private $bdd = null;
    private $sql_dsn = null;
    private $sql_username = null;
    private $sql_password = null;

    public $error = null;
    public $id = null;

    public function __construct($sql_dsn = null, $sql_username = null, $sql_password = null, $id = 1) {

        $this->sql_dsn = $sql_dsn;
        $this->sql_username = $sql_username;
        $this->sql_password = $sql_password;
        $this->id = $id;

    }

    private function ConnectToDb() {
        try {
            $options = array( PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', );
            $this->bdd = new PDO($this->sql_dsn, $this->sql_username, $this->sql_password, $options);
            return true;
        } catch (Exception $ex) {
            die("Erreur interne.");
        }
    }

    public function DeleteArticle() {

        $this->ConnectToDb();
        try {
            $req = $this->bdd->prepare("DELETE FROM articles WHERE id=:id");
            $req->execute(array('id' => $this->id));
        } catch (Exception $ex) {
            die("Cet article ne semble pas éxister...");
        }

        return true;

    }

}