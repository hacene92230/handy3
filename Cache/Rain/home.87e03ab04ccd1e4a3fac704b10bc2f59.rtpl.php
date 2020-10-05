<?php if(!class_exists('Rain\Tpl')){exit;}?><?php require $this->checkTemplate("header");?>

<div class="carousel">
	<img src="<?php echo $BASE_DIR; ?>Images/background3.jpg">
	<img src="<?php echo $BASE_DIR; ?>Images/background4.jpg">
</div>

<div class="container">
	<h3 class="articles-header"><?php if( $PAGE!=1 ){ ?>Affichage des articles | Page <?php echo $PAGE; ?> :<?php }else{ ?>Nos 5 derniers articles :<?php } ?></h3>
    <?php if( $ERROR_ARTICLE!=null ){ ?>
    <div class="display-errors">
        <span><?php echo $ERROR_ARTICLE; ?></span>
        <a href="<?php echo $BASE_DIR; ?>" style="color: blue;">Cliquez ici pour revenir à l'accueil du site.</a>
    </div>
    <?php } ?>
	<div class="list-articles">
        <?php $counter1=-1;  if( isset($ARTICLES) && ( is_array($ARTICLES) || $ARTICLES instanceof Traversable ) && sizeof($ARTICLES) ) foreach( $ARTICLES as $key1 => $value1 ){ $counter1++; ?>
		<article class="view-normal">
			<div class="article-title"><?php echo $value1["titre"]; ?></div>
			<div class="view-content">
				<div class="view-left">
					<img class="article-img" src="<?php echo $value1["lien_image"]; ?>">
				</div>
				<div class="view-right">
						<span class="article-details">
							<a class="article-detail">Par <?php echo $value1["auteur"]; ?></a>
							<span class="article-detail"><?php echo $value1["date"]; ?></span>
						</span>
					<p class="article-preview"><?php echo $value1["contenu"]; ?></p>
					<a href="<?php echo $BASE_DIR; ?>articles/<?php echo $value1["id"]; ?>" class="article-link">Afficher l'article</a>
				</div>
			</div>
		</article>
        <?php } ?>
		<div class="navigation-articles">
            <?php if( $PAGE!=1 ){ ?>
			<a href="<?php echo $BASE_DIR; ?>page/<?php echo $PAGE-1; ?>" title="Page précédente">Page précédente</a>
			<a href="<?php echo $BASE_DIR; ?>" title="page 1">1</a>
            <?php } ?>
			<a href="<?php echo $BASE_DIR; ?>page/2" title="page 2">2</a>
			<a href="<?php echo $BASE_DIR; ?>page/3" title="page 3">3</a>
			<a href="<?php echo $BASE_DIR; ?>page/4" title="page 4">4</a>
			<a href="<?php echo $BASE_DIR; ?>page/5" title="page 5">5</a>
			<a href="<?php echo $BASE_DIR; ?>page/6" title="page 6">6</a>
			<a href="<?php echo $BASE_DIR; ?>page/<?php echo $PAGE+1; ?>" title="Page suivante">Page suivante</a>
		</div>
	</div>
</div>

<?php require $this->checkTemplate("footer");?>