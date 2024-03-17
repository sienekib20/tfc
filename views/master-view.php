<!DOCTYPE html>
<html lang="en">

<head>
	<title>Welcome</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="<?= asset('css/fonts/barlow.css') ?>">
	<link rel="stylesheet" href="<?= asset('css/fonts/syne.css') ?>">
	<link rel="stylesheet" href="<?= asset('css/helvetica/style.css') ?>">
	<link rel="stylesheet" href="<?= asset('css/alquimist.css') ?>">
	<link rel="stylesheet" href="<?= asset('css/navbar.css') ?>">
	<link rel="stylesheet" href="<?= asset('css/task.css') ?>">
	<link rel="stylesheet" href="<?= asset('css/style.css') ?>">
	<link rel="stylesheet" href="<?= asset('css/media.css') ?>">
	<link rel="stylesheet" href="<?= asset('css/bootstrap-icons.css') ?>">
</head>

<body class="main-bg-color-dark">
	<?= partials('nav.navbar') ?>
	<div class="wrapper mt-3">
		<div class="container">
			<?= partials('nav.sidebar') ?>
			<div class="contain-wrapper px-4">
				<?= $this->load() ?>
			</div> <!--/.container-wrapper-->
		</div>
		<?= partials('nav.open-sidebar') ?>
	</div> <!--/.wrapper-->
</body>

</html>