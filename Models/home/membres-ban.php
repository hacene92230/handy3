<?php
namespace home;

use PDO;

class membres_ban
{

    private $bdd = null;
    private $sql_dsn = null;
    private $sql_username = null;
    private $sql_password = null;

    public $id = null;
    public $ip = null;

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

    public function SearchIp() {

        $this->ConnectToDb();
        try {

            $req = $this->bdd->prepare("SELECT ip, rank FROM users WHERE id=:id");
            $req->execute(array('id' => $this->id));
            $this->ip = $req->fetchAll();

            if(empty($this->ip[0])) {
                return false;
            } elseif($this->ip[0]['rank'] == 100) {
                return false;
            }

        } catch (Exception $ex) {
            die('Erreur interne.');
            return false;
        }

        return true;

    }

    public function BanUser() {

        $users_ban = unserialize(file_get_contents(CHEMIN_DATA . 'users_ban.tmp'));

        $key = array_search($this->ip[0]['ip'], $users_ban);
        if($key == false) {
            if(!isset($users_ban[0])) {
                array_push($users_ban, $this->ip[0]['ip']);
            }
        }

        file_put_contents(CHEMIN_DATA . 'users_ban.tmp', serialize($users_ban));

        return true;

    }

}