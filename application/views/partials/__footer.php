<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script>
	let profileMenu = document.getElementById("profileMenu");

	function toggleMunu() {
		profileMenu.classList.toggle("open-menu");
	}
</script>
<script>
	function get_base_url() {
		var pathparts = location.pathname.split("/");
		if (location.host == "localhost")
			var url = location.origin + "/" + pathparts[1].trim("/") + "/";
		else var url = location.origin + '/';

		return url;
	}
	const base_url = get_base_url();
	// ---------------------------------------------------------------------------
	let sideActivity = document.getElementById("sidebarActivity");
	let moreLink = document.getElementById("showMoreLink");

	function toggleActivity() {
		sideActivity.classList.toggle("open-activity");

		if (sideActivity.classList.contains("open-activity")) {
			moreLink.innerHTML = "Show less <b>-</b>";
		} else {
			moreLink.innerHTML = "Show more <b>+</b>";
		}
	}
</script>
<!-- Dynamic Scripts  -->
<?php
if (isset($scripts) && !empty($scripts)) :
	foreach ($scripts as $script) :
?>
		<script src="<?= $script ?>"></script>
<?php
	endforeach;
endif;
?>
</body>

</html>
