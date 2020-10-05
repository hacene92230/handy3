<?php if(!class_exists('Rain\Tpl')){exit;}?><header>
	<div class="bar-details" id="bar-details">
		<div class="left">
			<span class="detail" id="display-date"></span>
			<span class="detail">Le site est encore en période de maintenance...</span>
		</div>
		<div class="right">
			<?php if( IS_LOGGED!=true ){ ?>
			<a href="<?php echo $BASE_DIR; ?>connexion" class="account">Connexion</a>
			<a href="<?php echo $BASE_DIR; ?>inscription" class="account">Inscription</a>
			<?php }else{ ?>
			<a href="<?php echo $BASE_DIR; ?>dashboard" class="account"><?php echo $NAME; ?></a>
			<a href="<?php echo $BASE_DIR; ?>deconnexion" class="account">Déconnexion</a>
			<?php } ?>
		</div>
	</div>
	<div class="bar-menu" id="bar-menu">
		<svg class="menu-icon" id="menu-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 53 53" style="enable-background:new 0 0 53 53;" xml:space="preserve">
				<path d="M2,13.5h49c1.104,0,2-0.896,2-2s-0.896-2-2-2H2c-1.104,0-2,0.896-2,2S0.896,13.5,2,13.5z"/>
				<path d="M2,28.5h49c1.104,0,2-0.896,2-2s-0.896-2-2-2H2c-1.104,0-2,0.896-2,2S0.896,28.5,2,28.5z"/>
				<path d="M2,43.5h49c1.104,0,2-0.896,2-2s-0.896-2-2-2H2c-1.104,0-2,0.896-2,2S0.896,43.5,2,43.5z"/>
			</svg>
		<h2 class="menu-logo"><a href="<?php echo $BASE_DIR; ?>">Handi 3.0</a></h2>
		<div class="menu-links">
			<div class="search-bar">
				<label for="search-bar" id="search-label">Recherche...</label>
				<input type="text" id="search-bar">
			</div>
			<a href="<?php echo $BASE_DIR; ?>" class="active">Accueil</a>
			<!-- <a href="<?php echo $BASE_DIR; ?>a-propos">A-Propos</a> -->
			<a href="<?php echo $BASE_DIR; ?>fichiers">Fichiers</a>
			<!-- <a href="">Forum</a> -->
			<a href="<?php echo $BASE_DIR; ?>contact">Contact</a>
		</div>
	</div>
</header>