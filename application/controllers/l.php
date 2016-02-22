<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class L extends CI_Controller {
	public function __construct(){
        parent::__construct();     
    }
	public function l($code=''){
		$this->load->model('Produk');
		$result = $this->produk->find_sell_code($code);
		$data['produk'] = $result;
		//cek stock dan is_aktif. jika stok kosong maka tolak pembayaran. jika is_active false maka tolak pembayaran
		
		//create trx
		$produk = $result->row();
		$trx_id_string = $produk->url_code . $produk->user_id . time();
		$trx_id = md5($trx_id_string);
		$data['trx_id'] = $trx_id;
		
		$this->session->set_userdata('lakulaba_trx_id', $trx_id);
		$sql = "insert into ll_transaksi (id_trx, id_produk) values('" . $trx_id ."','" . $produk->id . "')";
		if ($this->db->query($sql)) $this->load->view('detail_produk',$data);
		
	}
}
