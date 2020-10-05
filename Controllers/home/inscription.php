<?php
if(IS_LOGGED) {
	$notifs->StoreFlash('info', 'Vous êtes déjà connecté !');
	header('location: ' . CHEMIN_BASE_DIR);
	exit();
}

require CHEMIN_MODELE . 'home/inscription.php';
$inscription = new \home\inscription(SQL_SITE_DSN, SQL_SITE_USERNAME, SQL_SITE_PASSWORD);

if($inscription->UserIsBan()) {
    $notifs->StoreFlash('error', 'Votre compte semble avoir été suspendu par l\'équipe du site. Impossible donc de vous laisser accéder à cette page...');
    header('location: ' . CHEMIN_BASE_DIR);
    exit();
}

function FillInputs($tpl, $inputs) {
    foreach($inputs as $input) {

        if(!empty($_POST[$input])) {
            $tpl->assign('G_' . strtoupper($input), $_POST[$input]);
        } else {
            $tpl->assign('G_' . strtoupper($input), '');
        }

    }
}

FillInputs($tpl, array('name', 'firstname', 'email'));

if(isset($_POST['form-inscription'])) {

	if ($inscription->DataPost() AND $inscription->IsAlphaNum()) {

	    if($inscription->VerifyUsersBan()) {

            if($inscription->StoreNewUser()) {
                $notifs->StoreFlash('success', 'Inscription réussie !');
                header('location: ' . CHEMIN_BASE_DIR . 'connexion');
            } else {
                // header('location: ' . CHEMIN_BASE_DIR . 'inscription');
            }

        }

	}

}

$tpl->assign("ERROR_INSCRIPTION", $inscription->error);
$tpl->draw('home/inscription');
