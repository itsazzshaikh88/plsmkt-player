<?php

class Player_model extends CI_Model
{
	public function playersuggestion($logged_in_userid, $usertype)
	{
		$sql = "SELECT
			concat(c.first_name, '' , c.last_name) as Playername,
			c.id as c_id,
			f.id as f_id,
			f.followed_by_user_type,
			f.followed_by,
			IFNULL((f.status),'Follow')follow
			FROM players c
			LEFT JOIN followers f on f.following_to = c.id and
			f.followed_by = $logged_in_userid and f.following_user_type = '$usertype'  and f.followed_by_user_type = '$usertype' 
			where c.player_id NOT IN ('$logged_in_userid') and IFNULL((f.status),'Follow') != 'Followed'";
		return $this->db->query($sql)->result_array();
	}
}
