<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Player extends App_Controller
{
    // This controller will use to make query onm players details 
    // not the player who is logged in 
    // but the player search 
    public function __construct()
    {
        parent::__construct();
    }

    function fetch_player_suggestions()
    {
        echo json_encode($this->player_model->playersuggestion($this->userid, 'P'));
    }
}
