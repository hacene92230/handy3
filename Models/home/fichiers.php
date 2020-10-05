<?php
namespace home;

// use PDO;

class fichiers
{

    public $files = array();
    public $files_count = 0;

    public function SearchFiles() {

        if($dossier = opendir(CHEMIN_FICHIERS )) {
            while(($fichier = readdir($dossier)) !== false) {
                if($fichier != '.' && $fichier != '..' && $fichier != 'index.php' && $fichier != '.htaccess') {

                    $this->files_count++;
                    array_push($this->files, $fichier);

                }
            }
            closedir($dossier);
        } else {
            die('Erreur interne.');
        }

    }

}