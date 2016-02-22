<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pay extends CI_Controller {
	public function __construct(){
        parent::__construct();     
    }
	public function payment(){
		$pay_method = $this->input->post('payment');
		$buyer_name = $this->input->post('fullname');
		$buyer_address = $this->input->post('address');
		$buyer_postalcode = $this->input->post('postalcode');
		$buyer_phone = $this->input->post('phone');
		$trx_id = $this->session->userdata('lakulaba_trx_id');
		
		//update data transaksi dengan identitas buyer
		$sql = "update ll_transaksi set buyer_name='" . $buyer_name . "', buyer_address='" . $buyer_address . "', buyer_postal_code='" . $buyer_postalcode . "', buyer_phone='" . $buyer_phone . "' where id_trx='" . $trx_id . "'";
		if(!$this->db->query($sql)){
			$data['result'] = "Gagal. Maaf, terjadi kesalahan teknis di server kami";
			$this->load->view('output',$data);
		}
		
		//kalkulasi total bayar
		$sql = "select * from ll_transaksi where id_trx='" . $trx_id . "'";
		$result = $this->db->query($sql);
		$transaksi = $result->row();
		$id_produk = $transaksi->id_produk;
		$sql ="select * from ll_produk where id=" . $id_produk;
		$result = $this->db->query($sql);
		$produk = $result->row();
		$total_Bayar = $produk->harga_jual + $produk->biaya_pengiriman;
		
		//Pay using IPG Mandiri
		if ($pay_method==1) {
			$url = "http://128.199.115.34:6557/ipg/ticket?amount=". $total_Bayar ."&tracenumber=" . $trx_id ."&returnurl=" . base_url('/pay/finish_mandiri');
			echo $url;
			$result = json_decode($this->ajax->curl_get($url));
			if ($result->status=='PROCESSED'){
				$ticketID = $result->ticketID;
				$this->session->set_userdata('lakulaba_ticketID', $ticketID);
				//start payment 
				$url = "http://128.199.115.34:8080/ecommgateway/payment.html?id=" . $ticketID;
				header("location: " . $url);
			}
			else {
				$data['result'] = "Gagal. terdapat problem di IPG Mandiri";
				$this->load->view('output',$data);
			}
		}
		
	}
	
	public function finish_mandiri(){
		//cek status akhir pembayaran. Bila pembayaran sukses, maka update DB
		$ticketID = $this->input->get('id');//$this->session->userdata('lakulaba_ticketID');
		$url = "http://128.199.115.34:8080/ecommgateway/validation.html?id=" . $ticketID;
		$result = $this->ajax->curl_get($url);
		$result2 = explode(",",$result);
		$ticketID = $result2[0];
		$buyer_id = $result2[2];
		$trx_id = $result2[3];
		$status = preg_replace('/\s+/', '', $result2[4]);
		
		if (strcasecmp($status,'SUCCESS')==0) {
			$sql = "update ll_transaksi set buyer_id='" . $buyer_id . "', status_return='" . $result . "', status=true, payment_method='eCash Mandiri' where id_trx='" . $trx_id . "'";
			if($this->db->query($sql)){
				//kurangi kuota stock
				$sql = "
				SELECT ll_produk.id,
			   ll_produk.nama_produk,
			   ll_transaksi.id_produk,
			   ll_transaksi.buyer_name,
			   ll_transaksi.buyer_address,
			   ll_transaksi.buyer_postal_code,
			   ll_transaksi.buyer_phone,
			   ll_transaksi.buyer_email,
			   ll_transaksi.buyer_request,
			   ll_transaksi.order_number,
			   ll_transaksi.payment_method,
			   ll_transaksi.id_trx,
			   ll_users.email,
			   ll_users.nama_toko,
			   ll_users.nama_pemilik,
			   ll_users.alamat,
			   ll_users.no_telepon
				  FROM (lakulaba.ll_produk ll_produk
						INNER JOIN lakulaba.ll_users ll_users
						   ON (ll_produk.user_id = ll_users.id_sosmed))
					   INNER JOIN lakulaba.ll_transaksi ll_transaksi
						  ON (ll_produk.id = ll_transaksi.id_produk)
				 WHERE (ll_transaksi.id_trx = '$trx_id')";
				$produk = $this->db->query($sql)->row();
				$id_produk = $produk->id_produk;
				$nama_produk = $produk->nama_produk;
				$buyer_name = $produk->buyer_name;
				$buyer_phone = $produk->buyer_phone;
				$buyer_address = $produk->buyer_address;
				$buyer_postal_code = $produk->buyer_postal_code;
				$buyer_email = $produk->buyer_email;
				$buyer_request = $produk->buyer_request;
				$payment_method = $produk->payment_method;
				$order_number = $produk->order_number;
				$total_bayar = $produk->total_bayar;
				//data penjual
				$seller_email = $produk->email;
				$nama_toko = $produk->nama_toko;
				$nama_penjual = $produk->nama_pemilik;
				$alamat = $produk->alamat;
				$no_telepon = $produk->no_telepon;
				
				$sql = "update ll_produk SET stok = stok - 1 where id=$id_produk";
				@ $this->db->query($sql);
				
				//send email to seller & buyer
				$seller_mail = "<p>Telah terjadi pembelian dengan informasi sebagai berikut :
				<table>
				<tr><td>Produk</td><td>$nama_produk</td></tr>
				<tr><td>Jumlah Pembelian</td><td>$order_number</td></tr>
				<tr><td>Nama Pembeli</td><td>$buyer_name</td></tr>
				<tr><td>No Telepon</td><td>$buyer_phone</td></tr>
				<tr><td>Email</td><td>$buyer_email</td></tr>
				<tr><td>Alamat Pengiriman</td><td>$buyer_address</td></tr>
				<tr><td>Kode Pos</td><td>$buyer_postal_code</td></tr>
				<tr><td>Permintaan Khusus</td><td>$buyer_request</td></tr>
				<tr><td>Total telah dibayar</td><td>$total_bayar</td></tr>
				<tr><td>Metoda Bayar</td><td>$payment_method</td></tr>
				</table>
				<p>Demikian informasi dari lakulaba. Mohon agar segera diproses
				";
				$buyer_mail ="";
				@ $this->sendgrid_mail->send_mail($seller_email, "Lakulaba", "Informasi transaksi lakulaba", $email_content);
				
				$data['result'] = "Pembayaran sukses dilakukan. Terima Kasih";
				$this->load->view('output',$data);
			}
		}
	}
	
	private function stock_decrease($id_produk){
	}
}
