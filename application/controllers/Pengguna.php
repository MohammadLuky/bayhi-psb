<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Psb_model', 'psb');
        is_login(array('1'));
    }

    public function index()
    {
        $data['title'] = 'Data Pegawai';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['AllPegawai'] = $this->psb->allpegawaipsb();
        $data['role'] = $this->psb->show_data('psb_role');
        $data['tingkat'] = $this->psb->show_data('psb_tingkat_sekolah');

        $this->form_validation->set_rules('niy_pegawai', 'Nomor Telp Pegawai', 'trim|required');
        $this->form_validation->set_rules('nama_lengkap_pegawai', 'Nama Pegawai', 'trim|required');
        $this->form_validation->set_rules('role_id', 'Role', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('pengguna/index', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $niy_pegawai = $this->input->post('niy_pegawai');
            $nama_lengkap_pegawai = $this->input->post('nama_lengkap_pegawai');
            $role_id = $this->input->post('role_id');

            $datapegawai =
                [
                    'niy_pegawai'     => $niy_pegawai,
                    'nama_lengkap_pegawai'  => $nama_lengkap_pegawai,
                    'unit_tugas_id' => 0,
                    'foto_pegawai' => 'akun.jpg',
                    'status_aktif' => 1
                ];

            $this->psb->insert_data($datapegawai, 'psb_data_pegawai');

            $pegawai_psb_id = $this->db->insert_id();

            $dataakun =
                [
                    'pegawai_psb_id'     => $pegawai_psb_id,
                    'username'  => $niy_pegawai,
                    'password' => password_hash($niy_pegawai, PASSWORD_DEFAULT),
                    'pass_tampil' => $niy_pegawai,
                    'role_id' => $role_id
                ];

            $this->psb->insert_data($dataakun, 'psb_akun');

            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan!');
            redirect('pengguna');
        }
    }

    public function edit_role_pegawai()
    {
        $data['title'] = 'Data Pegawai';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['AllPegawai'] = $this->psb->allpegawaipsb();
        $data['role'] = $this->psb->show_data('psb_role');
        $data['tingkat'] = $this->psb->show_data('psb_tingkat_sekolah');

        $this->form_validation->set_rules('role_id_edit', 'Role', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('pengguna/index', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $pegawai_psb_id = $this->input->post('pegawai_psb_id');
            $role_id = $this->input->post('role_id_edit');

            $dataakun =
                [
                    'role_id' => $role_id
                ];

            $this->psb->update_data('pegawai_psb_id', $pegawai_psb_id, 'psb_akun', $dataakun);
            $this->session->set_flashdata('pesan', 'Data Berhasil Diubah!');
            redirect('pengguna');
        }
    }

    public function edit_unit_tugas()
    {
        $data['title'] = 'Data Pegawai';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['AllPegawai'] = $this->psb->allpegawaipsb();
        $data['role'] = $this->psb->show_data('psb_role');
        $data['tingkat'] = $this->psb->show_data('psb_tingkat_sekolah');

        $this->form_validation->set_rules('unit_tugas_edit', 'Unit Tugas', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('pengguna/index', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $id_pegawai_psb = $this->input->post('pegawai_id_tingkat');
            $unit_tugas_edit = $this->input->post('unit_tugas_edit');

            $datapegawai =
                [
                    'unit_tugas_id' => $unit_tugas_edit
                ];

            $this->psb->update_data('id_pegawai_psb', $id_pegawai_psb, 'psb_data_pegawai', $datapegawai);
            $this->session->set_flashdata('pesan', 'Data Berhasil Diubah!');
            redirect('pengguna');
        }
    }

    public function hapus_pengguna()
    {
        $id_pegawai_psb = $this->input->post('id_pegawai_psb_hapus');
        $this->psb->delete_data('psb_data_pegawai', 'id_pegawai_psb', $id_pegawai_psb);
        $this->psb->delete_data('psb_akun', 'pegawai_psb_id', $id_pegawai_psb);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus!');
        redirect('pengguna');
    }
}
