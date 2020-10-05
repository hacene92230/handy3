<?php

	if(!IS_LOGGED) {
		$notifs->StoreFlash('info', 'Vous devez être connecté !');
		header('location: ' . CHEMIN_BASE_DIR);
		exit();
	}
	
	$tpl->draw('home/dashboard');