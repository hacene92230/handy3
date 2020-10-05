<?php if(!class_exists('Rain\Tpl')){exit;}?><header>

	<a href="<?php echo $BASE_DIR; ?>" class="logo"><i class="fa fa-wheelchair-alt"></i> Handi 3.0</a>

	<div class="menu-account">
		<?php if( IS_LOGGED!=true ){ ?>
		<a href="<?php echo $BASE_DIR; ?>inscription"><i class="fa fa-plus"></i> Inscription</a>
		<a href="<?php echo $BASE_DIR; ?>connexion"><i class="fa fa-sign-in"></i> Connexion</a>
		<?php }else{ ?>
		<a href="<?php echo $BASE_DIR; ?>dashboard"><i class="fa fa-user"></i> <?php echo $NAME; ?></a>
		<a href="<?php echo $BASE_DIR; ?>deconnexion"><i class="fa fa-sign-out"></i> Déconnexion</a>
		<?php } ?>
	</div>

	<div class="menu">
		<a href="<?php echo $BASE_DIR; ?>" class="active"><i class="fa fa-home"></i> Accueil</a>
		<a href="<?php echo $BASE_DIR; ?>a-propos"><i class="fa fa-question-circle"></i> A-Propos</a>
		<a href="<?php echo $BASE_DIR; ?>fichiers"><i class="fa fa-files-o"></i> Fichiers</a>
		<!-- <a href=""><i class="fa fa-comments-o"></i> Tchat</a> -->
		<a href=""<i class="fa fa-commenting-o"></i> Forum</a>
		<a href="<?php echo $BASE_DIR; ?>contact"><i class="fa fa-phone"></i> Contact</a>
	</div>

	<div class="search-bar">
		<label for="search-bar">Faire une recherche sur le site...</label>
		<i class="fa fa-search" id="fa-search"></i> <input type="text" id="search-bar" placeholder="Faire une recherche sur le site..." />
	</div>

</header>

<!-- <img class="img-header" src="<?php echo $BASE_DIR; ?>Images/background2.jpg"></img> -->
