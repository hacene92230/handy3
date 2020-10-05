<?php

	(empty($id)) ? $id = 1 : null;
	if($id == 1) { header('location: ' . CHEMIN_BASE_DIR); exit(); }

	if(!IS_LOGGED OR !IS_ADMIN) {
		$notifs->StoreFlash('info', 'Vous devez être connecté !');
		header('location: ' . CHEMIN_BASE_DIR);
		exit();
	}

	require CHEMIN_MODELE . 'home/membres-delete.php';
	$membres = new \home\membres_delete(SQL_SITE_DSN, SQL_SITE_USERNAME, SQL_SITE_PASSWORD, $id);

	$membres->SearchMembre();

	if(isset($_POST['form-delete_membre'])) {

		if ($_POST['confirm'] == 'oui') {

			$membres->DeleteMembre();
			$notifs->StoreFlash('success', 'Le membre à bien été supprimé.');
			header('location: ' . CHEMIN_BASE_DIR . 'membres-list');
			exit();

		} else {
			$notifs->StoreFlash('info', 'La suppression à été annulée.');
			header('location: ' . CHEMIN_BASE_DIR . 'membres-list');
			exit();
		}

	}

	$tpl->assign('ERROR_MEMBRES', $membres->error);

	if(!empty($membres->membre[0])) {
		$tpl->assign('MEMBRE_NAME', $membres->membre[0]['name']);
		$tpl->assign('MEMBRE_FIRSTNAME', $membres->membre[0]['firstname']);
	}
	
	$tpl->draw('home/membres-delete');