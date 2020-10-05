<?php
namespace home;

use PDO;

class research
{

    private $bdd          = null;
    private $sql_dsn      = null;
    private $sql_username = null;
    private $sql_password = null;

    public $error  = null;
    public $search = null;
    public $results = array();

    public function __construct($sql_dsn = null, $sql_username = null, $sql_password = null, $search = null) {

        $this->sql_dsn      = $sql_dsn;
        $this->sql_username = $sql_username;
        $this->sql_password = $sql_password;
        $this->search       = $search;

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

    public function SearchResults() {

        $this->ConnectToDb();
        $params = array('research' => '%'.addcslashes($this->search, '%_').'%');
        $sql = 'SELECT id, title, author, preview, DATE_FORMAT(date, \'Le %d/%m/%Y à %Hh%i\') AS date, img_link
                FROM articles
                WHERE title LIKE :research
                OR preview LIKE :research
                ORDER BY id DESC LIMIT 5';
        $req = $this->bdd->prepare($sql);

        try {

            $req->execute($params);

            if ($req->rowCount() != 0) {

                while ($data = $req->fetch()) {

                    $result = array(
                        'id'       => $data['id'],
                        'titre'    => $data['title'],
                        'auteur'   => $data['author'],
                        'extrait'  => $data['preview'],
                        'date'     => $data['date'],
                        'lien_img' => $data['img_link'],
                    );

                    array_push($this->results, $result);

                }

                return true;

            } else {
                $this->error = 'Aucun résultat pour votre recherche, essayez autre chose...';
                return false;
            }

        } catch(Exception $ex) {
            // $this->error = $ex->getMessage();
            die('Erreur interne;');
        }

    }

}