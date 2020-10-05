<?php
namespace home;

use PDO;

class articles_edit
{

    private $bdd = null;
    private $sql_dsn = null;
    private $sql_username = null;
    private $sql_password = null;
    private $post = null;

    public $error = null;
    public $id = null;
    public $title = null;
    public $image = null;
    public $article = null;
    public $preview = null;
    public $data = null;

    public function __construct($sql_dsn = null, $sql_username = null, $sql_password = null, $id = 1) {

        $this->post = $_POST;
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

    public function SearchArticles() {

        $this->ConnectToDb();
        $req = $this->bdd->prepare("SELECT title, content, preview, img_link FROM articles WHERE id=:id");
        $req->execute(array('id' => $this->id));

        if ($req->rowCount() != 0) {

            $data_req = $req->fetch();
            $this->data = array(
                'titre'             => htmlspecialchars($data_req['title']),
                'contenu'           => htmlspecialchars($data_req['content']),
                'apercu'            => htmlspecialchars($data_req['preview']),
                'lien_image'        => htmlspecialchars($data_req['img_link'])
            );

            return true;

        } else {
            // $this->notifs->StoreFlash('error', 'L\'article ' . $this->id . ' Ne semble pas éxister...');
            header('location: ' . CHEMIN_BASE_DIR);
            exit();
        }

        return false;

    }

    public function UpdateArticle() {

        $this->ConnectToDb();
        $req = $this->bdd->prepare("UPDATE articles SET title=:title, content=:content, preview=:preview, img_link=:img_link WHERE id=:id");

        try {

            $req->execute(array(
                'title'    => addcslashes($this->title, '%_'),
                'content'  => addcslashes($this->article, '%_'),
                'preview'  => addcslashes($this->preview, '%_'),
                'img_link' => addcslashes($this->image, '%_'),
                'id'       => addcslashes($this->id, '%_')
            ));

            return true;

        } catch(Exception $ex) {
            // $this->error = $ex->getMessage();
            $this->error = 'Erreur interne.';
            return false;
        }

    }

    public function DataPost()
    {

        if (!empty($this->post['title'])) {

            if (!empty($this->post['image'])) {

                if (!empty($this->post['preview'])) {

                    if (!empty($this->post['article'])) {

                        $this->title   = $this->post['title'];
                        $this->article = $this->post['article'];
                        $this->preview = $this->post['preview'];

                        try {
                            $file_headers = get_headers($this->post['image']);
                            ($file_headers[0] != 'HTTP/1.1 200 OK') ? $this->image = 'https://cdn.pixabay.com/photo/2014/08/26/19/21/document-428335_640.jpg' : $this->image = $this->post['image'];
                        } catch(Exception $ex) {
                            $this->error = "Erreur interne.";
                            return false;
                        }

                        return true;

                    } else {
                        $this->error = "Votre article semble vide...";
                        return false;
                    }

                } else {
                    $this->error = "L'aperçu de l'article n'as pas été renseigné.";
                    return false;
                }

            } else {
                $this->error = "Le lien de l'image n'as pas été renseigné.";
                return false;
            }

        } else {
            $this->error = "Le titre de l'article n'as pas été renseigné.";
            return false;
        }

    }

}