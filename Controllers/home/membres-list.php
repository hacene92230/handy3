<?php

	if(!IS_LOGGED OR !IS_ADMIN) {
		$notifs->StoreFlash('info', 'Vous devez être connecté !');
		header('location: ' . CHEMIN_BASE_DIR);
		exit();
	}

	require CHEMIN_MODELE . 'home/membres-list.php';
	$membres = new \home\membres_list(SQL_SITE_DSN, SQL_SITE_USERNAME, SQL_SITE_PASSWORD);

	$membres->SearchMembres();
	$tpl->assign('MEMBRES', $membres->membres);

	$tpl->assign('ERROR_MEMBRE', $membres->error);
	$tpl->draw('home/membres-list');