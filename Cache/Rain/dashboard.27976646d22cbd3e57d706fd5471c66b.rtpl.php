<?php if(!class_exists('Rain\Tpl')){exit;}?>﻿<?php require $this->checkTemplate("header");?>


<div class="container">

	<h1 class="h1-title"><i class="fa fa-home"></i> <?php echo $NAME; ?> | Mon tableau de bord</h1>

	<div class="dashboard">

		<?php require $this->checkTemplate("dashboard_menu");?>


		<div class="content-right">




		</div>

	</div>

</div>

<?php require $this->checkTemplate("footer");?>