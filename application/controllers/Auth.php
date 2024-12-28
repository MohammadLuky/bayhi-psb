<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Psb_model', 'psb');
	}

	public function index()
	{
		if ($this->session->userdata('username')) {
			redirect('dashboard');
		}

		$data['title'] = 'Login | PSB PP. Bayt Alhikmah';
		$this->form_validation->set_rules('no_walsan', 'Nomor Ayah Santri', 'trim|required');
		$this->form_validation->set_rules('password_walsan', 'Password', 'trim|required');

		if ($this->form_validation->run() == false) {
			$this->load->view('template/login_header', $data);
			$this->load->view('login/index', $data);
			$this->load->view('template/login_footer', $data);
		} else {
			// validasinya success
			$this->_login();
		}
	}

	private function _login()
	{
		$username = $this->input->post('no_walsan');
		$password = $this->input->post('password_walsan');

		// baru
		$session_santri = $this->psb->getsession_auth($username);

		if ($session_santri) {
			if (password_verify($password, $session_santri['password'])) {
				$data = [
					'username' => $session_santri['username'],
					'role_id' => $session_santri['role_id'],
				];
				$this->session->set_userdata($data);
				redirect('dashboard');
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Password Kamu Salah! :(, Cek Lagi, ya.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			Nomor Ayah Santri tidak terdaftar! <br>:(. Cek Lagi, ya.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>');
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('role_id');

		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
			Anda Sudah Logout!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>');
		redirect('auth');
	}
}
