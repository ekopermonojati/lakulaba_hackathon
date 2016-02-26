<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Model {

	public $nama_produk;
	public $gambar_produk;
	public $deskripsi;
	public $harga_jual;
	public $biaya_pengiriman;
	public $stok;
	public $status;
	public $url_code;
	public $user_id;
	public $created_date;
	
	public function __construct()
        {
			parent::__construct();
        }
	
	public function insert($nama_produk='', $gambar_produk='',$deskripsi='',$harga_jual=0,$biaya_pengiriman=0,$stok=0,$user_id='')
	{
		$this->nama_produk = $nama_produk;
		$this->gambar_produk = $gambar_produk;
		$this->deskripsi = $deskripsi;
		$this->harga_jual = $harga_jual;
		$this->biaya_pengiriman = $biaya_pengiriman;
		$this->stok = $stok;
		$this->status = 0;
		$this->url_code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
		$this->user_id = $user_id;
		$this->created_date = getdate();
		$this->db->insert('ll_produk',$this);
	}
	public function get_20()
        {
                $query = $this->db->get('ll_produk', 20);
                return $query->result();
        }
	public function get_produk($user_id=0)
	{
			$query = $this->db->get_where('ll_produk', array('user_id'=>$user_id));
			return $query->result();
	}
	public function get_produk_id($id_produk=0)
	{
			$query = $this->db->get_where('ll_produk', array('id'=>$id_produk,'user_id'=>$this->session->userdata('user_id')));
			return $query->result();
	}
	public function find_sell_code($code='')
	{
		$query = $this->db->get_where('ll_produk',array('url_code'=>$code));
		return $query;
	}
}
