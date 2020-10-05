<?php if(!class_exists('Rain\Tpl')){exit;}?><?php require $this->checkTemplate("header");?>

<div class="container">

	<h1 class="h1-title"><i class="fa fa-files-o"></i> Liste des fichiers mis à votre disposition</h1>

	<div class="list-files">
        <h3><?php echo $FILES_COUNT; ?> fichiers disponibles :</h3>
        <?php $counter1=-1;  if( isset($FICHIERS) && ( is_array($FICHIERS) || $FICHIERS instanceof Traversable ) && sizeof($FICHIERS) ) foreach( $FICHIERS as $key1 => $value1 ){ $counter1++; ?>
		<div class="file">
            <span class="file-name"><?php echo $value1; ?></span>
            <a href="<?php echo $BASE_DIR; ?>files/<?php echo $value1; ?>" download="<?php echo $value1; ?>" class="file-download"><i class="fa fa-download"></i> Télécharger</a>
        </div>
        <?php } ?>
	</div>

</div>

<?php require $this->checkTemplate("footer");?>