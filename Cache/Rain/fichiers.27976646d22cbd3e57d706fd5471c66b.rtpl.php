<?php if(!class_exists('Rain\Tpl')){exit;}?><?php require $this->checkTemplate("header");?>

<div class="carousel">
    <img src="<?php echo $BASE_DIR; ?>Images/background3.jpg">
    <img src="<?php echo $BASE_DIR; ?>Images/background4.jpg">
</div>

<div class="container">
    <h3 class="files-header">Liste des fichiers mis à votre disposition (<?php echo $FILES_COUNT; ?> disponibles) :</h3>
    <div class="list-files">
        <?php $counter1=-1;  if( isset($FICHIERS) && ( is_array($FICHIERS) || $FICHIERS instanceof Traversable ) && sizeof($FICHIERS) ) foreach( $FICHIERS as $key1 => $value1 ){ $counter1++; ?>
        <div class="file">
            <span class="file-name"><?php echo $value1; ?></span>
            <a href="<?php echo $BASE_DIR; ?>files/<?php echo $value1; ?>" download="<?php echo $value1; ?>" class="file-download">Télécharger</a>
        </div>
        <?php } ?>
    </div>
</div>

<?php require $this->checkTemplate("footer");?>