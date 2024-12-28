<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penilaian extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Psb_model', 'psb');
        $this->load->library('curl');
        // is_login(array('1'));
    }

    public function index()
    {
        is_login(array('1'));
        $data['title'] = 'Jenis Penilaian';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['DataPenilaian'] = $this->psb->datapenilaian();
        $data['penilai'] = $this->psb->datapenilai_noadmin();

        $this->form_validation->set_rules('nama_penilaian', 'Nama Penilaian', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('penilaian/index', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $nama_penilaian = $this->input->post('nama_penilaian');

            $dataPenilaian =
                [
                    'nama_penilaian' => $nama_penilaian,
                ];

            $this->psb->insert_data($dataPenilaian, 'psb_jenis_penilaian');
            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan!');
            redirect('penilaian');
        }
    }

    public function edit_penilaian()
    {
        is_login(array('1'));
        $data['title'] = 'Jenis Penilaian';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['DataPenilaian'] = $this->psb->datapenilaian();
        $data['penilai'] = $this->psb->show_data('psb_data_pegawai');

        $this->form_validation->set_rules('nama_penilaian_edit', 'Nama Penilaian', 'trim|required');
        $this->form_validation->set_rules('penilai_id', 'Penilai', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('penilaian/index', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $nama_penilaian = $this->input->post('nama_penilaian_edit');
            $penilai_id = $this->input->post('penilai_id');
            $id_jenis_penilaian = $this->input->post('id_jenis_penilaian');

            $dataPenilaian =
                [
                    'nama_penilaian' => $nama_penilaian,
                    'penilai_id' => $penilai_id,
                ];

            $this->psb->update_data('id_jenis_penilaian', $id_jenis_penilaian, 'psb_jenis_penilaian', $dataPenilaian);
            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan!');
            redirect('penilaian');
        }
    }

    public function hapus_penilaian()
    {
        is_login(array('1'));
        $id_jenis_penilaian = $this->input->post('id_jenis_penilaian_hapus');
        $this->psb->delete_data('psb_jenis_penilaian', 'id_jenis_penilaian', $id_jenis_penilaian);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus!');
        redirect('penilaian');
    }

    public function input_penilaian()
    {
        is_login(array('7'));
        $data['title'] = 'Input Penilaian';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['DataPenilaian'] = $this->psb->datapenilaian();
        $data['DataJadwal'] = $this->psb->jadwal_aktif();

        $this->load->view('template/manage_header', $data);
        $this->load->view('template/manage_navbar', $data);
        $this->load->view('penilaian/input_penilaian', $data);
        $this->load->view('template/manage_footer', $data);
    }

    public function filter_penilaian()
    {
        $jenis_penilaian_id = $this->input->post('jenis_penilaian_id');
        $jadwal_penilaian_id = $this->input->post('jadwal_penilaian_id');

        // Query untuk mendapatkan data berdasarkan filter
        $this->db->select('*');
        $this->db->from('psb_hasil_penilaian');
        $this->db->join('psb_data_santri', 'psb_data_santri.id_santri=hasil_santri_id', 'left');
        $this->db->join('psb_data_pegawai', 'psb_data_pegawai.id_pegawai_psb=pegawai_penilaian_id', 'left');
        $this->db->join('psb_jenis_penilaian', 'psb_jenis_penilaian.id_jenis_penilaian=jenis_penilaian_id', 'left');
        $this->db->join('psb_jadwal_tes', 'psb_jadwal_tes.id_jadwal_tes=jadwal_penilaian_id', 'left');
        $this->db->where('jenis_penilaian_id', $jenis_penilaian_id);
        $this->db->where('jadwal_penilaian_id', $jadwal_penilaian_id);
        $query = $this->db->get();
        $filtered_data = $query->result_array();

        // Tampilkan data dalam bentuk tabel di dalam card
        $output = '<div class="card mb-2"><div class="card-header bg-primary">';
        $output .= '<h6 class="m-0 font-weight-bold text-white">Input Penilaian</h6></div>';
        $output .= '<div class="card-body">';
        $output .= '<table id="editable_table" class="table table-bordered table-striped" width="100%" cellspacing="0">';
        $output .= '<thead style="background-color: teal;" class="text-white text-center"><tr><th>No</th><th>Nama Santri</th><th>Nilai</th><th>Deskripsi</th><th>Hasil</th><th>Panitia Penilai</th></tr></thead><tbody>';

        $no = 1;
        foreach ($filtered_data as $row) {
            $output .= '<tr>';
            $output .= '<td>' . $no++ . '</td>';
            $output .= '<td style="display:none;">' . $row['id_hasil_penilaian'] . '</td>';
            $output .= '<td>' . $row['nama_lengkap'] . '</td>';
            $output .= '<td>' . $row['nilai'] . '</td>';
            $output .= '<td>' . $row['deskripsi_penilaian'] . '</td>';
            $output .= '<td>' . $row['hasil'] . '</td>';
            $output .= '<td>' . $row['nama_lengkap_pegawai'] . '</td>';
            $output .= '</tr>';
        }

        $output .= '</tbody></table></div></div>';

        echo $output;
    }

    public function update_penilaian()
    {
        header('Content-Type: application/json');
        $dataPanitia = $this->psb->user_login($this->session->userdata('username'));
        $id_hasil_penilaian = $this->input->post('id_hasil_penilaian');
        $nilai = $this->input->post('nilai');
        $deskripsi = $this->input->post('deskripsi_penilaian');
        // $deskripsi = $this->input->post('deskripsi_penilaian2');
        $hasil_nilai = $this->input->post('hasil_nilai');
        $action = $this->input->post('action');

        if (!is_numeric($nilai)) {
            echo json_encode(array('success' => false, 'message' => 'Nilai harus berupa angka.'));
            return;
        }

        if (empty($deskripsi)) {
            echo json_encode(array('success' => false, 'message' => 'Deskripsi tidak boleh kosong.'));
            return;
        }

        if ($action == 'edit') {

            $dataPenilaian =
                array(
                    'nilai' => (int)$nilai,
                    'deskripsi_penilaian' => htmlspecialchars($deskripsi, ENT_QUOTES),
                    'pegawai_penilaian_id' => $dataPanitia['id_pegawai_psb'],
                    'hasil' => htmlspecialchars($hasil_nilai, ENT_QUOTES)
                );

            $update = $this->psb->update_data('id_hasil_penilaian', $id_hasil_penilaian, 'psb_hasil_penilaian', $dataPenilaian);

            if ($update) {
                echo json_encode(array('success' => false, 'message' => 'Gagal memperbarui data.'));
            } else {
                echo json_encode(array('success' => true, 'message' => 'Data berhasil diperbarui.'));
            }
        }
    }

    public function sync_nilaiesantri()
    {
        is_login(array('1'));
        $data['title'] = 'Data Sikronisasi Penilaian';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['DataSyncPenilaian'] = $this->psb->sync_nilaiesantri_tesAkademik();

        $this->load->view('template/manage_header', $data);
        $this->load->view('template/manage_navbar', $data);
        $this->load->view('penilaian/sync_nilaiesantri', $data);
        $this->load->view('template/manage_footer', $data);
    }

    public function getsync_nilaiesantri()
    {
        is_login(array('1'));
        $url = 'http://36.95.178.42:8080/data_api/api/nilaiujian';

        $response = $this->curl->simple_get($url);

        // $data = json_decode($response, true);
        if ($response) {
            $data = json_decode($response, true);

            if ($data['status'] == 'success') {
                foreach ($data['data'] as $item) {
                    $id_santri = $item['no_peserta'];

                    $item['total'] = $item['total'] ?? 0.0;

                    $dataPenilaian = [
                        'nilai' => $item['total'],
                    ];

                    $id_tes_akademik = $this->psb->getTesAkademik();

                    $psb_hasil_penilaian = $this->psb->getIDhasilNilaibySantri_Tesakademik($id_tes_akademik['id_jenis_penilaian'], $id_santri);
                    // var_dump($psb_hasil_penilaian);
                    // die;

                    if ($this->psb->checkIfExists($id_santri, 'hasil_santri_id', 'psb_hasil_penilaian')) {
                        if ($psb_hasil_penilaian['nilai'] == 0) {
                            $this->psb->update_data('id_hasil_penilaian', $psb_hasil_penilaian['id_hasil_penilaian'], 'psb_hasil_penilaian', $dataPenilaian);
                        }
                    }
                }

                $this->session->set_flashdata('pesan', 'Data Berhasil diambil dari API dan diupdate ke database!');
                redirect('penilaian/sync_nilaiesantri');
            } else {
                $this->session->set_flashdata('pesan', 'Gagal mengambil data dari API!');
                redirect('penilaian/sync_nilaiesantri');
            }
        } else {
            $this->session->set_flashdata('pesan', 'Gagal mengambil data dari API!');
            redirect('penilaian/sync_nilaiesantri');
        }
    }
}
