<?php

if(IS_LOGGED) {
	$notifs->StoreFlash('info', 'Vous êtes déjà connecté !');
	header('location: ' . CHEMIN_BASE_DIR);
	exit();
}

require CHEMIN_MODELE . 'home/connexion.php';
$connexion = new \home\connexion(SQL_SITE_DSN, SQL_SITE_USERNAME, SQL_SITE_PASSWORD);

if($connexion->UserIsBan()) {
    $notifs->StoreFlash('error', 'Votre compte semble avoir été suspendu par l\'équipe du site. Impossible donc de vous laisser accéder à cette page...');
    header('location: ' . CHEMIN_BASE_DIR);
    exit();
}

if(isset($_POST['form-connexion'])) {

	if ($connexion->DataPost()) {

		if($connexion->DataCorrect()) {

			$_SESSION['id'] = $connexion->id;
			$_SESSION['is_logged'] = true;
            $_SESSION['name'] = $connexion->name;
            $_SESSION['firstname'] = $connexion->firstname;
            $_SESSION['email'] = $connexion->email;
            $_SESSION['country'] = $connexion->country;
            $_SESSION['age'] = $connexion->age;
            $_SESSION['sexe'] = $connexion->sexe;
            $_SESSION['inscription_date'] = $connexion->inscription_date;
            $_SESSION['rank'] = $connexion->rank;

			$notifs->StoreFlash('success', 'Connexion réussie !');
			header('location: ' . CHEMIN_BASE_DIR . 'dashboard');
			exit();

		} else {
			// header('location: ' . CHEMIN_BASE_DIR . 'connexion');
		}

	}

}

$tpl->assign("ERROR_CONNEXION", $connexion->error);
$tpl->draw('home/connexion');