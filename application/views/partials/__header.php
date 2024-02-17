<!DOCTYPE html>
<html lang="en">

<head>
	<base href="<?= base_url() ?>">
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?= isset($page_title) ? $page_title : "Player Panel - " . APP_NAME ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
	<link rel="stylesheet" href="assets/css/style.css" />
	<link rel="stylesheet" href="assets/custom/css/custom-style.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
	<!-- Dynamic CSS  -->
	<?php
	if (isset($css_files) && !empty($css_files)) :
		foreach ($css_files as $css_file) :
	?>
			<link href="<?= $css_file ?>" rel="stylesheet" />
	<?php
		endforeach;
	endif;
	?>
</head>

<body>
	<?php
	include_once '__navbar.php'
	?>

	<!-- --------navbar close----------- -->
