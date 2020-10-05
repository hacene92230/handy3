<?php

	(empty($id)) ? $id = 1 : null;
	if($id == 1) { header('location: ' . CHEMIN_BASE_DIR); exit(); }

	if(!IS_LOGGED OR !IS_ADMIN) {
		$notifs->StoreFlash('info', 'Vous devez être connecté !');
		header('location: ' . CHEMIN_BASE_DIR);
		exit();
	}

	require CHEMIN_MODELE . 'home/articles-delete.php';
	$articles = new \home\articles_delete(SQL_SITE_DSN, SQL_SITE_USERNAME, SQL_SITE_PASSWORD, $id);

	if(isset($_POST['form-delete_article'])) {

		if ($_POST['confirm'] == 'oui') {

			$articles->DeleteArticle();
			$notifs->StoreFlash('success', 'L\'article à bien été supprimé.');
			header('location: ' . CHEMIN_BASE_DIR);
			exit();

		} else {
			$notifs->StoreFlash('info', 'La suppression à été annulée.');
			header('location: ' . CHEMIN_BASE_DIR);
			exit();
		}

	}

	$tpl->assign('ERROR_ARTICLE', $articles->error);
	$tpl->draw('home/articles-delete');