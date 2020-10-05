<?php if(!class_exists('Rain\Tpl')){exit;}?><?php require $this->checkTemplate("header");?>

<div class="container">

	<h1 class="h1-title">Page Contact</h1>

	<?php if( $ERROR_CONTACT!=null ){ ?>
	<h3 class="display-errors"><?php echo $ERROR_CONTACT; ?></h3>
	<?php } ?>

	<h3>Formulaire de contact :</h3>

	<form action="" method="POST" class="form">
		<label for="name">* Votre nom :</label>
		<input type="text" name="name" placeholder="Ici votre nom de famille" required="">
		<label for="firstname">Votre prénom :</label>
		<input type="text" name="firstname" placeholder="Ici votre prénom">
		<label for="email">* Votre email :</label>
		<input type="email" name="email" placeholder="Ici votre email" required="">
		<label for="message">* Votre message :</label>
		<textarea name="message" placeholder="Ici votre message à nous faire parvenir" required=""></textarea>
		<input type="submit" value="Envoyer" class="button-send">
	</form>

</div>

<?php require $this->checkTemplate("footer");?>