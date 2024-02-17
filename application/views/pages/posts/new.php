<div class="container-custom">
	<!-- ------left-sidebar-------->
	<?php include_once 'application/views/pages/partials/home_left_sidebar.php' ?>

	<!-- ---------main-content----------->
	<div class="main-content">
		<div class="d-none" id="message-container" tabindex="0">
			<p class="pb-0 mb-0 alert text-center" id="message-box"></p>
		</div>
		<div class="custom-card">
			<h3 class="mb-0"> Share Your Moments</h3>
			<small>
				Your platform to share victories, training progress, and insights with the global sports community.
			</small>
			<hr>
			<div class="custom-post-card">
				<form action="posts/new" method="post" onsubmit="addpost(event)" id="form" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-12">
							<!-- <div class="post-section ps-2 pe-2">
								<div class="form-group mb-3">
									<label for="">Post Type</label>
									<div class="mt-2 d-flex justify-content-between">
										<div class="post-type-checkbox">
											<input type="radio" name="post_type" id="post_type_text" onclick="choosePostType(this)" value="text" checked> Text Post
										</div>
										<div class="post-type-checkbox ">
											<input type="radio" name="post_type" id="post_type_video" onclick="choosePostType(this)" value="video"> Video Post
										</div>
										<div class="post-type-checkbox">
											<input type="radio" name="post_type" id="post_type_image" onclick="choosePostType(this)" value="image"> Image Post
										</div>
									</div>
								</div>
								<div class="post-container" id="post-text">

								</div>
								<div class="post-container d-none" id="post-video">
									<h3>Add Video Post</h3>
								</div>
								<div class="post-container d-none" id="post-image">
									<h3>Add Image Post</h3>
								</div>
							</div> -->
							<div class="form-group">
								<label for="" class="mb-2">Post / Caption</label>
								<textarea id="editor" name="caption" class="form-control" placeholder="Post Caption"></textarea>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group mt-2">
										<label for="" class="mb-2">Post File</label>
										<input type="file" id="file_chooser" name="file_chooser" class="form-control" placeholder="Choose Post File" onchange="validateFileType(this)" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group mt-2">
										<label for="" class="mb-2">Post File Thumbnail</label>
										<input type="file" id="file_thumbnail" name="file_thumbnail" class="form-control" placeholder="Choose Thumbnail File" />
									</div>
								</div>
							</div>
							<div class="form-group mt-3">
								<button class="btn btn-green w-100" type="submit" id="submit-btn">Upload Post</button>
							</div>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>

	<!-- ---------right-sidebar---------->
	<?php include_once 'application/views/pages/partials/home_right_sidebar.php' ?>
</div>
