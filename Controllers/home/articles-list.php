<?php

	if(!IS_LOGGED OR !IS_ADMIN) {
		$notifs->StoreFlash('info', 'Vous devez être connecté !');
		header('location: ' . CHEMIN_BASE_DIR);
		exit();
	}

	require CHEMIN_MODELE . 'home/articles-list.php';
	$articles = new \home\articles_list(SQL_SITE_DSN, SQL_SITE_USERNAME, SQL_SITE_PASSWORD);

	$articles->SearchArticles();
	$tpl->assign('ARTICLES', $articles->articles);

	$tpl->assign('ERROR_ARTICLE', $articles->error);
	$tpl->draw('home/articles-list');