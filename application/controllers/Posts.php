<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Posts extends App_Controller
{
	public $allowed_image_extensions  = array('gif', 'jpg', 'jpeg', 'png', 'bmp', 'svg', 'webp');
	public $allowed_video_extensions  = array('mp4', 'avi', 'mov', 'wmv', 'flv', 'mkv', '3gp', 'mpg', 'mpeg', 'swf');
	public $allowed_types = 'gif|jpg|jpeg|png|bmp|svg|webp|GIF|JPG|JPEG|PNG|BMP|SVG|WEBP|mp4|avi|mov|wmv|flv|mkv|3gp|mpg|mpeg|swf|MP4|AVI|MOV|WMV|FLV|MKV|3GP|MPG|MPEG|SWF';
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
	}
	public function new()
	{
		if ($this->input->method() === 'post') {

			$post_id = $this->generate_random_id();
			$postmode = 'text';
			$filename = null;
			$filetype = null;
			$thumbnail_filename = null;
			// Upload Post File
			$uploaded_data = $this->upload_post_file('file_chooser');
			$filename = $uploaded_data['filename'];
			$filetype = $uploaded_data['filetype'];
			// Upload File Thumbnail If Available
			$thumbnail_filename = $this->upload_post_thumbnail('file_thumbnail');
			$postmode = $filetype == null ? $postmode : $filetype;
			// After Uploading a File Save Data TO Database
			$post = array(
				'post_id' => $post_id,
				'post_type' => $filetype,
				'post_mode' => $postmode,
				'posted_by' => $this->userid,
				'post_user_type' => 'P',
				'file_link' => $filename,
				'caption' => $this->input->post('caption'),
				'thumbnail' => $thumbnail_filename,
				'timestamp' => time(),
			);
			$status = $this->post_model->addpost($post);
			if ($status) {
				$this->_json_response(200, 'success', 'Post added successfully', ['postid' => $post_id, 'filename' => $filename]);
			} else {
				$this->_json_response(500, 'fail', 'Failed to add post');
			}
			return;
		}
		$data['view_path'] =  "pages/posts/new";
		$data['page_title'] = "Add Post - " . APP_NAME;
		$data['css_files'] = ['assets/summernote/summernote.min.css', 'assets/custom/css/upload-post.css'];
		$data['scripts'] = ['assets/summernote/summernote.min.js', 'assets/custom/js/upload-post.js'];
		$this->load->view('template', $data);
	}
	function generate_random_id()
	{
		// Get current Unix timestamp with microseconds
		$timestamp = microtime(true);
		// Generate a random string
		$random_string = bin2hex(random_bytes(4)); // 8 characters
		// Concatenate timestamp and random string and remove dot
		$post_id = str_replace('.', '', $timestamp) . $random_string;
		return $post_id;
	}

	function upload_post_file($postfile_name)
	{
		$uploaded_filename  = ['filetype' => '', 'filename' => ''];
		if (isset($_FILES[$postfile_name])) {
			$file = $_FILES[$postfile_name];
			// Get the file extension
			$file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
			// check extension and select path
			if (in_array($file_extension, $this->allowed_image_extensions))
				$uploaded_filename['filetype'] = 'image';
			elseif (in_array($file_extension, $this->allowed_video_extensions))
				$uploaded_filename['filetype'] = 'video';
			// Set Path
			if ($uploaded_filename['filetype'] != null) {
				// Set upload configuration
				$upload_path = "./files/posts/" . $uploaded_filename['filetype'] . "s/";
				$size = null; // You can set a maximum size if needed
				// Call the upload_file function and pass the file and configuration
				$uploaded_filename['filename'] = $this->upload_file($postfile_name, $file, $upload_path, $this->allowed_types, $size);
			}
		}
		return $uploaded_filename;
	}
	function upload_post_thumbnail($thumbnail_filename)
	{
		$uploaded_filename = '';
		if (isset($_FILES[$thumbnail_filename])) {
			$thumbnail_file = $_FILES[$thumbnail_filename];
			// Set upload configuration
			$upload_path = "./files/thumbnails/";
			$size = null; // You can set a maximum size if needed
			// Call the upload_file function and pass the file and configuration
			$uploaded_filename = $this->upload_file($thumbnail_filename, $thumbnail_file, $upload_path, $this->allowed_types, $size);
		}
		return $uploaded_filename;
	}

	function _json_response($status_code = '', $status_text = '', $message = '', $data = null)
	{
		$this->output
			->set_status_header($status_code)
			->set_content_type('application/json')
			->set_output(json_encode([
				'status' => $status_code,
				'statusText' => $status_text,
				'message' => $message,
				'data' => $data
			]));
	}
}
