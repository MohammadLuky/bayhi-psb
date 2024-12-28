<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registrasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Psb_model', 'psb');
    }

    public function index()
    {
        $data['title'] = 'Registrasi | PSB PP. Bayt Alhikmah';
        $data['tapel'] = $this->psb->show_data('psb_tahun_pelajaran');
        $data['provinsi'] = $this->psb->show_data('psb_master_provinsi');
        $data['progjen'] = $this->psb->show_data('psb_program_jenjang');
        // $data['progjen'] = $this->psb->data_tingkat_program();

        $this->form_validation->set_rules('tapel_regis', 'Tahun Pelajaran', 'trim|required');
        $this->form_validation->set_rules('prog_jen', 'Program Jenjang', 'trim|required');
        $this->form_validation->set_rules('nama_santri_regis', 'Nama Santri', 'trim|required');
        $this->form_validation->set_rules('no_telp_regis', 'Nomor HP Wali Santri', 'required|trim|is_unique[psb_akun.username]', [
            'is_unique' => 'Nomor HP ini Sudah Terdaftar!'
        ]);
        $this->form_validation->set_rules('alamat_regis', 'Alamat Santri', 'trim|required');
        $this->form_validation->set_rules('prov_regis', 'Provinsi', 'trim|required');
        $this->form_validation->set_rules('kotakab_regis', 'Kota/Kabupaten', 'trim|required');
        $this->form_validation->set_rules('kec_regis', 'Kecamatan', 'trim|required');
        $this->form_validation->set_rules('kel_regis', 'Kelurahan', 'trim|required');
        $this->form_validation->set_rules('asal_sekolah_regis', 'Asal Sekolah', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]|matches[repeat_password]', [
            'matches' => 'Password tidak cocok!',
            'min_length' => 'Password terlalu pendek! Minimal 8 Karakter.'
        ]);
        $this->form_validation->set_rules('repeat_password', 'Konfirmasi Password', 'required|trim|matches[password]');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/login_header', $data);
            $this->load->view('registrasi/index', $data);
            $this->load->view('template/login_footer', $data);
        } else {

            $no_registrasi      = $this->psb->generate_id();
            $tapel_regis        = $this->input->post('tapel_regis');
            $prog_jen           = $this->input->post('prog_jen');
            $tingkat_regis      = $this->input->post('tingkat_regis');
            $nama_santri_regis  = $this->input->post('nama_santri_regis');
            $no_telp_regis      = $this->input->post('no_telp_regis');
            $alamat_regis       = $this->input->post('alamat_regis');
            $kel_regis          = $this->input->post('kel_regis');
            $asal_sekolah_regis = $this->input->post('asal_sekolah_regis');
            $password           = $this->input->post('password');

            $dataSantri =
                [
                    'no_registrasi' => $no_registrasi,
                    'nama_lengkap' => $nama_santri_regis,
                    'alamat' => $alamat_regis,
                    'desa_kelurahan_id' => $kel_regis,
                    'foto_santri' => 'akun.jpg',
                    'nohp_ayah' => $no_telp_regis,
                    'tapel_inden_id' => $tapel_regis,
                    'asal_sekolah' => $asal_sekolah_regis,
                    'program_jenjang_id' => $prog_jen,
                    'daftar_tingkat_id' => $tingkat_regis,
                    'status_santri' => 2, // status pengisian data
                    'tgl_inden' => date('Y-m-d'),
                ];

            // var_dump($dataSantri);
            // die;
            $this->psb->insert_data($dataSantri, 'psb_data_santri');
            $id_santri =  $this->db->insert_id();

            $dataAkunSantri =
                [
                    'santri_id' => $id_santri,
                    'pegawai_psb_id' => 0,
                    'username' => $no_telp_regis,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'pass_tampil' => $password,
                    'role_id' => 5,
                ];
            $this->psb->insert_data($dataAkunSantri, 'psb_akun');

            $get_id_jenis_pembayaran = $this->psb->getIDjepem_byRegis($prog_jen, $tingkat_regis, $tapel_regis); // $program, $jenjang, $tapel
            $jepem_id = $get_id_jenis_pembayaran['id_jenis_pembayaran']; // masih mencari formula
            var_dump($jepem_id);
            die;
            $dataPembayaran =
                [
                    'santri_pembayaran_id' => $id_santri,
                    'jepem_id' => $jepem_id,
                    'status_pembayaran' => 0, // Tahap menunggu upload bukti pembayaran
                ];
            $this->psb->insert_data($dataPembayaran, 'psb_pembayaran');

            $this->session->set_flashdata('pesan_regis', '<div class="alert alert-success alert-dismissible fade show" role="alert">
  			<strong>Selamat !!!</strong>
			<br> Kamu telah terdaftar sebagai Santri Baru PP. Bayt Al-hikmah.
			<br> Segera lengkapi data Kamu, ya. Semangat.
  			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>');
            return redirect('auth');
        }
    }

    public function getTingkat_byProgram()
    {
        $program_tingkat_id = $this->input->post('program_tingkat_id');
        // $data_tingkat = $this->psb->getdata_byID('psb_tingkat_sekolah', 'pogram_tingkat_id', $program_tingkat_id);
        $data_tingkat = $this->psb->data_tingkat_byprogram($program_tingkat_id);
        echo json_encode($data_tingkat);
    }

    public function getKota_byProv()
    {
        $id_prov = $this->input->post('id_prov');
        $data_kota = $this->psb->getdata_byID('psb_master_kotakab', 'prov_id', $id_prov);
        echo json_encode($data_kota);
    }

    public function getKec_byKota()
    {
        $id_kota = $this->input->post('id_kota');
        $data_kec = $this->psb->getdata_byID('psb_master_kecamatan', 'kota_kab_id', $id_kota);
        echo json_encode($data_kec);
    }

    public function getKel_byKec()
    {
        $id_kec = $this->input->post('id_kec');
        $data_kel = $this->psb->getdata_byID('psb_master_kelurahan', 'kec_id', $id_kec);
        echo json_encode($data_kel);
    }
}
