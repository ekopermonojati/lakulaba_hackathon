<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

	public $id_sosmed;
	public $nama_toko;
	public $nama_pemilik;
	public $alamat;
	public $no_telepon;
	public $no_ecash_mandiri;
	
	public function __construct()
        {
			parent::__construct();
        }
	
	public function insert($id_sosmed='', $email='', $nama_toko='', $nama_pemilik='', $alamat='', $no_telepon='', $no_ecash_mandiri='')
	{
		$this->id_sosmed = $id_sosmed;
		$this->email = $email;
		$this->nama_toko = $nama_toko;
		$this->nama_pemilik = $nama_pemilik;
		$this->alamat = $alamat;
		$this->no_telepon = $no_telepon;
		$this->no_ecash_mandiri = $no_ecash_mandiri;
		$this->db->insert('ll_users',$this);
	}
	
	public function delete($id_sosmed='')
	{
		$this->db->delete('ll_users',array('id_sosmed'=>$id_sosmed));
	}
	
	public function find_id_sosmed($id_sosmed='')
	{
		$query = $this->db->get_where('ll_users',array('id_sosmed'=>$id_sosmed));
		return $query->num_rows();
	}

	public function get_user_data($id='')
	{
		# code...
		$query = $this->db->get_where('ll_users',array('id_sosmed'=>$id));
		return $query->result();
	}
}
