<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account extends App_Controller
{

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
	public function logout()
	{
		$token = $this->input->cookie('__plmkt_uat', TRUE);
		// Update token expiry
		$this->db->where('token', $token)->update('auth_tokens', ['is_expired' => 1]);
		// Delete the cookie by setting its expiration time to a past value
		delete_cookie('__plmkt_uat');
		redirect(SITE_URL . '/login/player');
	}
}
