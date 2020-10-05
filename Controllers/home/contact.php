<?php

require CHEMIN_MODELE . 'home/contact.php';
$contact = new \home\contact(MAIL_CONTACT);

if (!empty($_POST)) {

    if ($contact->DataPost()) {

    	if($contact->SendMail()) {
    		$notifs->StoreFlash('success', 'Votre message nous à été envoyé !');
    		header('location: ' . CHEMIN_BASE_DIR);
    	} else {
    		// header('location: ' . CHEMIN_BASE_DIR . 'contact');
    	}

    }

}

$tpl->assign("ERROR_CONTACT", $contact->error);
$tpl->draw('home/contact');