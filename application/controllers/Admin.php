<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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

		$data['title'] = 'Login Admin | PSB PP. Bayt Alhikmah';
		$this->form_validation->set_rules('niy_pegawai_login', 'NIY Pegawai', 'trim|required');
		$this->form_validation->set_rules('password_admin', 'Password Admin', 'trim|required');

		if ($this->form_validation->run() == false) {
			$this->load->view('template/login_header', $data);
			$this->load->view('login/admin', $data);
			$this->load->view('template/login_footer', $data);
		} else {
			// validasinya success
			$this->_loginAdmin();
		}
	}

	private function _loginAdmin()
	{
		$username = $this->input->post('niy_pegawai_login');
		$password = $this->input->post('password_admin');

		// baru
		$session_pegawai = $this->psb->getsession_auth($username);

		if ($session_pegawai) {
			if (password_verify($password, $session_pegawai['password'])) {
				if ($session_pegawai['status_aktif'] != 0) {
					$data = [
						'username' => $session_pegawai['username'],
						'role_id' => $session_pegawai['role_id']
					];
					$this->session->set_userdata($data);
					redirect('dashboard');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					Akun Anda belum aktif!<br>
					Segera Hubungi Administrator.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>');
					redirect('admin');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Password Anda Salah!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>');
				redirect('admin');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			Username tidak terdaftar!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>');
			redirect('admin');
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
		redirect('admin');
	}
}
