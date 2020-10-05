<?php
namespace home;

use PDO;

class home
{

    private $bdd          = null;
    private $sql_dsn      = null;
    private $sql_username = null;
    private $sql_password = null;

    public $error         = null;
    public $articles      = array();
    public $page          = array();

    public function __construct($sql_dsn = null, $sql_username = null, $sql_password = null, $page = null) {

        $this->sql_dsn      = $sql_dsn;
        $this->sql_username = $sql_username;
        $this->sql_password = $sql_password;
        $this->page = $page;

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

        // if(time() - filemtime(CHEMIN_CACHE . 'home.tmp') > 1) {
        // TODO : Cache désactivé pour ne pas faire de conflit avec la pagination des articles. A corriger si possible.

            $page = ($this->page - 1) * 5;

            $this->ConnectToDb();
            $req = $this->bdd->prepare("SELECT id, title, preview, DATE_FORMAT(date, 'Le %d/%m/%Y à %Hh%i') AS date, author, img_link FROM articles ORDER BY id DESC LIMIT $page, 5");
            $req->execute();

            if ($req->rowCount() != 0) {

                while ($data = $req->fetch()) {

                    $article = array(
                        'id'                => htmlspecialchars($data['id']),
                        'titre'             => htmlspecialchars($data['title']),
                        'contenu'           => htmlspecialchars(substr($data['preview'], 0, 1400)),
                        'date'              => htmlspecialchars($data['date']),
                        'auteur'            => htmlspecialchars($data['author']),
                        'lien_image'        => htmlspecialchars($data['img_link'])
                        );
                    array_push($this->articles, $article);

                }

                // file_put_contents(CHEMIN_CACHE . 'home.tmp', serialize($this->articles));

                return true;

            } else {
                $this->error = 'Aucun article à afficher ici...';
                return false;
            }

        // } else {
        //     $this->articles = unserialize(file_get_contents(CHEMIN_CACHE . 'home.tmp'));
        // }

        return false;

    }

}