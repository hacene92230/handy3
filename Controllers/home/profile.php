<?php

	if(!IS_LOGGED) {
		$notifs->StoreFlash('info', 'Vous devez être connecté !');
		header('location: ' . CHEMIN_BASE_DIR);
		exit();
	}

	require CHEMIN_MODELE . 'home/profile.php';
	$dash = new \home\profile(SQL_SITE_DSN, SQL_SITE_USERNAME, SQL_SITE_PASSWORD);

	$tpl->assign('NAME2', $_SESSION['name']);
	$tpl->assign('AGE', $_SESSION['age']);

	if(isset($_POST['form-modification_profil'])) {

		if ($dash->DataPost()) {

			if($dash->UpdateProfile()) {

				$notifs->StoreFlash('success', 'Votre profil à été modifié');
				header('location: ' . CHEMIN_BASE_DIR . 'dashboard');
				exit();

			}

		}

	}

	if(isset($_POST['form-modification_password'])) {

		if ($dash->DataPost_Password()) {

			if($dash->UpdateProfile_Password()) {

				$notifs->StoreFlash('success', 'Votre mot de passe à été modifié');
				header('location: ' . CHEMIN_BASE_DIR . 'dashboard');
				exit();

			}

		}

	}

	$tpl->assign('ERROR_MODIFICATION', $dash->error);
	$tpl->draw('home/profile');