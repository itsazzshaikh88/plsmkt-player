<?php
defined('BASEPATH') or exit('No direct script access allowed');

class App_Controller extends CI_Controller
{
	protected $user;
	protected $usertype;
	protected $userid;
	protected $app_language;

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
		$this->user = $this->db
			->select('id, player_id, first_name, last_name, email, country, city, sport_id, position_id, is_verified, verified_on, verification_source')
			->where('auth_token', $auth_cookie)
			->get('players')
			->row_array();
		if (empty($this->user))
			return redirect(SITE_URL . "/login/player?force-logout=true");
		// set user details
		$this->userid = $this->user['id'];
		$this->usertype = "player";
	}
}
