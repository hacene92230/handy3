<?php
namespace home;

use PDO;

class dashboard
{

    private $bdd = null;
    private $sql_dsn = null;
    private $sql_username = null;
    private $sql_password = null;

    public $error = null;
    public $membre = null;
    public $data = array();

    public function __construct($sql_dsn = null, $sql_username = null, $sql_password = null, $membre = null) {

        $this->sql_dsn = $sql_dsn;
        $this->sql_username = $sql_username;
        $this->sql_password = $sql_password;
        $this->membre = $membre;

    }

    private function ConnectToDb()
    {
        try {
            $options = array( PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', );
            $this->bdd = new PDO($this->sql_dsn, $this->sql_username, $this->sql_password, $options);
            return true;
        } catch (Exception $ex) {
            die("Erreur interne.");
        }
    }

    public function SearchInformations() {

        $this->ConnectToDb();
        $req = $this->bdd->prepare("SELECT country, sex, inscription_date FROM users WHERE firstname=:firstname");

        try {

            $req->execute(array('firstname' => addcslashes($this->membre, '%_')));

            if ($req->rowCount() != 0) {

                while ($data = $req->fetch()) {

                    $this->data['pays'] = $data['country'];
                    $this->data['sexe'] = $data['sex'];
                    $this->data['inscription_date'] = $data['inscription_date'];

                }

                return true;

            } else {
                $this->error = 'Aucun membre n\'as été trouvé avec ce prénom...';
                return false;
            }

        } catch(Exception $ex) {
            // $this->error = $ex->getMessage();
            return false;
            // die('Erreur interne;');
        }

    }

}