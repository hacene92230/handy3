<?php
    
    // Initialisation
	require_once 'Config/params.php';
    require_once 'Config/init.php';
    
    // Routeur
    require_once CHEMIN_LIBS . '/Bramus/Router.php';
    $router = new \Bramus\Router\Router();

    // ========== Erreurs 404 ========== //
    $router->set404(function() use ($tpl, $notifs) {
        header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
        require CHEMIN_CONTROLEUR . '/home/404.php';
    });

    // ========== Index.php ========== //
    $router->match('GET|POST', '/', function() use ($tpl, $notifs) { require CHEMIN_CONTROLEUR . '/home/home.php'; });
    $router->match('GET|POST', '/page/(\d+)', function($page) use ($tpl, $notifs) { ($page == 0) ? $page = 1 : null; require CHEMIN_CONTROLEUR . '/home/home.php'; });

    // ========== Pages dynamiques ========== //
    $router->match('GET|POST', '/([a-zA-Z0-9_-]+)', function($controller) use ($tpl, $notifs) {
    	(file_exists(CHEMIN_CONTROLEUR . '/home/' . $controller . '.php')) ? require CHEMIN_CONTROLEUR . '/home/' . $controller . '.php' : require CHEMIN_CONTROLEUR . '/home/404.php';
    });

    // ========== Les membres ========== //
    $router->match('GET|POST', '/membres/(.*)', function($membre) use ($tpl, $notifs) { require CHEMIN_CONTROLEUR . '/home/membres.php'; });
    $router->match('GET|POST', '/membres-delete/(\d+)', function($id) use ($tpl, $notifs) { require CHEMIN_CONTROLEUR . '/home/membres-delete.php'; });
    $router->match('GET|POST', '/membres-ban/(\d+)', function($id) use ($tpl, $notifs) { require CHEMIN_CONTROLEUR . '/home/membres-ban.php'; });
    $router->match('GET|POST', '/membres-allow/(\d+)', function($id) use ($tpl, $notifs) { require CHEMIN_CONTROLEUR . '/home/membres-allow.php'; });

    // ========== Les articles ========== //
    $router->match('GET|POST', '/articles/(\d+)', function($id) use ($tpl, $notifs) { require CHEMIN_CONTROLEUR . '/home/articles.php'; });
    $router->match('GET|POST', '/articles-edit/(\d+)', function($id) use ($tpl, $notifs) { require CHEMIN_CONTROLEUR . '/home/articles-edit.php'; });
    $router->match('GET|POST', '/articles-delete/(\d+)', function($id) use ($tpl, $notifs) { require CHEMIN_CONTROLEUR . '/home/articles-delete.php'; });

    // ========== Pages diverses ========== //
    $router->match('GET|POST', '/search/(.*)', function($search) use ($tpl, $notifs) { require CHEMIN_CONTROLEUR . '/home/search.php'; });
    $router->get('/files/(.*)', function($file) { (empty($file)) ? $file = '' : null; $file = urldecode($file); require CHEMIN_FICHIERS . $file; });
    $router->get('/save', function() use ($notifs) { require CHEMIN_CONTROLEUR . '/home/save.php'; });
    $router->get('/erreur/(\d+)', function($error) use ($tpl) { require CHEMIN_CONTROLEUR . '/home/erreurs.php'; });

    // Rendu
    $router->run();