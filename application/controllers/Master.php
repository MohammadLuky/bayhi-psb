<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Psb_model', 'psb');
        $this->load->library('curl');
        is_login(array('1'));
    }

    public function index()
    {
        $data['title'] = 'Data Master';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));

        $this->load->view('template/manage_header', $data);
        $this->load->view('template/manage_navbar', $data);
        $this->load->view('master/index', $data);
        $this->load->view('template/manage_footer', $data);
    }

    public function tapel()
    {
        $data['title'] = 'Data Tahun Pelajaran';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['AllTapel'] = $this->psb->show_data('psb_tahun_pelajaran');

        $this->form_validation->set_rules('ket_tapel', 'Tahun Pelajaran', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('master/data_tapel', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $ket_tapel = $this->input->post('ket_tapel');

            $dataTapel =
                [
                    'ket_tapel'     => $ket_tapel,
                    'status_tapel'  => 1
                ];

            $this->psb->insert_data($dataTapel, 'psb_tahun_pelajaran');
            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan!');
            redirect('master/tapel');
        }
    }

    public function edit_tapel()
    {
        $data['title'] = 'Data Tahun Pelajaran';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['AllTapel'] = $this->psb->show_data('psb_tahun_pelajaran');

        $this->form_validation->set_rules('ket_tapel_edit', 'Tahun Pelajaran', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('master/data_tapel', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $id_tapel = $this->input->post('id_tapel');
            $ket_tapel = $this->input->post('ket_tapel_edit');

            $dataTapel =
                [
                    'ket_tapel'     => $ket_tapel
                ];

            $this->psb->update_data('id_tapel', $id_tapel, 'psb_tahun_pelajaran', $dataTapel);
            $this->session->set_flashdata('pesan', 'Data Berhasil Diubah!');
            redirect('master/tapel');
        }
    }

    public function nonaktif_tapel()
    {
        $id_tapel = $this->input->post('id_tapel_nonaktif');
        $dataTapel =
            [
                'status_tapel'     => 0
            ];

        $this->psb->update_data('id_tapel', $id_tapel, 'psb_tahun_pelajaran', $dataTapel);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dinon-Aktifkan!');
        redirect('master/tapel');
    }

    public function hapus_tapel()
    {
        $id_tapel = $this->input->post('id_tapel_hapus');
        $this->psb->delete_data('psb_tahun_pelajaran', 'id_tapel', $id_tapel);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus!');
        redirect('master/tapel');
    }

    public function program_jenjang()
    {
        $data['title'] = 'Data Program Jenjang';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['AllProgram'] = $this->psb->show_data('psb_program_jenjang');

        $this->form_validation->set_rules('nama_program', 'Program Jenjang', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('master/data_program_jenjang', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $nama_program = $this->input->post('nama_program');

            $dataProgram =
                [
                    'nama_program'     => $nama_program,
                ];

            $this->psb->insert_data($dataProgram, 'psb_program_jenjang');
            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan!');
            redirect('master/program_jenjang');
        }
    }

    public function edit_program()
    {
        $data['title'] = 'Data Tahun Pelajaran';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['AllProgram'] = $this->psb->show_data('psb_program_jenjang');

        $this->form_validation->set_rules('nama_program_edit', 'Tahun Pelajaran', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('master/data_tapel', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $id_program_jenjang = $this->input->post('id_program_jenjang');
            $nama_program = $this->input->post('nama_program_edit');

            $dataProgram =
                [
                    'nama_program'     => $nama_program
                ];

            $this->psb->update_data('id_program_jenjang', $id_program_jenjang, 'psb_program_jenjang', $dataProgram);
            $this->session->set_flashdata('pesan', 'Data Berhasil Diubah!');
            redirect('master/program_jenjang');
        }
    }

    public function hapus_program()
    {
        $id_program_jenjang = $this->input->post('id_program_jenjang_hapus');
        $this->psb->delete_data('psb_program_jenjang', 'id_program_jenjang', $id_program_jenjang);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus!');
        redirect('master/program_jenjang');
    }

    public function tingkat_sekolah()
    {
        $data['title'] = 'Data Tingkat Sekolah';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['Alltingkat'] = $this->psb->show_data('psb_tingkat_sekolah');
        // $data['Alltingkat'] = $this->psb->join2_tables('psb_tingkat_sekolah', 'psb_program_jenjang', 'id_program_jenjang', 'pogram_tingkat_id');
        // $data['progjen'] = $this->psb->show_data('psb_program_jenjang');

        $this->form_validation->set_rules('nama_tingkat', 'Nama Tingkat', 'trim|required');
        // $this->form_validation->set_rules('pogram_tingkat_id', 'Program Jenjang', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('master/data_tingkat', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $nama_tingkat = $this->input->post('nama_tingkat');
            // $pogram_tingkat_id = $this->input->post('pogram_tingkat_id');

            $datatingkat =
                [
                    'nama_tingkat'  => $nama_tingkat,
                    // 'pogram_tingkat_id' => $pogram_tingkat_id
                ];

            $this->psb->insert_data($datatingkat, 'psb_tingkat_sekolah');
            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan!');
            redirect('master/tingkat_sekolah');
        }
    }

    public function edit_tingkat()
    {
        $data['title'] = 'Data Tingkat Sekolah';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['Alltingkat'] = $this->psb->show_data('psb_tingkat_sekolah');
        // $data['Alltingkat'] = $this->psb->join2_tables('psb_tingkat_sekolah', 'psb_program_jenjang', 'id_program_jenjang', 'pogram_tingkat_id');
        // $data['progjen'] = $this->psb->show_data('psb_program_jenjang');

        $this->form_validation->set_rules('nama_tingkat_edit', 'Nama Tingkat', 'trim|required');
        // $this->form_validation->set_rules('pogram_tingkat_id_edit', 'Program Jenjang', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('master/data_tingkat', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $id_tingkat_sekolah = $this->input->post('id_tingkat_sekolah');
            $nama_tingkat = $this->input->post('nama_tingkat_edit');
            // $pogram_tingkat_id = $this->input->post('pogram_tingkat_id_edit');

            $datatingkat =
                [
                    'nama_tingkat'  => $nama_tingkat,
                    // 'pogram_tingkat_id' => $pogram_tingkat_id
                ];

            $this->psb->update_data('id_tingkat_sekolah', $id_tingkat_sekolah, 'psb_tingkat_sekolah', $datatingkat);
            $this->session->set_flashdata('pesan', 'Data Berhasil Diubah!');
            redirect('master/tingkat_sekolah');
        }
    }

    public function hapus_tingkat()
    {
        $id_tingkat_sekolah = $this->input->post('id_tingkat_sekolah_hapus');
        $this->psb->delete_data('psb_tingkat_sekolah', 'id_tingkat_sekolah', $id_tingkat_sekolah);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus!');
        redirect('master/tingkat_sekolah');
    }

    public function data_tingkat_program()
    {
        $data['title'] = 'Data Tingkat Dan Program';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['DataTingProg'] = $this->psb->data_tingkat_program();
        $data['DataTingkat'] = $this->psb->show_data('psb_tingkat_sekolah');
        $data['DataProgram'] = $this->psb->show_data('psb_program_jenjang');

        $this->form_validation->set_rules('data_pogram_id', 'Nama Tingkat', 'trim|required');
        $this->form_validation->set_rules('data_tingkat_id', 'Program Jenjang', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('master/data_tingkat_program', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $nama_tingkat = $this->input->post('data_pogram_id');
            $pogram_tingkat_id = $this->input->post('data_tingkat_id');

            $datatingkat =
                [
                    'data_pogram_id'  => $nama_tingkat,
                    'data_tingkat_id' => $pogram_tingkat_id
                ];

            $this->psb->insert_data($datatingkat, 'psb_data_tingkat_program');
            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan!');
            redirect('master/data_tingkat_program');
        }
    }

    public function edit_tingkat_program()
    {
        $data['title'] = 'Data Tingkat Dan Program';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['DataTingProg'] = $this->psb->data_tingkat_program();

        $this->form_validation->set_rules('data_pogram_id_edit', 'Nama Tingkat', 'trim|required');
        $this->form_validation->set_rules('data_tingkat_id_edit', 'Program Jenjang', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('master/data_tingkat_program', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $id_data_tingkat_program = $this->input->post('id_data_tingkat_program');
            $nama_tingkat = $this->input->post('data_pogram_id_edit');
            $pogram_tingkat_id = $this->input->post('data_tingkat_id_edit');

            $dataTingProg =
                [
                    'data_pogram_id'  => $nama_tingkat,
                    'data_tingkat_id' => $pogram_tingkat_id
                ];

            $this->psb->update_data('id_data_tingkat_program', $id_data_tingkat_program, 'psb_data_tingkat_program', $dataTingProg);
            $this->session->set_flashdata('pesan', 'Data Berhasil Diubah!');
            redirect('master/data_tingkat_program');
        }
    }

    public function hapus_tingkat_program()
    {
        $id_data_tingkat_program = $this->input->post('id_data_tingkat_program_hapus');
        $this->psb->delete_data('psb_data_tingkat_program', 'id_data_tingkat_program', $id_data_tingkat_program);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus!');
        redirect('master/data_tingkat_program');
    }

    public function data_tahap()
    {
        $data['title'] = 'Data Tahap';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['AllTahap'] = $this->psb->show_data('psb_tahap');

        $this->form_validation->set_rules('nama_tahap', 'Nama Tahap', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('master/data_tahap', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $nama_tahap = $this->input->post('nama_tahap');

            $dataTahap =
                [
                    'nama_tahap'     => $nama_tahap,
                ];

            $this->psb->insert_data($dataTahap, 'psb_tahap');
            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan!');
            redirect('master/data_tahap');
        }
    }

    public function edit_tahap()
    {
        $data['title'] = 'Data Tahap';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['AllTahap'] = $this->psb->show_data('psb_tahap');

        $this->form_validation->set_rules('nama_tahap_edit', 'Nama Tahap', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('master/data_tahap', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $id_tahap = $this->input->post('id_tahap');
            $nama_tahap = $this->input->post('nama_tahap_edit');

            $dataTahap =
                [
                    'nama_tahap'     => $nama_tahap
                ];

            $this->psb->update_data('id_tahap', $id_tahap, 'psb_tahap', $dataTahap);
            $this->session->set_flashdata('pesan', 'Data Berhasil Diubah!');
            redirect('master/data_tahap');
        }
    }

    public function hapus_tahap()
    {
        $id_tahap = $this->input->post('id_tahap_hapus');
        $this->psb->delete_data('psb_tahap', 'id_tahap', $id_tahap);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus!');
        redirect('master/data_tahap');
    }

    public function data_pelengkap()
    {
        $data['title'] = 'Data Master';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));

        $this->load->view('template/manage_header', $data);
        $this->load->view('template/manage_navbar', $data);
        $this->load->view('master/data_pelengkap', $data);
        $this->load->view('template/manage_footer', $data);
    }

    public function agama()
    {
        $data['title'] = 'Data Agama';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['AllAgama'] = $this->psb->show_data('psb_agama');

        $this->form_validation->set_rules('nama_agama', 'Agama', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('master/agama', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $nama_agama = $this->input->post('nama_agama');

            $dataAgama =
                [
                    'nama_agama'     => $nama_agama
                ];

            $this->psb->insert_data($dataAgama, 'psb_agama');
            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan!');
            redirect('master/agama');
        }
    }

    public function edit_agama()
    {
        $data['title'] = 'Data Agama';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['AllAgama'] = $this->psb->show_data('psb_agama');

        $this->form_validation->set_rules('nama_agama_edit', 'Agama', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('master/agama', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $id_agama = $this->input->post('id_agama');
            $nama_agama = $this->input->post('nama_agama_edit');

            $dataAgama =
                [
                    'nama_agama'     => $nama_agama
                ];

            $this->psb->update_data('id_agama', $id_agama, 'psb_agama', $dataAgama);
            $this->session->set_flashdata('pesan', 'Data Berhasil Diubah!');
            redirect('master/agama');
        }
    }

    public function hapus_agama()
    {
        $id_agama = $this->input->post('id_agama_hapus');
        $this->psb->delete_data('psb_agama', 'id_agama', $id_agama);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus!');
        redirect('master/agama');
    }

    public function get_agama_api()
    {
        $url = 'http://localhost/e-pegawai/apidata/data_agama';

        $response = $this->curl->simple_get($url);

        $data = json_decode($response, true);
        // var_dump($data);
        // die;

        if ($data) {
            foreach ($data as $item) {
                $id_agama = $item['id_agama'];
                $dataAgama = [
                    'id_agama'      => $item['id_agama'],
                    'nama_agama'    => $item['nama_agama'],
                ];

                // $this->psb->insert_data($dataAgama, 'psb_agama');
                if ($this->psb->checkIfExists($id_agama, 'id_agama', 'psb_agama')) {

                    $this->psb->update_data('id_agama', $id_agama, 'psb_agama', $dataAgama);
                } else {
                    $this->psb->insert_data($dataAgama, 'psb_agama');
                }
            }
        } else {
            echo json_encode('status', 'Data Tidak ada');
        }

        $this->session->set_flashdata('pesan', 'Data Berhasil Diduplikat dari API.');
        redirect('master/agama');
    }

    public function kebutuhan_khusus()
    {
        $data['title'] = 'Data Kebutuhan Khusus';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['Allkebsus'] = $this->psb->show_data('psb_kebutuhan_khusus');

        $this->form_validation->set_rules('ket_kebutuhan_khusus', 'Keterangan Kebutuhan Khusus', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('master/kebutuhan_khusus', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $ket_kebsus = $this->input->post('ket_kebutuhan_khusus');

            $dataKebsus =
                [
                    'ket_kebutuhan_khusus'     => $ket_kebsus
                ];

            $this->psb->insert_data($dataKebsus, 'psb_kebutuhan_khusus');
            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan!');
            redirect('master/kebutuhan_khusus');
        }
    }

    public function edit_kebutuhan_khusus()
    {
        $data['title'] = 'Data Kebutuhan Khusus';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['Allkebsus'] = $this->psb->show_data('psb_kebutuhan_khusus');

        $this->form_validation->set_rules('ket_kebutuhan_khusus_edit', 'Keterangan Kebutuhan Khusus', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('master/kebutuhan_khusus', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $id_kebutuhan_khusus = $this->input->post('id_kebutuhan_khusus');
            $ket_kebsus = $this->input->post('ket_kebutuhan_khusus_edit');

            $dataKebsus =
                [
                    'ket_kebutuhan_khusus'     => $ket_kebsus
                ];

            $this->psb->update_data('id_kebutuhan_khusus', $id_kebutuhan_khusus, 'psb_kebutuhan_khusus', $dataKebsus);
            $this->session->set_flashdata('pesan', 'Data Berhasil Diubah!');
            redirect('master/kebutuhan_khusus');
        }
    }

    public function hapus_kebutuhan_khusus()
    {
        $id_kebutuhan_khusus = $this->input->post('id_kebutuhan_khusus_hapus');
        $this->psb->delete_data('psb_kebutuhan_khusus', 'id_kebutuhan_khusus', $id_kebutuhan_khusus);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus!');
        redirect('master/kebutuhan_khusus');
    }

    public function alat_tranportasi()
    {
        $data['title'] = 'Data Alat Transportasi';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['AllTransport'] = $this->psb->show_data('psb_alat_transportasi');

        $this->form_validation->set_rules('nama_transportasi', 'Nama Alat Transportasi', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('master/alat_transportasi', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $nama_transportasi = $this->input->post('nama_transportasi');

            $dataTransport =
                [
                    'nama_transportasi'     => $nama_transportasi
                ];

            $this->psb->insert_data($dataTransport, 'psb_alat_transportasi');
            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan!');
            redirect('master/alat_tranportasi');
        }
    }

    public function edit_alat_tranportasi()
    {
        $data['title'] = 'Data Alat Transportasi';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['AllTransport'] = $this->psb->show_data('psb_alat_transportasi');

        $this->form_validation->set_rules('nama_transportasi_edit', 'Nama Alat Transportasi', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('master/alat_transportasi', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $nama_transportasi = $this->input->post('nama_transportasi_edit');
            $id_transportasi = $this->input->post('id_transportasi');

            $dataTransport =
                [
                    'nama_transportasi'     => $nama_transportasi
                ];

            $this->psb->update_data('id_transportasi', $id_transportasi, 'psb_alat_transportasi', $dataTransport);
            $this->session->set_flashdata('pesan', 'Data Berhasil Diubah!');
            redirect('master/alat_tranportasi');
        }
    }

    public function hapus_alat_tranportasi()
    {
        $id_transportasi = $this->input->post('id_transportasi_hapus');
        $this->psb->delete_data('psb_alat_transportasi', 'id_transportasi', $id_transportasi);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus!');
        redirect('master/alat_tranportasi');
    }

    public function pendidikan_ortu()
    {
        $data['title'] = 'Data Pendidikan Orang Tua';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['AllPendOrtu'] = $this->psb->show_data('psb_pendidikan_ortu');

        $this->form_validation->set_rules('nama_pendidikan_ortu', 'Nama Pendidikan Orang Tua', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('master/pendidikan_ortu', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $nama_pendidikan_ortu = $this->input->post('nama_pendidikan_ortu');

            $dataPendOrtu =
                [
                    'nama_pendidikan_ortu'     => $nama_pendidikan_ortu
                ];

            $this->psb->insert_data($dataPendOrtu, 'psb_pendidikan_ortu');
            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan!');
            redirect('master/pendidikan_ortu');
        }
    }

    public function edit_pendidikan_ortu()
    {
        $data['title'] = 'Data Pendidikan Orang Tua';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['AllPendOrtu'] = $this->psb->show_data('psb_pendidikan_ortu');

        $this->form_validation->set_rules('nama_pendidikan_ortu_edit', 'Nama Pendidikan Orang Tua', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('master/pendidikan_ortu', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $id_pendidikan_ortu = $this->input->post('id_pendidikan_ortu');
            $nama_pendidikan_ortu = $this->input->post('nama_pendidikan_ortu_edit');

            $dataPendOrtu =
                [
                    'nama_pendidikan_ortu'     => $nama_pendidikan_ortu
                ];

            $this->psb->update_data('id_pendidikan_ortu', $id_pendidikan_ortu, 'psb_pendidikan_ortu', $dataPendOrtu);
            $this->session->set_flashdata('pesan', 'Data Berhasil Diubah!');
            redirect('master/pendidikan_ortu');
        }
    }

    public function hapus_pendidikan_ortu()
    {
        $id_pendidikan_ortu = $this->input->post('id_pendidikan_ortu_hapus');
        $this->psb->delete_data('psb_pendidikan_ortu', 'id_pendidikan_ortu', $id_pendidikan_ortu);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus!');
        redirect('master/pendidikan_ortu');
    }

    public function pekerjaan_ortu()
    {
        $data['title'] = 'Data Pekerjaan Orang Tua';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['AllKerjaOrtu'] = $this->psb->show_data('psb_pekerjaan_ortu');

        $this->form_validation->set_rules('jenis_pekerjaan', 'Nama Pendidikan Orang Tua', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('master/pekerjaan_ortu', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $jenis_pekerjaan = $this->input->post('jenis_pekerjaan');

            $datakerjaOrtu =
                [
                    'jenis_pekerjaan'     => $jenis_pekerjaan
                ];

            $this->psb->insert_data($datakerjaOrtu, 'psb_pekerjaan_ortu');
            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan!');
            redirect('master/pekerjaan_ortu');
        }
    }

    public function edit_pekerjaan_ortu()
    {
        $data['title'] = 'Data Pekerjaan Orang Tua';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['AllKerjaOrtu'] = $this->psb->show_data('psb_pekerjaan_ortu');

        $this->form_validation->set_rules('jenis_pekerjaan_edit', 'Nama Pendidikan Orang Tua', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('master/pekerjaan_ortu', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $jenis_pekerjaan = $this->input->post('jenis_pekerjaan_edit');
            $id_pekerjaan_ortu = $this->input->post('id_pekerjaan_ortu');

            $datakerjaOrtu =
                [
                    'jenis_pekerjaan'     => $jenis_pekerjaan
                ];

            $this->psb->update_data('id_pekerjaan_ortu', $id_pekerjaan_ortu, 'psb_pekerjaan_ortu', $datakerjaOrtu);
            $this->session->set_flashdata('pesan', 'Data Berhasil Diubah!');
            redirect('master/pekerjaan_ortu');
        }
    }

    public function hapus_pekerjaan_ortu()
    {
        $id_pekerjaan_ortu = $this->input->post('id_pekerjaan_ortu_hapus');
        $this->psb->delete_data('psb_pekerjaan_ortu', 'id_pekerjaan_ortu', $id_pekerjaan_ortu);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus!');
        redirect('master/pekerjaan_ortu');
    }

    public function penghasilan_ortu()
    {
        $data['title'] = 'Data Penghasilan Orang Tua';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['AllHasilOrtu'] = $this->psb->show_data('psb_penghasilan_ortu');

        $this->form_validation->set_rules('range_penghasilan', 'Range Penghasilan Orang Tua', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('master/penghasilan_ortu', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $range_penghasilan = $this->input->post('range_penghasilan');

            $dataHasilOrtu =
                [
                    'range_penghasilan'     => $range_penghasilan
                ];

            $this->psb->insert_data($dataHasilOrtu, 'psb_penghasilan_ortu');
            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan!');
            redirect('master/penghasilan_ortu');
        }
    }

    public function edit_penghasilan_ortu()
    {
        $data['title'] = 'Data Penghasilan Orang Tua';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['AllKerjaOrtu'] = $this->psb->show_data('psb_penghasilan_ortu');

        $this->form_validation->set_rules('range_penghasilan_edit', 'Nama Pendidikan Orang Tua', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('master/penghasilan_ortu', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $range_penghasilan = $this->input->post('range_penghasilan_edit');
            $id_penghasilan_ortu = $this->input->post('id_penghasilan_ortu');

            $datakerjaOrtu =
                [
                    'range_penghasilan'     => $range_penghasilan
                ];

            $this->psb->update_data('id_penghasilan_ortu', $id_penghasilan_ortu, 'psb_penghasilan_ortu', $datakerjaOrtu);
            $this->session->set_flashdata('pesan', 'Data Berhasil Diubah!');
            redirect('master/penghasilan_ortu');
        }
    }

    public function hapus_penghasilan_ortu()
    {
        $id_penghasilan_ortu = $this->input->post('id_penghasilan_ortu_hapus');
        $this->psb->delete_data('psb_penghasilan_ortu', 'id_penghasilan_ortu', $id_penghasilan_ortu);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus!');
        redirect('master/penghasilan_ortu');
    }

    public function data_provinsi()
    {
        $data['title'] = 'Data Provinsi';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['AllProv'] = $this->psb->show_data('psb_master_provinsi');

        $this->load->view('template/manage_header', $data);
        $this->load->view('template/manage_navbar', $data);
        $this->load->view('master/provinsi', $data);
        $this->load->view('template/manage_footer', $data);
    }

    public function get_provinsi_api()
    {
        $url = 'http://localhost/e-pegawai/apidata/provinsi_indo';

        $response = $this->curl->simple_get($url);

        $data = json_decode($response, true);

        if ($data) {
            foreach ($data as $item) {
                $id_provinsi = $item['id_provinsi'];
                $dataProv = [
                    'id_provinsi'      => $item['id_provinsi'],
                    'nama_provinsi'    => $item['nama_provinsi'],
                ];

                // $this->psb->insert_data($dataProv, 'psb_master_provinsi');
                if ($this->psb->checkIfExists($id_provinsi, 'id_provinsi', 'psb_master_provinsi')) {

                    $this->psb->update_data('id_provinsi', $id_provinsi, 'psb_master_provinsi', $dataProv);
                } else {
                    $this->psb->insert_data($dataProv, 'psb_master_provinsi');
                }
            }
        } else {
            echo json_encode('status', 'Data Tidak ada');
        }

        $this->session->set_flashdata('pesan', 'Data Berhasil Diduplikat dari API.');
        redirect('master/data_provinsi');
    }

    public function data_kotakab()
    {
        $data['title'] = 'Data Kota Kabupaten';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['Allkotakab'] = $this->psb->show_data('psb_master_kotakab');

        $this->load->view('template/manage_header', $data);
        $this->load->view('template/manage_navbar', $data);
        $this->load->view('master/kota_kab', $data);
        $this->load->view('template/manage_footer', $data);
    }

    public function get_kotakab_api()
    {
        $url = 'http://localhost/e-pegawai/apidata/kotakab_indo';

        $response = $this->curl->simple_get($url);

        $data = json_decode($response, true);

        if ($data) {
            foreach ($data as $item) {
                $id_kota_kab = $item['id_kota_kab'];
                $dataProv = [
                    'id_kota_kab'       => $item['id_kota_kab'],
                    'prov_id'           => $item['prov_id'],
                    'nama_kota_kab'     => $item['nama_kota_kab'],
                ];

                // $this->psb->insert_data($dataProv, 'psb_master_provinsi');
                if ($this->psb->checkIfExists($id_kota_kab, 'id_kota_kab', 'psb_master_kotakab')) {

                    $this->psb->update_data('id_kota_kab', $id_kota_kab, 'psb_master_kotakab', $dataProv);
                } else {
                    $this->psb->insert_data($dataProv, 'psb_master_kotakab');
                }
            }
        } else {
            echo json_encode('status', 'Data Tidak ada');
        }

        $this->session->set_flashdata('pesan', 'Data Berhasil Diduplikat dari API.');
        redirect('master/data_kotakab');
    }

    public function data_kecamatan()
    {
        $data['title'] = 'Data Kecamatan';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['Allkecamatan'] = $this->psb->show_data('psb_master_kecamatan');

        $this->load->view('template/manage_header', $data);
        $this->load->view('template/manage_navbar', $data);
        $this->load->view('master/kecamatan', $data);
        $this->load->view('template/manage_footer', $data);
    }

    public function get_kecamatan_api()
    {
        $url = 'http://localhost/e-pegawai/apidata/kecamatan_indo';

        $response = $this->curl->simple_get($url);

        $data = json_decode($response, true);

        if ($data) {
            foreach ($data as $item) {
                $id_kec = $item['id_kec'];
                $dataProv = [
                    'id_kec'       => $item['id_kec'],
                    'kota_kab_id'           => $item['kota_kab_id'],
                    'nama_kecamatan'     => $item['nama_kecamatan'],
                ];

                // $this->psb->insert_data($dataProv, 'psb_master_provinsi');
                if ($this->psb->checkIfExists($id_kec, 'id_kec', 'psb_master_kecamatan')) {

                    $this->psb->update_data('id_kec', $id_kec, 'psb_master_kecamatan', $dataProv);
                } else {
                    $this->psb->insert_data($dataProv, 'psb_master_kecamatan');
                }
            }
        } else {
            echo json_encode('status', 'Data Tidak ada');
        }

        $this->session->set_flashdata('pesan', 'Data Berhasil Diduplikat dari API.');
        redirect('master/data_kecamatan');
    }

    public function data_kelurahan()
    {
        $data['title'] = 'Data Kelurahan';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['Allkelurahan'] = $this->psb->show_data('psb_master_kelurahan');

        $this->load->view('template/manage_header', $data);
        $this->load->view('template/manage_navbar', $data);
        $this->load->view('master/kelurahan', $data);
        $this->load->view('template/manage_footer', $data);
    }

    public function get_kelurahan_api()
    {
        $url = 'http://localhost/e-pegawai/apidata/kelurahan_indo';

        $response = $this->curl->simple_get($url);

        $data = json_decode($response, true);

        if ($data) {
            foreach ($data as $item) {
                $id_kel = $item['id_kel'];
                $dataProv = [
                    'id_kel'       => $item['id_kel'],
                    'kec_id'           => $item['kec_id'],
                    'nama_kelurahan'     => $item['nama_kelurahan'],
                ];

                // $this->psb->insert_data($dataProv, 'psb_master_provinsi');
                if ($this->psb->checkIfExists($id_kel, 'id_kel', 'psb_master_kelurahan')) {

                    $this->psb->update_data('id_kel', $id_kel, 'psb_master_kelurahan', $dataProv);
                } else {
                    $this->psb->insert_data($dataProv, 'psb_master_kelurahan');
                }
            }
        } else {
            echo json_encode('status', 'Data Tidak ada');
        }

        $this->session->set_flashdata('pesan', 'Data Berhasil Diduplikat dari API.');
        redirect('master/data_kelurahan');
    }
}
