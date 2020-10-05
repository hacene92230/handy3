<?php if(!class_exists('Rain\Tpl')){exit;}?><?php require $this->checkTemplate("header");?>

<div class="container">

	<h1 class="h1-title"><i class="fa fa-upload"></i> Page Upload | Mise en ligne de fichiers</h1>

	<div class="dashboard">

	<?php require $this->checkTemplate("dashboard_menu");?>

	<div class="content-right">

		<div class="new-upload">

			<form enctype="multipart/form-data" method="post" action="">
				<input type="file" name="file_field" value="">
				<input type="submit" name="Submit" value="Lancer l'Upload">
			</form>

		</div>

		<div class="list-files">
			
			<h2>Fichiers disponibles :</h2>

			<ul>
			<?php $counter1=-1;  if( isset($FILES) && ( is_array($FILES) || $FILES instanceof Traversable ) && sizeof($FILES) ) foreach( $FILES as $key1 => $value1 ){ $counter1++; ?>
				<li><?php echo $value1; ?></li>
			<?php } ?>
			</ul>

		</div>

	</div>

</div>

<?php require $this->checkTemplate("footer");?>