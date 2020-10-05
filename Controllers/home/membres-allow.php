<?php

	(empty($id)) ? $id = 1 : null;
	if($id == 1) {
        $notifs->StoreFlash('error', 'Le lien de cette page semble invalide...');
	    header('location: ' . CHEMIN_BASE_DIR);
        exit();
	}

	if(!IS_LOGGED OR !IS_ADMIN) {
		$notifs->StoreFlash('info', 'Vous devez être connecté et être un administrateur !');
		header('location: ' . CHEMIN_BASE_DIR);
		exit();
	}

    require CHEMIN_MODELE . 'home/membres-allow.php';
	$allow = new \home\membres_allow(SQL_SITE_DSN, SQL_SITE_USERNAME, SQL_SITE_PASSWORD, $id);

    if($allow->SearchIp()) {
        $allow->AllowUser();

        $notifs->StoreFlash('success', 'Cet utilisateur n\'est plus banni du site.');
        header('location: ' . CHEMIN_BASE_DIR . 'membres-list');
        exit();
    } else {
        $notifs->StoreFlash('error', 'Cet utilisateur ne semble pas exister...');
        header('location: ' . CHEMIN_BASE_DIR . 'membres-list');
        exit();
    }