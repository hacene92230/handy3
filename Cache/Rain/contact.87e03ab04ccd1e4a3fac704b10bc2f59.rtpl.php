<?php if(!class_exists('Rain\Tpl')){exit;}?><?php require $this->checkTemplate("header");?>

<div class="carousel">
    <img src="<?php echo $BASE_DIR; ?>Images/background3.jpg">
    <img src="<?php echo $BASE_DIR; ?>Images/background4.jpg">
</div>

<div class="container">

	<h3 class="page-header">Formulaire de contact :</h3>

	<?php if( $ERROR_CONTACT!=null ){ ?>
	<div class="display-errors">
		<span><?php echo $ERROR_CONTACT; ?></span>
	</div>
	<?php } ?>

	<div class="form-box">
		<form action="" method="POST" class="form">

			<span class="form-help">Les champs marqués d'un * sont obligatoires.</span>
			<hr />

			<label for="name">* Votre nom :</label>
			<input type="text" id="name" name="name" placeholder="Ici votre nom de famille" required="">

			<label for="firstname">Votre prénom :</label>
			<input type="text" id="firstname" name="firstname" placeholder="Ici votre prénom">

			<label for="email">* Votre email :</label>
			<input type="email" id="email" name="email" placeholder="Ici votre email" required="">

			<label for="message">* Votre message :</label>
			<textarea id="message" name="message" placeholder="Ici votre message à nous faire parvenir" required=""></textarea>

			<input type="submit" value="Envoyer" class="form-submit">
		</form>
	</div>

</div>

<?php require $this->checkTemplate("footer");?>