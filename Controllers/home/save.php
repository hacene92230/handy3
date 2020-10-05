<?php

	if(!IS_LOGGED OR !IS_ADMIN) {
		$notifs->StoreFlash('error', 'Vous n\'êtes pas connecté(e) ou bien vous ne pouvez pas accéder à cette page. !');
		header('location: ' . CHEMIN_BASE_DIR);
		exit();
	}

	/**
	 * Permet la création d'une archive Zip à partir d'un dossier
	 * @author Clément POUJOL alias Monobloclimber
	 * @version 1
	 * @copyright clementpoujol.fr
	 * 
	 * @param  string $dirSource
	 * @param  string $dirBackup
	 * @param  integer $reload
	 * @param  object $oZip
	 * @return dossier Zipé
	 */
	function createZip($dirSource,$dirBackup, $reload = null, $oZip = null) {
	    // si le dossier existe
	    if ($dir = opendir($dirSource)) {
	        // on créer le chemin du dossier final
	        $pathZip = $dirBackup.'.zip';

	        //si la fonction est lancé pour la première fois on créer l'objet
	        if(!$reload){
	            $oZip = new ZipArchive;
	            $oZip->open($pathZip, ZipArchive::CREATE);
	        } // sinon on récupère l'object passé en param
	        else{
	            $oZip = $oZip;
	        }
	        
	        while (($file = readdir($dir)) !== false) {
	            // on évite le dossier parent et courant
	            if($file != '..'  && $file != '.') {
	                // Si c'est un dossier on relance la fonction
	                if(is_dir($dirSource.$file)) {
	                    createZip($dirSource.$file.'/', $dirBackup.$file.'/', 1, $oZip);
	                }// sinon c'est un fichier donc on l'ajoute à l'archive
	                else {
	                    $oZip->addFile($dirSource.$file);
	                }
	            }
	        }
	        // on ferme l'archive
	        if(!$reload){
	            return $oZip->close();
	        }
	    }

	}

    date_default_timezone_set('UTC');
    $date = date('d-m-Y');

    require CHEMIN_LIBS . 'MysqlDump/src/Ifsnop/Mysqldump/Mysqldump.php';

    $dump = new \Ifsnop\Mysqldump\Mysqldump(SQL_SITE_DSN, SQL_SITE_USERNAME, SQL_SITE_PASSWORD);
    $dump->start('Sauvegardes/Save-SQL_' . $date . '.sql');
	
	/* DANS LE CAS OU ON VEUX GARDER UNE SAUVEGARDE PAR JOUR :
    (file_exists('Sauvegardes/Save_' . $date)) ? null : mkdir('Sauvegardes/Save_' . $date);

	createZip('Config/', 'Sauvegardes/Save_' . $date . '/Config');
	createZip('Views/', 'Sauvegardes/Save_' . $date . '/Views');
	createZip('Images/', 'Sauvegardes/Save_' . $date . '/Images'); */

	// Une seule sauvegarde à la fois :
    createZip('Config/', 'Sauvegardes/Save_' . $date);
    createZip('Views/', 'Sauvegardes/Save_' . $date);
    createZip('Images/', 'Sauvegardes/Save_' . $date);

	$notifs->StoreFlash('success', 'Sauvegarde réussie !');
	header('location: ' . CHEMIN_BASE_DIR);
    exit();