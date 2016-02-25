<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once( APPPATH . 'libraries/Facebook/autoload.php' );

class Welcome extends CI_Controller {
	
	public function index()
	{
		$this->load->view('login');
	}
	
	public function login()
	{
		
		$this->load->view('login');
	}
	
	public function tanggal()
		{
			$d = strtotime("now");
			echo "<p>". date('YmdHis',$d);
			echo "<p>". date('YmdHis',strtotime("+1 day",$d));
		}
		
	public function login_callback()
	{
		
		//session_start();
		//$this->load->view('facebook_login_ok');
		$fb = new Facebook\Facebook([
		  'app_id' => $this->config->item('fb_app_id'),
		  'app_secret' => $this->config->item('fb_app_secret'),
		  'default_graph_version' => 'v2.2',
		  ]);

		$helper = $fb->getRedirectLoginHelper();

		try {
		  $accessToken = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}

		if (! isset($accessToken)) {
		  if ($helper->getError()) {
			header('HTTP/1.0 401 Unauthorized');
			echo "Error: " . $helper->getError() . "\n";
			echo "Error Code: " . $helper->getErrorCode() . "\n";
			echo "Error Reason: " . $helper->getErrorReason() . "\n";
			echo "Error Description: " . $helper->getErrorDescription() . "\n";
		  } else {
			header('HTTP/1.0 400 Bad Request');
			echo 'Bad request';
		  }
		  exit;
		}

		$_SESSION['fb_access_token'] = (string) $accessToken;
		
		$this->get_profile($accessToken);
		//header('Location: https://example.com/members.php');
		
	}
	
	public function login_tw(){
		require_once (APPPATH . 'libraries/codebird/src/codebird.php');
		\Codebird\Codebird::setConsumerKey($this->config->item('tw_app_key'), $this->config->item('tw_app_secret')); // static, see README
		$cb = \Codebird\Codebird::getInstance();
		
		//session_start();
		
		$callback_url = base_url('welcome/login_tw');
		//echo "<p>" . $callback_url;
		  
		if (! isset($_SESSION['oauth_token'])) {
		  // get the request token
		  
		  $reply = $cb->oauth_requestToken([
			'oauth_callback' => '' . $callback_url
		  ]);
		  //'oauth_callback' => 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']
		  // store the token
		  $cb->setToken($reply->oauth_token, $reply->oauth_token_secret);
		  $_SESSION['oauth_token'] = $reply->oauth_token;
		  $_SESSION['oauth_token_secret'] = $reply->oauth_token_secret;
		  $_SESSION['oauth_verify'] = true;

		  // redirect to auth website
		  $auth_url = $cb->oauth_authorize();
		  header('Location: ' . $auth_url);
		  die();

		} elseif (isset($_GET['oauth_verifier']) && isset($_SESSION['oauth_verify'])) {
		  // verify the token
		  $cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
		  unset($_SESSION['oauth_verify']);

		  // get the access token
		  $reply = $cb->oauth_accessToken([
			'oauth_verifier' => $_GET['oauth_verifier']
		  ]);

		  // store the token (which is different from the request token!)
		  $_SESSION['oauth_token'] = $reply->oauth_token;
		  $_SESSION['oauth_token_secret'] = $reply->oauth_token_secret;

		  // send to same URL, without oauth GET parameters
		  header('Location: ' . basename(__FILE__));
		  die();
		}
		
		// assign access token on each page load
		$cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
		$reply = $cb->account_verifyCredentials();
		$this->registration($reply->id_str, $reply->name, "");
	}
	public function login_callback_tw()
	{
		//require_once (APPPATH . 'libraries/codebird/src/codebird.php');
		//\Codebird\Codebird::setConsumerKey($this->config->item('tw_app_key'), $this->config->item('tw_app_secret')); // static, see README
		//$cb = \Codebird\Codebird::getInstance();
		
		//echo "<p>" . "login twitter berhasil";
		$this->login_tw();
		

	}
	public function get_profile($token)
	{
		$fb = new Facebook\Facebook([
		  'app_id' => $this->config->item('fb_app_id'),
		  'app_secret' => $this->config->item('fb_app_secret'),
		  'default_graph_version' => 'v2.2',
		  ]);

		try {
		  // Returns a `Facebook\FacebookResponse` object
		  $response = $fb->get('/me?fields=id,name,email', $token);
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}

		$user = $response->getGraphUser();
		$_SESSION['fb_id_user'] = (string) $user['id'];
		$_SESSION['fb_name'] = (string) $user['name'];
		$this->session->set_userdata('user_id',$_SESSION['fb_id_user']);
		//echo "<p>" . 'Id: ' . $user['id'];
		//echo "<p>" . 'Name: ' . $user['name'];
		$this->registration($user['id'], $user['name'], $user['email']);
	}
	
