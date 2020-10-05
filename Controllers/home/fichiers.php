<?php

require CHEMIN_MODELE . 'home/fichiers.php';
$fichiers = new \home\fichiers();

$fichiers->SearchFiles();

$tpl->assign('FICHIERS', $fichiers->files);
$tpl->assign('FILES_COUNT', $fichiers->files_count);
$tpl->draw('home/fichiers');