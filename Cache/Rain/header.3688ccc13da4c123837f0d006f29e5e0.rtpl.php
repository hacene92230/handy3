<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html>
<head>

	<!-- Site développe par Florian B en 2016/2017 -->

	<link rel="stylesheet" type="text/css" href="<?php echo $TEMPLATE_BASE_DIR; ?>css/app.css">
	<!-- <link rel="icon" type="image/png" href="img/Avatar.png"> -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<meta charset="utf-8">
    <meta http-equiv="content-language" content="fr" />
    <meta name="language" content="fr" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Florian B">
	<title>- [ Handi 3.0 ] -</title>

    <script src="http://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
	
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
	  ga('create', 'UA-90592311-1', 'auto');
	  ga('send', 'pageview');
	</script>

	<?php if( $NOTIFS ){ ?>
        <!-- Toastr -->
        <link href="<?php echo $TEMPLATE_BASE_DIR; ?>css/plugins/toastr.min.css" rel="stylesheet">
        <link href="<?php echo $TEMPLATE_BASE_DIR; ?>css/notifs.css" rel="stylesheet">
        <script src="<?php echo $TEMPLATE_BASE_DIR; ?>js/plugins/toastr.min.js"></script>

        <script type="text/javascript" language="JavaScript">
            $(document).ready(function() {
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "progressBar": true,
                    "preventDuplicates": false,
                    "positionClass": "toast-top-right",
                    "onclick": null,
                    "showDuration": "400",
                    "hideDuration": "1000",
                    "timeOut": "7500",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                <?php $counter1=-1;  if( isset($FLASH) && ( is_array($FLASH) || $FLASH instanceof Traversable ) && sizeof($FLASH) ) foreach( $FLASH as $key1 => $value1 ){ $counter1++; ?>
                toastr.<?php echo $value1["type"]; ?>('<?php echo $value1["message"]; ?>', '<?php echo $value1["titre"]; ?>');
                <?php } ?>
            });
        </script> 
    <?php } ?>

</head>
<body>

<?php require $this->checkTemplate("navbar");?>
