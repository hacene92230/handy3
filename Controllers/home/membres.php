<?php

	(empty($membre)) ? $membre = "handi3" : null;
	$membre = urldecode($membre);

	if(!IS_LOGGED) {
		$notifs->StoreFlash('info', 'Vous devez être connecté !');
		header('location: ' . CHEMIN_BASE_DIR);
		exit();
	}

	require CHEMIN_MODELE . 'home/membres.php';
	$membres_class = new \home\dashboard(SQL_SITE_DSN, SQL_SITE_USERNAME, SQL_SITE_PASSWORD, $membre);

	$membres_class->SearchInformations();

	$tpl->assign('ERROR_MEMBRE', $membres_class->error);
	$tpl->assign('MEMBRE', $membre);
	$tpl->assign('INFORMATIONS', $membres_class->data);
	$tpl->draw('home/membres');