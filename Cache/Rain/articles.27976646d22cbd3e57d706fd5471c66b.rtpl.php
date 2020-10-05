<?php if(!class_exists('Rain\Tpl')){exit;}?><?php require $this->checkTemplate("header");?>

<div class="container">

	<h1 class="h1-title"><i class="fa fa-file-text-o"></i> <?php echo $ARTICLES["titre"]; ?></h1>

	<div class="list-articles">
		
		<article class="view-large">
			
			<img src="<?php echo $ARTICLES["lien_image"]; ?>" class="article-img">
			<h3 class="article-title"><a href=""><?php echo $ARTICLES["titre"]; ?></a></h3>
			<a href="<?php echo $BASE_DIR; ?>membres/<?php echo $ARTICLES["auteur"]; ?>" class="article-author">Par <?php echo $ARTICLES["auteur"]; ?></a>
			<span class="article-date"><?php echo $ARTICLES["date"]; ?></span>

			<p class="article-preview">
				<?php echo $ARTICLES["contenu"]; ?>
			</p>

		</article>

	</div>

</div>

<?php require $this->checkTemplate("footer");?>