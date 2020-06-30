<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="robots" content="noindex">
		<title>Šalys ir miestai</title>

        <!-- Bootstrap CSS, JS, Popper.js, jQuery -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
		
		<!-- Custom JS/CSS -->
        <link rel="stylesheet" href="<?php echo Router::Css('style') ?>">
		<script src="<?php echo Router::Js('Utils') ?>"></script>
		<script src="<?php echo Router::Js('HtmlPrinter') ?>"></script>
        <script src="<?php echo Router::Js('Area') ?>"></script>
        <script>
            // Enable all tooltips
            $(function () { $('[data-toggle="tooltip"]').tooltip() });
        </script>
	</head>
    <body>
        <?php include Router::View('common/navbar') ?>

        <div id="main-wrapper">
            <div id="alerts-wrapper"></div>

            <?php
                if (file_exists($actionFile))
                    include $actionFile;
            ?>
        </div>

        <?php include Router::View('common/toastMessages') ?>
    </body>
</html>