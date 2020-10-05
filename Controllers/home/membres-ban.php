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

    require CHEMIN_MODELE . 'home/membres-ban.php';
	$ban = new \home\membres_ban(SQL_SITE_DSN, SQL_SITE_USERNAME, SQL_SITE_PASSWORD, $id);

    if($ban->SearchIp()) {
        $ban->BanUser();

        $notifs->StoreFlash('success', 'Cet utilisateur est désormais banni du site.');
        header('location: ' . CHEMIN_BASE_DIR . 'membres-list');
        exit();
    } else {
        $notifs->StoreFlash('error', 'Cet utilisateur ne semble pas éxister, ou bien il ne peux pas être banni...');
        header('location: ' . CHEMIN_BASE_DIR . 'membres-list');
        exit();
    }