	/*fungsi ini dipanggil pertama kali setelah login dari fb atau tw. 
	id_user : id facebook atau id twitter yang diperoleh saat login oauth
	nama_user : nama user yang diperoleh dari fb atau tw
	email : email user yang diperoleh dari facebook atau twitter
	*/
	public function registration($id_user='', $nama_user='', $email='')
	{
		//cek apakah id user terdaftar di tabel users
		$this->load->database();
		$this->load->model('Users_model');
		$value = $this->Users_model->find_id_sosmed($id_user);
		$data['id_user']=$id_user;
		$data['name']=$nama_user;
		$data['email']=$email;
		$this->session->set_userdata('id_user', $id_user);
		if ($value==0) {
			$this->session->set_userdata('is_login', 'false');
			$this->load->view('registration',$data);
		} else {
			$this->session->set_userdata('is_login', 'true');
			$this->dashboard();
		}
	}
	
	public function daftar_pembayaran(){
		$id_user = $this->session->userdata('user_id');
		$sql = "SELECT ll_produk.nama_produk,
			   ll_transaksi.payment_method,
			   ll_transaksi.buyer_id,
			   ll_transaksi.buyer_name,
			   ll_transaksi.buyer_address,
			   ll_transaksi.status,
			   ll_produk.user_id
				FROM lakulaba.ll_produk ll_produk
				INNER JOIN lakulaba.ll_transaksi ll_transaksi
				  ON (ll_produk.id = ll_transaksi.id_produk)
				WHERE     (ll_transaksi.status = '1')
				AND (ll_produk.user_id = '$id_user')";
		$this->load->database();
		$result['data'] = $this->db->query($sql)->result();
		$this->load->view('header');
		$this->load->view('daftar_transaksi',$result);
		$this->load->view('footer');
	}
	public function dashboard(){
		//check apakah user telah login atau tidak
		if ($this->session->userdata('is_login')=='true'){
			$this->load->database();
			$id_user = $this->session->userdata('user_id');
			$data["data_produk"] = $this->produk->get_produk($id_user);
			
			$this->load->view('header');
			$this->load->view('dashboard',$data);
			$this->load->view('footer');
		}
	}
	
	public function tambah_produk(){
		$this->load->view('header');
		$this->load->view('produk');
		$this->load->view('footer');
	}
	
	public function edit_produk(){
		$id_produk = $_GET['id'];
		$data["data_produk"] = $this->produk->get_produk_id($id_produk);
		$this->load->view('header');
		//print_r($data);
		$this->load->view('edit_produk',$data);
		$this->load->view('footer');
	}

	public function setting_account()
	{
		# code...
		$id_user = $this->session->userdata('user_id');
		$this->load->model('Users_model');
		$value = $this->Users_model->get_user_data($id_user);
		$data['users'] = $value;
		$this->load->view('header');
		$this->load->view('setting_account',$data);
		//print_r($data);
		$this->load->view('footer');
	}

	public function proses_edit_account()
	{
		# code...
		if ($this->session->userdata('is_login')=='true') {
			$data = array(
							'nama_toko' => $this->input->post('nama_toko'), 
							'alamat' => $this->input->post('alamat'), 
							'no_telepon' => $this->input->post('no_telepon')
						);
			$id_user = $this->session->userdata('user_id');

			$this->db->where('id_sosmed',$id_user);
			$update = $this->db->update('ll_users',$data);

			if ($update) {
				# code...
				redirect('welcome/dashboard','location');
			} else {
				echo "gagal update";
			}

		} else {
			redirect('welcome/dashboard','location');
		}

	}

