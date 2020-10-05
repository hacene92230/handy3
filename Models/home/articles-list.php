<?php
namespace home;

use PDO;

class articles_list
{

    private $bdd = null;
    private $sql_dsn = null;
    private $sql_username = null;
    private $sql_password = null;
    private $post = null;

    public $error = null;
    public $articles = array();

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

    public function SearchArticles() {

        if(time() - filemtime(CHEMIN_CACHE . 'articles_list.tmp') > 300) {

            $this->ConnectToDb();
            $req = $this->bdd->prepare("SELECT id, title, preview, DATE_FORMAT(date, 'Le %d/%m/%Y à %Hh%i') AS date, author, img_link FROM articles ORDER BY id DESC");
            $req->execute();

            if ($req->rowCount() != 0) {

                while ($data = $req->fetch()) {

                    $article = array(
                        'id'                => htmlspecialchars($data['id']),
                        'titre'             => htmlspecialchars($data['title']),
                        'contenu'           => htmlspecialchars(substr($data['preview'], 0, 50)),
                        'date'              => htmlspecialchars($data['date']),
                        'auteur'            => htmlspecialchars($data['author']),
                        'lien_image'        => htmlspecialchars($data['img_link'])
                    );
                    array_push($this->articles, $article);

                }

                file_put_contents(CHEMIN_CACHE . 'articles_list.tmp', serialize($this->articles));

                return true;

            }

        } else {
            $this->articles = unserialize(file_get_contents(CHEMIN_CACHE . 'articles_list.tmp'));
        }

        return false;

    }

    public function UpdateArticle() {

        $this->ConnectToDb();
        $req = $this->bdd->prepare("UPDATE articles(title, content, preview, author, img_link) SET title=:title, content=:content, preview=:preview, author=:author, img_link=:img_link");

        try {

            $req->execute(array(
                'title'    => addcslashes($this->title, '%_'),
                'content'  => addcslashes($this->article, '%_'),
                'preview'  => addcslashes($this->preview, '%_'),
                'author'   => addcslashes($_SESSION['firstname'], '%_'),
                'img_link' => addcslashes($this->image, '%_')
            ));

            return true;

        } catch(Exception $ex) {
            // $this->error = $ex->getMessage();
            $this->error = 'Erreur interne.';
            return false;
        }

    }

}