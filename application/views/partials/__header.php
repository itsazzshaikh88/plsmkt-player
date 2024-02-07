<!DOCTYPE html>
<html lang="en">

<head>
	<base href="<?= base_url() ?>">
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?= isset($page_title) ? $page_title : "Player Panel - " . APP_NAME ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
	<link rel="stylesheet" href="assets/css/style.css" />
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
	<nav class="navbar-custom">
		<div class="navbar-left">
			<a href="<?= base_url() ?>" class="logo"><img src="images/logo.png" alt="" /></a>
		</div>
		<div class="navbar-center">
			<ul>
				<li>
					<a href="<?= base_url() ?>" class="active-link">
						<i class="bi bi-house-fill"></i>
						<span>Dashboard </span></a>
				</li>
				<li>
					<a href="network/hub">
						<i class="bi bi-person-badge-fill"></i>
						<span>Network Hub </span></a>
				</li>
				<li>
					<a href="clubs/find">
						<i class="bi bi-people-fill"></i>
						<span>Club Hub </span></a>
				</li>
				<li>
					<a href="posts/uploaded">
						<i class="bi bi-image-fill"></i>
						<span>Showcase</span></a>
				</li>
				<li>
					<a href="inbox">
						<i class="bi bi-envelope-at-fill"></i>
						<span>Message Inbox </span></a>
				</li>
				<li>
					<a href="alerts">
						<i class="bi bi-bell-fill"></i>
						<span>Alerts </span></a>
				</li>
			</ul>
		</div>
		<div class="navber-right">
			<div class="online">
				<img src="images/user-1.png" class="nav-profile-img" onclick="toggleMunu()" />
			</div>
		</div>
		<!-- ------------profile dropdown menu---------- -->
		<div class="profile-menu-wrap" id="profileMenu">
			<div class="profile-menu">
				<div class="user-info">
					<img src="images/user-1.png" />
					<div>
						<h3>Rayan Walton</h3>
						<p>PL00000000</p>
					</div>
				</div>
				<hr />
				<a href="#" class="profile-menu-link">
					<i class="bi bi-person left"></i>
					<p>View Profile</p>
					<span><i class="bi bi-caret-right-fill"></i></span>
				</a>

				<a href="#" class="profile-menu-link">
					<i class="bi bi-person-gear left"></i>
					<p>Account & Settings</p>
					<span><i class="bi bi-caret-right-fill"></i></span>
				</a>

				<a href="#" class="profile-menu-link">
					<i class="bi bi-question-circle left"></i>
					<p>Help & Support</p>
					<span><i class="bi bi-caret-right-fill"></i></span>
				</a>

				<a href="#" class="profile-menu-link">
					<i class="bi bi-box-arrow-right left"></i>
					<p>Logout</p>
					<span><i class="bi bi-caret-right-fill"></i></span>
				</a>
			</div>
		</div>
	</nav>

	<!-- --------navbar close----------- -->
