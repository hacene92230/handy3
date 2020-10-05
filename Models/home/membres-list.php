<?php
namespace home;

use PDO;

class membres_list
{

    private $bdd = null;
    private $sql_dsn = null;
    private $sql_username = null;
    private $sql_password = null;

    public $error = null;
    public $membres = array();

    public function __construct($sql_dsn = null, $sql_username = null, $sql_password = null) {

        $this->sql_dsn = $sql_dsn;
        $this->sql_username = $sql_username;
        $this->sql_password = $sql_password;

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

    public function SearchMembres() {

        if(time() - filemtime(CHEMIN_CACHE . 'membres_list.tmp') > 30) {

            $this->ConnectToDb();
            $req = $this->bdd->prepare('SELECT id, name, firstname, email, country, age, sex, DATE_FORMAT(inscription_date, \'Le %d/%m/%Y à %Hh%i\') AS inscription_date FROM users ORDER BY name');
            $req->execute();

            if ($req->rowCount() != 0) {

                while ($data = $req->fetch()) {

                    $membre = array(
                        'id'               => htmlspecialchars($data['id']),
                        'nom'              => htmlspecialchars($data['name']),
                        'prenom'           => htmlspecialchars($data['firstname']),
                        'email'            => htmlspecialchars($data['email']),
                        'pays'             => htmlspecialchars($data['country']),
                        'age'              => htmlspecialchars($data['age']),
                        'sexe'             => htmlspecialchars($data['sex']),
                        'date_inscription' => htmlspecialchars($data['inscription_date'])
                    );
                    array_push($this->membres, $membre);

                }

                file_put_contents(CHEMIN_CACHE . 'membres_list.tmp', serialize($this->membres));

                return true;

            }

        } else {
            $this->membres = unserialize(file_get_contents(CHEMIN_CACHE . 'membres_list.tmp'));
        }

        return false;

    }

}