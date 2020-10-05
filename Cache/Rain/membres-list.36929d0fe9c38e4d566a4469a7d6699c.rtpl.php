<?php if(!class_exists('Rain\Tpl')){exit;}?><?php require $this->checkTemplate("header");?>

<link href="<?php echo $TEMPLATE_BASE_DIR; ?>css/plugins/footable.css" rel="stylesheet">
<script src="<?php echo $TEMPLATE_BASE_DIR; ?>js/plugins/footable.min.js"></script>

<script>
    $(document).ready(function() {  $('.footable').footable(); });
</script>

<div class="container">

	<h1 class="h1-title"><?php echo $NAME; ?> | Liste des membres</h1>

	<div class="dashboard">

		<?php require $this->checkTemplate("dashboard_menu");?>

		<div class="content-right">
			
			<?php if( $ERROR_MEMBRE!=null ){ ?>
			<h3 class="display-errors"><?php echo $ERROR_MEMBRE; ?></h3>
			<?php } ?>

			<div class="membres-all_list">
                <input type="text" class="search-content" id="filter" placeholder="Rechercher un article dans le tableau...">
                <hr />
                <table class="footable" data-page-size="15" data-filter="#filter">
                    <thead>
                        <tr class="table-titles">
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Date d'inscription</th>
                            <th data-hide="phone,tablet">Pays</th>
                            <th data-hide="phone,tablet">Age</th>
                            <th data-hide="phone,tablet">Sexe</th>
                            <th data-hide="phone,tablet">Modifications</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php $counter1=-1;  if( isset($MEMBRES) && ( is_array($MEMBRES) || $MEMBRES instanceof Traversable ) && sizeof($MEMBRES) ) foreach( $MEMBRES as $key1 => $value1 ){ $counter1++; ?>
                        <tr>
                            <td><?php echo $value1["nom"]; ?></td>
                            <td><?php echo $value1["prenom"]; ?></td>
                            <td><?php echo $value1["email"]; ?></td>
                            <td><?php echo $value1["date_inscription"]; ?></td>
                            <td><?php echo $value1["pays"]; ?></td>
                            <td><?php echo $value1["age"]; ?></td>
                            <td><?php echo $value1["sexe"]; ?></td>
                            <td><a href="<?php echo $BASE_DIR; ?>membres-delete/<?php echo $value1["id"]; ?>" class="btn-delete">Supprimer</a> / <a href="<?php echo $BASE_DIR; ?>membres-ban/<?php echo $value1["id"]; ?>" class="btn-delete">Bannir</a> / <a href="<?php echo $BASE_DIR; ?>membres-allow/<?php echo $value1["id"]; ?>" class="btn-edit">Autoriser</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">
                                <ul class="pagination"></ul>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

		</div>

	</div>

</div>

<?php require $this->checkTemplate("footer");?>