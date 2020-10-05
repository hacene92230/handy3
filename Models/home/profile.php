<?php
namespace home;

use PDO;

class profile
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

    public function UpdateProfile() {

        $this->ConnectToDb();
        $req = $this->bdd->prepare("UPDATE users SET name=:name, firstname=:firstname, email=:email, country=:country, age=:age, sex=:sexe WHERE id=:id");

        try {

            $req->execute(array(
                'name'      => addcslashes($this->name, '%_'),
                'firstname' => addcslashes($this->firstname, '%_'),
                'email'     => addcslashes($this->email, '%_'),
                'country'   => addcslashes($this->pays, '%_'),
                'age'       => addcslashes($this->age, '%_'),
                'sexe'      => addcslashes($this->sexe, '%_'),
                'id'        => $_SESSION['id']
            ));

            $_SESSION['name']      = $this->name;
            $_SESSION['firstname'] = $this->firstname;
            $_SESSION['email']     = $this->email;
            $_SESSION['country']   = $this->pays;
            $_SESSION['age']       = $this->age;
            $_SESSION['sexe']      = $this->sexe;

            return true;

        } catch(Exception $ex) {
            // $this->error = $ex->getMessage();
            return false;
            // die('Erreur interne;');
        }

    }

    public function UpdateProfile_Password() {

        $this->ConnectToDb();
        $req = $this->bdd->prepare("UPDATE users SET password=:password WHERE id=:id");

        try {

            $req->execute(array(
                'password' => password_hash($this->password, PASSWORD_DEFAULT),
                'id'       => $_SESSION['id']
            ));

            return true;

        } catch(Exception $ex) {
            // $this->error = $ex->getMessage();
            return false;
            // die('Erreur interne;');
        }

    }

    public function DataPost()
    {

        if (!empty($this->post['name'])) {

            if (!empty($this->post['firstname'])) {

                if (!empty($this->post['email'])) {

                    if (!empty($this->post['pays'])) {

                        if (!empty($this->post['age'])) {

                            if (!empty($this->post['sexe'])) {

                                $this->name = $this->post['name'];
                                $this->firstname = $this->post['firstname'];
                                $this->email = $this->post['email'];
                                $this->sexe = $this->post['sexe'];
                                $this->pays =  $this->post['pays'];
                                $this->age = $this->post['age'];

                                unset($_POST['email']);

                                return true;

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
                    $this->error = "Votre addresse email n'as pas été renseignée.";
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

    public function DataPost_Password() {

        if (!empty($this->post['password'])) {

            if (!empty($this->post['password_confirm']) && $this->post['password_confirm'] == $this->post['password']) {

                    $this->password = $this->post['password'];
                    $this->password_confirm = $this->post['password_confirm'];

                    unset($_POST['password']);
                    unset($_POST['password_confirm']);

                    return true;

            } else {
                $this->error = "La confirmation de votre nouveau mot de passe n'as pas été renseignée ou elle est invalide.";
                return false;
            }

        } else {
            $this->error = "Votre nouveau mot de passe n'as pas été renseigné.";
            return false;
        }

    }

}