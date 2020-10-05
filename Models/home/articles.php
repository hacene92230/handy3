<?php
namespace home;

use PDO;

class articles
{

    private $bdd          = null;
    private $sql_dsn      = null;
    private $sql_username = null;
    private $sql_password = null;
    private $id           = null;

    public $article = array();

    public function __construct($sql_dsn = null, $sql_username = null, $sql_password = null, $id = 1) {

        $this->sql_dsn      = $sql_dsn;
        $this->sql_username = $sql_username;
        $this->sql_password = $sql_password;
        $this->id           = $id;

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

    public function SearchArticles() {

        $this->ConnectToDb();
        $req = $this->bdd->prepare("SELECT id, title, content, DATE_FORMAT(date, 'Le %d/%m/%Y à %Hh%i') AS date, author, img_link FROM articles WHERE id=:id");
        $req->execute(array('id' => $this->id));

        function Parse($text) {
            require CHEMIN_LIBS . 'Parsedown/Parsedown.php';
            $Parsedown = new \Parsedown();
            return $Parsedown->text($text);
        }

        if ($req->rowCount() != 0) {

            while ($data = $req->fetch()) {

                $this->article = array(
                    'id'                => htmlspecialchars($data['id']),
                    'titre'             => htmlspecialchars($data['title']),
                    // 'contenu'           => htmlspecialchars($data['content']),
                    'contenu'           => Parse($data['content']),
                    'date'              => htmlspecialchars($data['date']),
                    'auteur'            => htmlspecialchars($data['author']),
                    'lien_image'        => htmlspecialchars($data['img_link'])
                );

            }

            return true;

        } else {
            header('location: ' . CHEMIN_BASE_DIR);
            exit();
        }

        return false;

    }

}