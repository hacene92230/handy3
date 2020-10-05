<?php

if(empty($error)) {
    header('Location: ' . BASE_DIR);
    exit();
}

$tpl->assign('ERROR', $error);
$tpl->draw('home/erreurs');