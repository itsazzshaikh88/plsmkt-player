<?php

class Post_model extends CI_Model
{
	function addpost($post)
	{
		return $this->db->insert('posts', $post);
	}
}
