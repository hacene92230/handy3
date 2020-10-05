<?php if(!class_exists('Rain\Tpl')){exit;}?>		<div class='menu-links'>
			<a href='<?php echo $BASE_DIR; ?>dashboard'>Tableau de bord</a>
			<a href='<?php echo $BASE_DIR; ?>profile'>Mon profil</a>
			<a href="">Tchat</a>
			<?php if( $IS_ADMIN ){ ?>
			<a href='<?php echo $BASE_DIR; ?>articles-new'>Nouvel article</a>
			<a href='<?php echo $BASE_DIR; ?>articles-list'>Liste des articles</a>
			<a href='<?php echo $BASE_DIR; ?>membres-list'>Liste des membres</a>
			<a href='<?php echo $BASE_DIR; ?>upload'>Gérer les fichiers</a>
			<a id='save_require' title="Effectuer une sauvegarde">Effectuer une sauvegarde</a>
			<?php } ?>
		</div>