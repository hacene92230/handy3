<?php if(!class_exists('Rain\Tpl')){exit;}?><?php require $this->checkTemplate("header");?>

<div class="container first-section">

	<h3 class="page-header">Handi3.0 | Recherche sur le site</h3>

	<?php if( $ERROR_RESEARCH!=null ){ ?>
	<div class="display-errors">
		<span><?php echo $ERROR_RESEARCH; ?></span>
	</div>
	<?php } ?>

	<div class="search-bar-large">
		<label for="search-bar" style="display: none;">Faire une recherche sur le site...</label>
        <input type="text" id="search-bar-large" value="<?php echo $SEARCH; ?>" placeholder="Faire une recherche sur le site..." />
	</div>

	<div class="list-articles">
		
		<?php $counter1=-1;  if( isset($RESULTS) && ( is_array($RESULTS) || $RESULTS instanceof Traversable ) && sizeof($RESULTS) ) foreach( $RESULTS as $key1 => $value1 ){ $counter1++; ?>
		<article class="view-normal">

            <div class="article-title"><?php echo $value1["titre"]; ?></div>
            <div class="view-content">
                <div class="view-left">
                    <img class="article-img" src="<?php echo $value1["lien_img"]; ?>">
                </div>
                <div class="view-right">
						<span class="article-details">
							<a class="article-detail">Par <?php echo $value1["auteur"]; ?></a>
							<span class="article-detail"><?php echo $value1["date"]; ?></span>
						</span>
                    <p class="article-preview"><?php echo $value1["extrait"]; ?></p>
                    <a href="<?php echo $BASE_DIR; ?>articles/<?php echo $value1["id"]; ?>" class="article-link">Afficher l'article</a>
                </div>
            </div>

		</article>
		<?php } ?>

	</div>

</div>

<?php require $this->checkTemplate("footer");?>