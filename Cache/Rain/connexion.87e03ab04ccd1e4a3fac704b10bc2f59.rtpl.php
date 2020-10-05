<?php if(!class_exists('Rain\Tpl')){exit;}?><?php require $this->checkTemplate("header");?>

<div class="carousel">
    <img src="<?php echo $BASE_DIR; ?>Images/background3.jpg">
    <img src="<?php echo $BASE_DIR; ?>Images/background4.jpg">
</div>

<div class="container">

	<h3 class="page-header">Connexion à votre compte :</h3>

	<?php if( $ERROR_CONNEXION!=null ){ ?>
    <div class="display-errors">
        <span><?php echo $ERROR_CONNEXION; ?></span>
    </div>
	<?php } ?>

    <div class="form-box">
        <form action="" method="POST" class="form">

            <span class="form-help">Les champs marqués d'un * sont obligatoires.</span>
            <hr />

            <input type="text" style="display: none;" name="form-connexion" value="posted">

            <label for="email">* Votre email :</label>
            <input type="email" id="email" name="email" placeholder="Ici votre email" minlength="3" maxlength="120" required="">

            <label for="password">* Votre mot de passe :</label>
            <input type="password" id="password" name="password" placeholder="Ici votre mot de passe" minlength="3" maxlength="60" required="">

            <input type="submit" value="Me connecter" class="form-submit">

        </form>
    </div>

</div>

<?php require $this->checkTemplate("footer");?>