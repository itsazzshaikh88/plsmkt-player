<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Clubs extends App_Controller
{
    // This controller will use to make query onm club details 
    // not the club who is logged in 
    // but the club search 
    public function __construct()
    {
        parent::__construct();
    }
}
