<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function save_user($user_data){
        return true;
    }

    public function delete_user($user_data){
        return true;
    }

    public function login_user($user_data){
        return array('user' => 'andi');
    }
}
