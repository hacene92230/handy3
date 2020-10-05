<?php if(!class_exists('Rain\Tpl')){exit;}?><?php require $this->checkTemplate("header");?>

<script src="//cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>

<div class="container">

	<h1 class="h1-title"><?php echo $NAME; ?> | Nouvel article</h1>

	<div class="dashboard">

		<?php require $this->checkTemplate("dashboard_menu");?>

		<div class="content-right">
			
			<?php if( $ERROR_ARTICLE!=null ){ ?>
			<h3 class="display-errors"><?php echo $ERROR_ARTICLE; ?></h3>
			<?php } ?>

			<h2><i class="fa fa-folder-open-o"></i> Publier un article :</h2>
			<p><i class="fa fa-question-circle"></i> Les champs marqués d'un * sont obligatoires.</p>

			<form action="" method="POST" class="form">

				<input type="text" style="display: none;" name="form-create_article" value="posted">

				<label for="title">* <i class="fa fa-font"></i> Titre de l'article :</label>
				<input type="text" id="title" name="title" placeholder="Ici le titre de l'article" minlength="3" maxlength="250" required="">

				<label for="image"><i class="fa fa-picture-o"></i> Lien de l'image de l'article :</label>
				<input type="text" id="image" name="image" value="https://www.metzjudo.com/wp-content/uploads/images/articles/perenoel.jpg" minlength="3" maxlength="250" required="">

				<label for="article">* <i class="fa fa-align-left"></i> Contenu de l'article :</label>
				<textarea id="article" name="article" style="min-height: 50px;" minlength="35" required=""></textarea>

				<label for="preview">* <i class="fa fa-align-left"></i> Aperçu de l'article :</label>
				<textarea id="preview" name="preview" style="min-height: 50px;" minlength="10" maxlength="1400" placeholder="Ne placer ici que du texte brut, si possible un extrait ou un résumé de l'article." required=""></textarea>

				<input type="submit" value="Publier cet article" class="button-send">

			</form>

		</div>

	</div>

</div>

<!-- <script>
    // CKEDITOR.replace('article');
</script> -->

<?php require $this->checkTemplate("footer");?>