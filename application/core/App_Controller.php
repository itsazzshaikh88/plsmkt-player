<?php
defined('BASEPATH') or exit('No direct script access allowed');

class App_Controller extends CI_Controller
{
	public $user;
	public $usertype;
	public $userid;
	public $app_language;

	public function __construct()
	{
		parent::__construct();
		$this->isAuthenticated();
	}

	function isAuthenticated()
	{
		$auth_cookie = $this->input->cookie('__plmkt_uat', TRUE);

		$this->app_language = $this->input->cookie('_applang', TRUE);
		// If cookie is not present redirect to login page
		if ($auth_cookie == '')
			return redirect(SITE_URL . "/login/player?force-logout=true");
		// If Cookie is present then check for authentication token and authenticate user
		$this->user = $this->db->query("SELECT p.id, p.player_id, p.first_name, p.last_name, p.email, p.country, p.city, p.sport_id, p.position_id, 
						p.is_verified, p.verified_on, p.verification_source, upi.profile_image, upi.cover_image, upi.listing_image
						FROM players p
						LEFT JOIN user_profile_images upi ON p.id = upi.user_id AND upi.user_type = 'P'
						WHERE p.auth_token = '$auth_cookie'")->row_array();

		if (empty($this->user)) {
			return redirect(SITE_URL . "/login/player?force-logout=true");
		}
		// set user details
		$this->userid = $this->user['id'];
		$this->usertype = "player";
	}


	function upload_file($file_input_name, $file, $upload_path, $allowed_types, $size = null)
	{
		// Create a new instance of the upload library
		$this->load->library('upload');
		// Set upload configuration
		$config['upload_path'] = $upload_path;
		$config['allowed_types'] = $allowed_types;
		if ($size != null)
			$config['max_size'] = $size; // KB
		// Initialize the upload library with the new configuration
		$this->upload->initialize($config);

		// Perform the file upload
		if (!$this->upload->do_upload($file_input_name)) {
			// If upload fails, store the error message in a variable
			$error = $this->upload->display_errors();
			return '';
		} else {
			// If upload succeeds, get the uploaded file data
			$upload_data = $this->upload->data();
			// Get the filename and store it in a variable
			$filename = $upload_data['file_name'];
			return $filename;
		}
	}
}
