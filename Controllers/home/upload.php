<?php

	if(!IS_LOGGED OR !IS_ADMIN) {
		$notifs->StoreFlash('error', 'Vous n\'êtes pas connecté(e) ou bien vous ne pouvez pas accéder à cette page. !');
		header('location: ' . CHEMIN_BASE_DIR);
		exit();
	}

	require(CHEMIN_LIBS . 'Upload/src/class.upload.php');

	try {

		if(!empty($_FILES['file_field'])) {

			$handle = new upload($_FILES['file_field'], 'fr_FR');

			$handle->file_max_size = '31457280';

			if ($handle->uploaded) {
				$handle->process(CHEMIN_FICHIERS);
				if ($handle->processed) {

				 	// echo 'Transfert ok.';
				 	$notifs->StoreFlash('success', 'Upload du fichier terminé avec succès.');
				 	$handle->clean();

				 	header('location: ' . CHEMIN_BASE_DIR . 'upload');
					exit();

				} else {
					// echo 'Erreur : ' . $handle->error;
					$notifs->StoreFlash('error', $handle->error);

					header('location: ' . CHEMIN_BASE_DIR . 'upload');
					exit();
				}
			}

		}

	} catch (Exception $ex) {
        die('Erreur interne. Echec de l\'upload.');
    }

    require CHEMIN_MODELE . 'home/upload.php';
    $list_files = new \home\list_files();

    $list_files->SearchFiles(CHEMIN_FICHIERS);
    $tpl->assign('FILES', $list_files->files);

    $tpl->draw('home/upload');