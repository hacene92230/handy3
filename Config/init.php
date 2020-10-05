<?php

    // DEBUG
    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    error_reporting(-1);

    // MAIL
    // ini_set('sendmail_path', 'C:\UwAmp\sendmail\sendmail.exe')

    // SESSION START
    if(!isset($_SESSION)) { session_start(); }
    ini_set('session.gc_maxlifetime', '14400');

    //debug(ini_get('session.use_cookies'));

	// Dans le cas ou le serveur php est en version 5.4 :
	$filename = __DIR__ . preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
	if (php_sapi_name() === 'cli-server' && is_file($filename)) {
	    return false;
	}

	date_default_timezone_set('Europe/Paris');

    if(!defined('ABSPATH')) { define('ABSPATH', substr(dirname(__FILE__), 0, -6)); }
    $script_name = $_SERVER['SCRIPT_NAME'];

    define('TEMPLATE', 'Template_2');

    //---------------------- Base de donnée du site web -------------------------------
    define('SQL_SITE_DSN', 'mysql:dbname=' . $config['db_site']['database'] . ';host=' . $config['db_site']['hostname']);
    define('SQL_SITE_USERNAME', $config['db_site']['username']);
    define('SQL_SITE_PASSWORD', $config['db_site']['password']);

    define('MAIL_CONTACT', $config['mail']['contact']);
    define('MAIL_ADMIN', $config['mail']['admin']);
    define('MAIL_DEBUG', $config['mail']['debug']);

    define('CHEMIN_BASE_DIR', substr($script_name, 0, strrpos($script_name, '/') + 1));
    define('CHEMIN_LIBS', ABSPATH . 'Libs/');
    define('CHEMIN_CACHE', ABSPATH . 'Cache/');
    define('CHEMIN_DATA', ABSPATH . 'Data/');
    define('CHEMIN_CONFIG', ABSPATH . 'Config/');
    define('CHEMIN_MODELE', ABSPATH . 'Models/');
    define('CHEMIN_VUE_BASE', 'Views/' . TEMPLATE . '/');
    define('CHEMIN_IMG', ABSPATH . CHEMIN_VUE_BASE . 'Images/');
    define('CHEMIN_VUE', CHEMIN_VUE_BASE . 'home' . '/');
    define('CHEMIN_CONTROLEUR', ABSPATH . 'Controllers');
    define('CHEMIN_SAUVEGARDE', ABSPATH . 'Sauvegardes/');
    define('CHEMIN_FICHIERS', ABSPATH . 'Files/');
    define('FILE', $script_name);

	// Désactivation des guillemets magiques
    ini_set('magic_quotes_runtime', 0);
    if(1 == get_magic_quotes_gpc()) {
        function remove_magic_quotes_gpc(&$value) { $value = stripslashes($value); }
        array_walk_recursive($_GET, 'remove_magic_quotes_gpc');
        array_walk_recursive($_POST, 'remove_magic_quotes_gpc');
       //  array_walk_recursive($_COOKIE, 'remove_magic_quotes_gpc');
    }

    //---------------------- suppression de config['db_site'] par securité -------------------------------
    unset($config['db_site']);

    // Moteur de templates Rain TPL
    require_once CHEMIN_LIBS . 'Rain/autoload.php';
    use Rain\Tpl;

    $config_rain = array(
        // 'tpl_dir'     => CHEMIN_VUE_BASE,
        'tpl_dir'     => array(CHEMIN_VUE_BASE, CHEMIN_VUE_BASE . 'home/'),
        'cache_dir'   => CHEMIN_CACHE . 'Rain/',
        'debug'       => true, // DEBUG
        'auto_escape' => false
    );
    Tpl::configure($config_rain);

    $tpl = new Tpl;
    $tpl->assign('CHEMIN_BASE_DIR', CHEMIN_BASE_DIR);
    $tpl->assign('TEMPLATE_BASE_DIR', CHEMIN_BASE_DIR . CHEMIN_VUE_BASE);
    $tpl->assign('BASE_DIR', CHEMIN_BASE_DIR);
    $tpl->assign('CHEMIN_VUE_BASE', CHEMIN_VUE_BASE);

    //-------------------------------------------------------------
    //                  Système de compte
    //-------------------------------------------------------------

    if(empty($_SESSION['is_logged'])) { $_SESSION['is_logged'] = false; }
    define('IS_LOGGED', $_SESSION['is_logged']);
    $tpl->assign('IS_LOGGED', IS_LOGGED);

    (IS_LOGGED) ? $tpl->assign('NAME', htmlspecialchars($_SESSION['firstname'])) : $tpl->assign('NAME', 'Visiteur');
    (IS_LOGGED) ? $tpl->assign('EMAIL', htmlspecialchars($_SESSION['email'])) : $tpl->assign('EMAIL', 'visiteur@handi3.fr');

    if(empty($_SESSION['rank'])) { $_SESSION['rank'] = 0; }
    switch ($_SESSION['rank']) {
    	case 100:
    		define('IS_ADMIN', true);
    		$tpl->assign('IS_ADMIN', true);
    		break;
    	default:
    		define('IS_ADMIN', false);
    		$tpl->assign('IS_ADMIN', false);
    		break;
    }

    //-------------------------------------------------------------
    //                 Système de notifications
    //-------------------------------------------------------------

    require_once CHEMIN_MODELE . 'notifs.php';
    $notifs = new notifs();

    if($notifs->FlashExist()) {
        $tpl->assign('NOTIFS', true);
        $tpl->assign('FLASH', $notifs->notifications);
    } else {
        $tpl->assign('NOTIFS', false);
        $tpl->assign('FLASH', null);
    }

    // TODO : FONCTION DE DEBUG == A SUPPRIMER LORS DE LA VERSION STABLE
    function debug($variable = null) {
        echo '<div class="debug"><pre class="display-debug">';
        var_dump($variable);
        echo '</pre></div>';
    }