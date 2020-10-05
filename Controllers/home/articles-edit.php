<?php

	(empty($id)) ? $id = 1 : null;

	if(!IS_LOGGED OR !IS_ADMIN) {
		$notifs->StoreFlash('info', 'Vous devez être connecté !');
		header('location: ' . CHEMIN_BASE_DIR);
		exit();
	}

	require CHEMIN_MODELE . 'home/articles-edit.php';
	$articles = new \home\articles_edit(SQL_SITE_DSN, SQL_SITE_USERNAME, SQL_SITE_PASSWORD, $id);

	$articles->SearchArticles();
	$tpl->assign('DATA', $articles->data);

	if(isset($_POST['form-edit_article'])) {

		if ($articles->DataPost()) {

			if($articles->UpdateArticle()) {

				$notifs->StoreFlash('success', 'La nouvelle version de votre article est désormais disponible !');
				header('location: ' . CHEMIN_BASE_DIR . 'articles/' . $id);
				exit();

			}

		}

	}

	$tpl->assign('ERROR_ARTICLE', $articles->error);
	$tpl->draw('home/articles-edit');