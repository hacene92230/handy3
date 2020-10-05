<?php

	if(!IS_LOGGED) {
		$notifs->StoreFlash('info', 'Vous devez être connecté !');
		header('location: ' . CHEMIN_BASE_DIR);
		exit();
	}

	session_destroy();
	session_start();

	$notifs->StoreFlash('success', 'Déconnexion réussie !');

	header('location: ' . CHEMIN_BASE_DIR);
	exit();