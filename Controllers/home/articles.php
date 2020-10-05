<?php

	(empty($id)) ? $id = 1 : null;

	require CHEMIN_MODELE . 'home/articles.php';
	$articles = new \home\articles(SQL_SITE_DSN, SQL_SITE_USERNAME, SQL_SITE_PASSWORD, $id);

	$articles->SearchArticles();
	$tpl->assign('ARTICLES', $articles->article);

	$tpl->draw('home/articles');