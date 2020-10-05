<?php

	(empty($search)) ? $search = '' : null;
	$search = urldecode($search);

	require CHEMIN_MODELE . 'home/search.php';
	$research = new \home\research(SQL_SITE_DSN, SQL_SITE_USERNAME, SQL_SITE_PASSWORD, $search);

	if(!empty($search)) {
		$research->SearchResults();
	} else {
        $research->error = 'Votre recherche semble vide, essayez de nous donner quelque chose à rechercher...';
    }

	// debug($research->results);

	$tpl->assign('RESULTS', $research->results);
	$tpl->assign('SEARCH', $search);
	$tpl->assign('ERROR_RESEARCH', $research->error);
	$tpl->draw('home/search');