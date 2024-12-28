<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Psb_model', 'psb');
    }

    public function index()
    {
        is_login(array('5'));
        $data['title'] = 'Konfirmasi Pembayaran';
        $data['walsan'] = $this->psb->user_login($this->session->userdata('username'));
        $data['santri_bayar'] = $this->psb->getId_data($data['walsan']['id_santri'], 'psb_pembayaran', 'santri_pembayaran_id');
        // $data['pembayaran_psb'] = $this->psb->getdata_teratas('psb_jenis_pembayaran', 'id_jenis_pembayaran');
        $data['pembayaran_psb'] = $this->psb->pembayaranPSB_perSantri($data['walsan']['id_santri']);

        $this->form_validation->set_rules('nominal_bayar', 'Nominal Pembayaran', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('pembayaran/index', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $config['upload_path'] = './assets/file_upload_pembayaran/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 512;
            $config['file_name'] = $data['walsan']['id_santri'] . '_' . $data['walsan']['nama_lengkap'] . '_' . $data['walsan']['no_registrasi'];

            $this->load->library('upload', $config);
            // $this->upload->initialize($config);
            if (!$this->upload->do_upload('file_bukti_pembayaran')) {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                return redirect('pembayaran');
            } else {
                $upload_data = $this->upload->data();
                $file_name = $upload_data['file_name'];
                $id_santri = $data['walsan']['id_santri'];
                $nama_file = $data['santri_bayar']['file_bukti_pembayaran'];
                $nominal_bayar = $this->input->post('bayar_nominal');
                // $nominal_bayar = $this->input->post('nominal_bayar');
                $tanggal_bayar = date('Y-m-d H:i:s');

                $dataPembayaran = [
                    'status_pembayaran' => 2, // Tahap telah upload bukti pembayaran dan menunggu validasi
                    'nominal_dibayar' => $nominal_bayar,
                    'file_bukti_pembayaran' => $file_name,
                    'tanggal_bayar' => $tanggal_bayar,
                ];

                if ($nama_file && file_exists('./assets/file_upload_pembayaran/' . $nama_file)) {
                    unlink('./assets/file_upload_pembayaran/' . $nama_file);
                }

                $this->psb->update_data('santri_pembayaran_id', $id_santri, 'psb_pembayaran', $dataPembayaran);
                $this->session->set_flashdata('pesan', 'Pembayaran Berhasil Diajukan.');
                redirect('pembayaran');
            }
        }
    }

    public function pembayaran_santri($id_santri)
    {
        is_login(array('2', '3'));
        $data['title'] = 'Konfirmasi Pembayaran';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        // $data['santri'] = $this->psb->getId_data($id_santri, 'psb_data_santri', 'id_santri');
        $data['santri_bayar'] = $this->psb->getId_data($id_santri, 'psb_pembayaran', 'santri_pembayaran_id');
        // $data['pembayaran_psb'] = $this->psb->getdata_teratas('psb_jenis_pembayaran', 'id_jenis_pembayaran');
        $data['pembayaran_psb'] = $this->psb->pembayaranPSB_perSantri($data['santri_bayar']['santri_pembayaran_id'], $data['santri_bayar']['jepem_id']);

        $this->form_validation->set_rules('nominal_bayar_panitia', 'Nominal Pembayaran', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('pembayaran/pembayaran_santri', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $config['upload_path'] = './assets/file_upload_pembayaran/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 512;
            $config['file_name'] = $id_santri . '_' . $data['santri']['nama_lengkap'] . '_' . $data['santri']['no_registrasi'];

            $this->load->library('upload', $config);
            // $this->upload->initialize($config);
            if (!$this->upload->do_upload('file_bukti_pembayaran')) {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                return redirect('pembayaran');
            } else {
                $upload_data = $this->upload->data();
                $file_name = $upload_data['file_name'];
                // $id_santri = $id_santri;
                $nama_file = $data['santri_bayar']['file_bukti_pembayaran'];
                $nominal_bayar = $this->input->post('bayar_nominal_panitia');
                // $nominal_bayar = $this->input->post('nominal_bayar');
                $tanggal_bayar = date('Y-m-d H:i:s');

                $dataPembayaran = [
                    'pegawai_pembayaran_id' => $data['panitia']['pegawai_psb_id'],
                    'status_pembayaran' => 1, // Tahap telah divalidasi pembayarannya
                    'nominal_dibayar' => $nominal_bayar,
                    'file_bukti_pembayaran' => $file_name,
                    'tanggal_bayar' => $tanggal_bayar,
                ];

                if ($nama_file && file_exists('./assets/file_upload_pembayaran/' . $nama_file)) {
                    unlink('./assets/file_upload_pembayaran/' . $nama_file);
                }

                $this->psb->update_data('santri_pembayaran_id', $id_santri, 'psb_pembayaran', $dataPembayaran);
                $this->session->set_flashdata('pesan', 'Pembayaran Berhasil Diajukan.');
                redirect('pembayaran/pembayaran_santri/' . $id_santri);
            }
        }
    }

    public function jenis_pembayaran()
    {
        is_login(array('4'));
        $data['title'] = 'Jenis Pembayaran';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['DataPembayaran'] = $this->psb->DataPembayaran();
        $data['DataProgram'] = $this->psb->show_data('psb_program_jenjang');
        $data['DataJenjang'] = $this->psb->show_data('psb_tingkat_sekolah');
        $data['DataTapel'] = $this->psb->Data_Tapel();

        $this->form_validation->set_rules('jenis_pembayaran', 'Jenis Pembayaran', 'trim|required');
        $this->form_validation->set_rules('program_pembayaran_id', 'Program Jenjang', 'trim|required');
        $this->form_validation->set_rules('jenjang_pembayaran_id', 'Tingkat / Jenjang Sekolah', 'trim|required');
        $this->form_validation->set_rules('tapel_pembayaran_id', 'Tahun Pelajaran', 'trim|required');
        $this->form_validation->set_rules('nominal_jenis_pembayaran', 'Nominal Jenis Pembayaran', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('pembayaran/jenis_pembayaran', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $jenis_pembayaran = $this->input->post('jenis_pembayaran');
            $program_pembayaran_id = $this->input->post('program_pembayaran_id');
            $jenjang_pembayaran_id = $this->input->post('jenjang_pembayaran_id');
            $tapel_pembayaran_id = $this->input->post('tapel_pembayaran_id');
            $nominal = $this->input->post('nominal_jenis_pembayaran');
            $namarek = $this->input->post('nama_rekening');
            $norek = $this->input->post('no_rek_pembayaran');

            $dataPembayaran =
                [
                    'nama_jenis_pembayaran' => $jenis_pembayaran,
                    'program_pembayaran_id' => $program_pembayaran_id,
                    'jenjang_pembayaran_id' => $jenjang_pembayaran_id,
                    'tapel_pembayaran_id' => $tapel_pembayaran_id,
                    'nominal_jenis_pembayaran' => $nominal,
                    'no_rek_pembayaran' => $norek,
                    'nama_rekening' => $namarek,
                ];

            $this->psb->insert_data($dataPembayaran, 'psb_jenis_pembayaran');
            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan!');
            redirect('pembayaran/jenis_pembayaran');
        }
    }

    public function edit_jenis_pembayaran()
    {
        is_login(array('4'));
        $data['title'] = 'Jenis Pembayaran';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['DataPembayaran'] = $this->psb->DataPembayaran();
        $data['DataProgram'] = $this->psb->show_data('psb_program_jenjang');
        $data['DataJenjang'] = $this->psb->show_data('psb_tingkat_sekolah');
        $data['DataTapel'] = $this->psb->Data_Tapel();

        $this->form_validation->set_rules('jenis_pembayaran_edit', 'Jenis Pembayaran', 'trim|required');
        $this->form_validation->set_rules('program_pembayaran_id_edit', 'Program Jenjang', 'trim|required');
        $this->form_validation->set_rules('jenjang_pembayaran_id_edit', 'Tingkat / Jenjang Sekolah', 'trim|required');
        $this->form_validation->set_rules('tapel_pembayaran_id_edit', 'Tahun Pelajaran', 'trim|required');
        $this->form_validation->set_rules('nominal_jenis_pembayaran_edit', 'Nominal Jenis Pembayaran', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('pembayaran/jenis_pembayaran', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $id_jenis_pembayaran = $this->input->post('id_jenis_pembayaran');
            $program_pembayaran_id = $this->input->post('program_pembayaran_id_edit');
            $jenjang_pembayaran_id = $this->input->post('jenjang_pembayaran_id_edit');
            $tapel_pembayaran_id = $this->input->post('tapel_pembayaran_id_edit');
            $jenis_pembayaran = $this->input->post('jenis_pembayaran_edit');
            $nominal = $this->input->post('nominal_jenis_pembayaran_edit');
            $namarek = $this->input->post('nama_rekening_edit');
            $norek = $this->input->post('no_rek_pembayaran_edit');

            $dataPembayaran =
                [
                    'nama_jenis_pembayaran' => $jenis_pembayaran,
                    'program_pembayaran_id' => $program_pembayaran_id,
                    'jenjang_pembayaran_id' => $jenjang_pembayaran_id,
                    'tapel_pembayaran_id' => $tapel_pembayaran_id,
                    'nominal_jenis_pembayaran' => $nominal,
                    'no_rek_pembayaran' => $norek,
                    'nama_rekening' => $namarek,
                ];

            $this->psb->update_data('id_jenis_pembayaran', $id_jenis_pembayaran, 'psb_jenis_pembayaran', $dataPembayaran);
            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan!');
            redirect('pembayaran/jenis_pembayaran');
        }
    }

    public function hapus_jenis_pembayaran()
    {
        is_login(array('4'));
        $id_jenis_pembayaran = $this->input->post('id_jenis_pembayaran_hapus');
        $this->psb->delete_data('psb_jenis_pembayaran', 'id_jenis_pembayaran', $id_jenis_pembayaran);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus!');
        redirect('pembayaran/jenis_pembayaran');
    }

    public function getTingkat_byProgram()
    {
        $program_tingkat_id = $this->input->post('program_tingkat_id');
        // $data_tingkat = $this->psb->getdata_byID('psb_tingkat_sekolah', 'pogram_tingkat_id', $program_tingkat_id);
        $data_tingkat = $this->psb->data_tingkat_byprogram($program_tingkat_id);
        echo json_encode($data_tingkat);
    }

    public function validasi_pembayaran()
    {
        is_login(array('4'));
        $data['title'] = 'Validasi Pembayaran Santri';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['dataValidasiBayar'] = $this->psb->dataValidasiBayar();

        $this->load->view('template/manage_header', $data);
        $this->load->view('template/manage_navbar', $data);
        $this->load->view('pembayaran/validasi_pembayaran', $data);
        $this->load->view('template/manage_footer', $data);
    }

    public function okevalidasi()
    {
        $panitia = $this->psb->user_login($this->session->userdata('username'));
        $id_pembayaran = $this->input->post('id_pembayaran_validasi');

        $dataPembayaran = [
            'pegawai_pembayaran_id' => $panitia['pegawai_psb_id'], // Tahap telah divalidasi pembayarannya
            'status_pembayaran' => 1, // Tahap telah divalidasi pembayarannya
        ];

        $this->psb->update_data('id_pembayaran', $id_pembayaran, 'psb_pembayaran', $dataPembayaran);
        $this->session->set_flashdata('pesan', 'Validasi Pembayaran Berhasil.');
        redirect('pembayaran/validasi_pembayaran');
    }
}
