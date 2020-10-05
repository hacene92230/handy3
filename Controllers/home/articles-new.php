<?php

	if(!IS_LOGGED OR !IS_ADMIN) {
		$notifs->StoreFlash('info', 'Vous devez être connecté !');
		header('location: ' . CHEMIN_BASE_DIR);
		exit();
	}

	require CHEMIN_MODELE . 'home/articles-new.php';
	$articles = new \home\articles(SQL_SITE_DSN, SQL_SITE_USERNAME, SQL_SITE_PASSWORD);

	if(isset($_POST['form-create_article'])) {

		if ($articles->DataPost()) {

			if($articles->StoreNewArticle()) {

				$notifs->StoreFlash('success', 'Votre article est désormais disponible !');
				header('location: ' . CHEMIN_BASE_DIR);
				exit();

			}

		}

	}

	$tpl->assign('ERROR_ARTICLE', $articles->error);
	$tpl->draw('home/articles-new');