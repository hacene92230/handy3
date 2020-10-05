<?php if(!class_exists('Rain\Tpl')){exit;}?><?php require $this->checkTemplate("header");?>

<div class="container">

	<h1 class="h1-title"><i class="fa fa-home"></i> Liste des articles <?php if( $PAGE!=1 ){ ?>Page <?php echo $PAGE; ?><?php } ?></h1>

	<?php if( $ERROR_ARTICLE!=null ){ ?>
	<h3 class="display-errors"><?php echo $ERROR_ARTICLE; ?></h3>
    <a href="<?php echo $BASE_DIR; ?>" style="color: blue;">Cliquez ici pour revenir à l'accueil du site.</a>
	<?php } ?>

	<div class="list-articles">
		
		<?php $counter1=-1;  if( isset($ARTICLES) && ( is_array($ARTICLES) || $ARTICLES instanceof Traversable ) && sizeof($ARTICLES) ) foreach( $ARTICLES as $key1 => $value1 ){ $counter1++; ?>
		<article class="view-normal">
			
			<img src="<?php echo $value1["lien_image"]; ?>" class="article-img">
			<h3 class="article-title"><a href="<?php echo $BASE_DIR; ?>articles/<?php echo $value1["id"]; ?>"><?php echo $value1["titre"]; ?></a></h3>
			<button onclick="location.href='<?php echo $BASE_DIR; ?>articles/<?php echo $value1["id"]; ?>'" class="article-link">Afficher l'article</button>
			<a href="<?php echo $BASE_DIR; ?>membres/<?php echo $value1["auteur"]; ?>" class="article-author">Par <?php echo $value1["auteur"]; ?></a>
			<span class="article-date"><?php echo $value1["date"]; ?></span>

			<p class="article-preview">
				<?php echo $value1["contenu"]; ?>
			</p>

		</article>
		<?php } ?>

		<div class="navigation-articles">
			<?php if( $PAGE!=1 ){ ?><a href="<?php echo $BASE_DIR; ?>page/<?php echo $PAGE-1; ?>" title="Page précédente">Page précédente</a>
			<a href="<?php echo $BASE_DIR; ?>" title="page 1">1</a><?php } ?>
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