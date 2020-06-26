<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="robots" content="noindex">
		<title>Šalys ir miestai</title>
		<!-- <title>?php echo printer::pageTitle($_GET['module'], $_GET['action']) ?></title> -->
		<!-- <link rel="icon" href="?php echo makeLink::img('favicon.png')?>" /> -->

        <!-- Bootstrap CSS, JS, Popper.js, jQuery -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

		<!-- Font Awesome - glyph icons -->
		<!-- <link href="client_files/fontawesome/css/all.css" rel="stylesheet">		 -->

		<!-- Chart.js + datalabels plugin -->
		<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.min.js"></script> -->
		<!-- <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script> -->
		
		<!-- Custom JS/CSS -->
		<!-- <script src="?php echo makeLink::js('misc.js')?>"></script> -->
		<!-- <link rel="stylesheet" href="?php echo makeLink::css('style.css')?>"> -->
		<!-- <link rel="stylesheet" href="?php echo makeLink::css('login.css')?>"> -->
	</head>
    <body>
        <?php include 'common/header.php'; ?>
        <!-- <div id="pageContent">
            ?php
				if (isset($_GET['module']) && isset($_GET['module']) === 'login') {
					if (file_exists($actionFile)) {
						include $actionFile;
					}
				} else {	?>		
					<div id="main-content-wrapper" >
						?php
							if (file_exists($actionFile)) {
								include $actionFile;
							}
						?>
					</div>
			?php } ?>
        </div> -->

		<!-- <div id="footer">
			<nav class="navbar fixed-bottom navbar-light bg-light" >
				<div class="navbar-text">
					Šalys ir miestai
				</div>
			</nav>
		</div> -->
        <!-- <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script> -->
        <!-- <script> feather.replace() </script> -->
    </body>
</html>