	public function proses_edit_produk()
	{
		# code...
		if ($this->session->userdata('is_login')=='true') {
			# code...
			$url = $_SERVER['HTTP_REFERER'];
			$a = explode("=", $url);

			//print_r($a);
			$data = array(
							'nama_produk' => $this->input->post('nama_produk'), 
							'deskripsi' => $this->input->post('deskripsi'), 
							'harga_jual' => $this->input->post('harga_jual'), 
							'biaya_pengiriman' => $this->input->post('biaya_pengiriman'), 
							'stok' => $this->input->post('stok'), 
							'status_jual' => $this->input->post('active') 
						);
			$this->db->where('id',$a[1]);
			$update = $this->db->update('ll_produk',$data);

			if ($update) {
				# code...
				redirect('welcome/dashboard','location');
			} else {
				echo "gagal update";
			}

		} else {
			redirect('welcome/dashboard','location');
		}
	}
	
	public function random()
	{
		$length = 6;

		$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

		echo $randomString;
		
	}
	public function produk(){
		$this->load->database();
		$this->load->helper('form');
		$this->form_validation->set_rules('nama_produk','Nama Produk','required');
		//$this->form_validation->set_rules('gambar_produk','Gambar Produk','required');
		$this->form_validation->set_rules('deskripsi','Deskripsi','required');
		$this->form_validation->set_rules('harga_jual','Harga Jual','required');
		$this->form_validation->set_rules('biaya_pengiriman','Biaya Pengiriman','required');
		$this->form_validation->set_rules('stok','Stok','required');
		
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '10000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);
		
		if ($this->form_validation->run() === FALSE)
		{
			//
			$this->load->view('header');
			$this->load->view('produk');
			$this->load->view('footer');
		}
		else{
			if ($this->upload->do_upload('gambar_produk')) {
				$data = $this->upload->data();
				$this->produk->insert(
					$this->input->post('nama_produk'),
					$data['file_name'],
					$this->input->post('deskripsi'),
					$this->input->post('harga_jual'),
					$this->input->post('biaya_pengiriman'),
					$this->input->post('stok'),
					$this->session->userdata('user_id')
				);
				//$this->session->set_userdata('status_produk', 'Data produk berhasil dimasukkan');
				$this->load->view('header');
				$this->load->view('produk');
				$this->load->view('footer');
			} else
			{
				echo $this->upload->display_errors();
			}
		}
	}
	public function registration_insert()
	{
		$this->load->database();
		$this->load->helper('form');
		$this->form_validation->set_rules('nama_toko', 'Nama_toko', 'required');
		$this->form_validation->set_rules('nama_pemilik', 'Nama_pemilik', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('no_telepon', 'No_telepon', 'required');
		$this->form_validation->set_rules('no_ecash', 'No_ecash', 'required');
		$data['id_user'] = $this->input->post('id_user');
		$data['name'] = $this->input->post('nama_pemilik');
		$data['email'] = $this->input->post('email');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('registration',$data);
		}
		else{
			$this->Users_model->insert(
			$this->input->post('id_user'),
			$this->input->post('email'),
			$this->input->post('nama_toko'),
			$this->input->post('nama_pemilik'),
			$this->input->post('alamat'),
			$this->input->post('no_telepon'),
			$this->input->post('no_ecash')
			);
			$this->session->set_userdata('id_user', $this->input->post('id_user'));
			$this->dashboard();
		}

	}
	
	
	public function tes()
	{
		$this->load->database();
		$this->load->model('Users_model');
		$this->Users_model->insert('tes1','tes2','tes3','tes4','tes5','tes6');
	}
	
	public function tes2()
	{
		$this->load->database();
		$this->load->model('Users_model');
		$this->Users_model->find_id_sosmed('tes11');
	}
	
}
