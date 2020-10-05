<?php if(!class_exists('Rain\Tpl')){exit;}?><?php require $this->checkTemplate("header");?>

<div class="container">

	<h1 class="h1-title"><?php echo $NAME; ?> | Suppression d'un membre</h1>

	<div class="dashboard">

		<?php require $this->checkTemplate("dashboard_menu");?>

		<div class="content-right">
			
			<?php if( $ERROR_MEMBRES!=null ){ ?>
			<h3 class="display-errors"><?php echo $ERROR_MEMBRES; ?></h3>
			<?php } ?>

			<?php if( $ERROR_MEMBRES==null ){ ?>
			<h2><i class="fa fa-trash"></i> Suppression d'un membre :</h2>
			<h2><i class="fa fa-question-circle"></i> Confirmez-vous la suppression totale du membre <?php echo $MEMBRE_NAME; ?> <?php echo $MEMBRE_FIRSTNAME; ?> ?</h2>

			<form action="" method="POST" class="form" style="text-align: center;">

				<input type="text" style="display: none;" name="form-delete_membre" value="posted">

				<div class="confirm confirm-yes">
					<input type="radio" name="confirm" value="oui" required=""> Oui
				</div>
				<div class="confirm confirm-no">
					<input type="radio" name="confirm" value="non" required="" checked=""> Non
				</div>

				<input type="submit" value="Confirmer" class="button-send">

			</form>
			<?php } ?>

		</div>

	</div>

</div>

<?php require $this->checkTemplate("footer");?>