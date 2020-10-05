<?php
namespace home;

use PDO;

class inscription
{

    private $bdd = null;
    private $sql_dsn = null;
    private $sql_username = null;
    private $sql_password = null;
    private $post = null;
    private $password = null;
    private $password_confirm = null;

    public  $error = null;
    public  $name = null;
    public  $firstname = null;
    public  $email = null;
    public  $sexe = null;
    public  $pays = null;
    public  $age = null;

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

    public function VerifyUsersBan() {

        $users_ban = unserialize(file_get_contents(CHEMIN_DATA . 'users_ban.tmp'));
	if(!empty($users_ban)){
        foreach($users_ban as $ip_ban) {
            if($ip_ban == $_SERVER["REMOTE_ADDR"]) {
                $this->error = 'Vous avez été banni par l\'équipe du site. Impossible de vous inscrire ou de vous connecter...';
                return false;
            }
        }
	}
        return true;

    }

    public function StoreNewUser() {

        $this->ConnectToDb();
        $req = $this->bdd->query("SELECT email FROM users WHERE email='{$this->email}'");

        if(empty($req->fetchAll())) {

            $req = $this->bdd->prepare("INSERT INTO users(name, firstname, email, country, age, sex, password, ip) VALUES(:name, :firstname, :email, :country, :age, :sex, :password, :ip)");

            try {

                $req->execute(array(
                    'name'      => addcslashes($this->name, '%_'),
                    'firstname' => addcslashes($this->firstname, '%_'),
                    'email'     => addcslashes($this->email, '%_'),
                    'country'   => addcslashes($this->pays, '%_'),
                    'age'       => addcslashes($this->age, '%_'),
                    'sex'       => addcslashes($this->sexe, '%_'),
                    'password'  => password_hash($this->password, PASSWORD_DEFAULT),
                    'ip'        => $_SERVER["REMOTE_ADDR"]
                ));
                return true;

            } catch(Exception $ex) {
                // $this->error = $ex->getMessage();
                return false;
                // die('Erreur interne;');
            }

            } else {
                $this->error = "Un utilisateur éxiste déjà pour cette addresse email.";
                return false;
            }

    }

    public function IsAlphaNum() {

        if(!preg_match('/[a-zA-Z_0-9]{3,30}/i', $this->name) OR !preg_match('/[a-zA-Z_0-9]{3,30}/i', $this->firstname)) {
            $this->error = 'Votre nom et votre prénom doivent uniquement être composés de lettres simples et de chiffres. Il doivent également comporter 3 caractères au minimums.';
            return false;
        } else {
            return true;
        }

    }

    public function DataPost()
    {

        if (!empty($this->post['name'])) {

            if (!empty($this->post['firstname'])) {

                if (!empty($this->post['email']) AND filter_var($this->post['email'], FILTER_VALIDATE_EMAIL)) {

                    if (!empty($this->post['pays'])) {

                        if (!empty($this->post['age'])) {

                            if (!empty($this->post['sexe'])) {

                                if (!empty($this->post['password'])) {

                                    if (!empty($this->post['confirm_cgu']) && $this->post['confirm_cgu'] == 'Oui') {

                                        if (!empty($this->post['password_confirm']) && $this->post['password_confirm'] == $this->post['password']) {

                                                $this->password = $this->post['password'];
                                                $this->password_confirm = $this->post['password_confirm'];
                                                $this->name = $this->post['name'];
                                                $this->firstname = $this->post['firstname'];
                                                $this->email = $this->post['email'];
                                                $this->sexe = $this->post['sexe'];
                                                $this->pays = $this->post['pays'];
                                                $this->age = $this->post['age'];

                                                unset($_POST['email']);
                                                unset($_POST['password']);
                                                unset($_POST['password_confirm']);

                                                return true;

                                        } else {
                                            $this->error = "La confirmation de votre mot de passe n'as pas été renseignée ou elle est invalide.";
                                            return false;
                                        }

                                    } else {
                                        $this->error = "Les conditions générales d'utilisations n'ont pas été acceptées.";
                                        return false;
                                    }

                                } else {
                                    $this->error = "Votre mot de passe n'as pas été renseigné.";
                                    return false;
                                }

                            } else {
                                $this->error = "Votre sexe n'as pas été renseigné.";
                                return false;
                            }

                        } else {
                            $this->error = "Votre âge n'as pas été renseigné.";
                            return false;
                        }

                    } else {
                        $this->error = "Votre pays n'as pas été renseigné.";
                        return false;
                    }

                } else {
                    $this->error = "Votre addresse email n'as pas été renseignée ou semble invalide.";
                    return false;
                }

            } else {
                $this->error = "Votre prénom n'as pas été renseigné.";
                return false;
            }

        } else {
            $this->error = "Votre Nom de famille n'as pas été renseigné.";
            return false;
        }

    }

}
