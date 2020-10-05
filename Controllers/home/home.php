<?php

    (empty($page)) ? $page = 1 : null;

	require CHEMIN_MODELE . 'home/home.php';
	$home = new \home\home(SQL_SITE_DSN, SQL_SITE_USERNAME, SQL_SITE_PASSWORD, $page);

	$home->SearchArticles();
	$tpl->assign('ARTICLES', $home->articles);

    $tpl->assign('PAGE', $page);
    $tpl->assign('ERROR_ARTICLE', $home->error);
	$tpl->draw('home/home');