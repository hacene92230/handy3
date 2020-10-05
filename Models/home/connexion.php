<?php
namespace home;

use PDO;

class connexion
{

    private $bdd = null;
    private $sql_dsn = null;
    private $sql_username = null;
    private $sql_password = null;
    private $post = null;

    public  $password = null;
    public  $email = null;
    public  $name = null;
    public  $firstname = null;
    public  $inscription_date = null;
    public  $rank = null;
    public  $sexe = null;
    public  $country = null;
    public  $age = null;
    public  $id = null;
    public  $error = null;

    public function __construct($sql_dsn = null, $sql_username = null, $sql_password = null) {

        $this->post = $_POST;
        $this->sql_dsn = $sql_dsn;
        $this->sql_username = $sql_username;
        $this->sql_password = $sql_password;

    }

    public function UserIsBan() {

        $users_ban = unserialize(file_get_contents(CHEMIN_DATA . 'users_ban.tmp'));
        if(!empty($users_ban)){
        foreach($users_ban as $ip) {
            if($ip == $_SERVER['REMOTE_ADDR']) {
                return true;
            }
        }
}
        return false;

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

    public function DataCorrect() {

        $this->ConnectToDb();
        $req = $this->bdd->query("SELECT * FROM users WHERE email='{$this->email}'");

        if ($req->rowCount() != 0) {

            while ($data = $req->fetch()) {

                if (password_verify($this->password, $data['password'])) {

                    $this->id = $data['id'];
                    $this->name = $data['name'];
                    $this->firstname = $data['firstname'];
                    $this->country = $data['country'];
                    $this->age = $data['age'];
                    $this->sexe = $data['sex'];
                    $this->inscription_date = $data['inscription_date'];
                    $this->rank = $data['rank'];

                    return true;

                } else {
                    $this->error = 'Votre identifiant ou votre mot de passe semble invalide';
                    return false;
                }

            }
        } else {
            $this->error = 'Votre identifiant ou votre mot de passe semble invalide';
            return false;
        }

        return false;

    }

    public function DataPost() {

        if (!empty($this->post['email'])) {

            if (!empty($this->post['password'])) {

                $this->password = $this->post['password'];
                $this->email = $this->post['email'];

                unset($_POST['email']);
                unset($_POST['password']);

                return true;


            } else {
                $this->error = "Votre mot de passe n'as pas été renseigné.";
                return false;
            }

        } else {
            $this->error = "Votre addresse email n'as pas été renseignée.";
            return false;
        }

    }

}
