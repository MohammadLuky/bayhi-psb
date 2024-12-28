<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kesehatan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Psb_model', 'psb');
        is_login(array('8'));
    }

    public function index()
    {
        $data['title'] = 'Hasil Tes Kesehatan';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        // $data['DataPenilaian'] = $this->psb->datapenilaian();
        $data['DataJadwal'] = $this->psb->jadwal_aktif();

        $this->load->view('template/manage_header', $data);
        $this->load->view('template/manage_navbar', $data);
        $this->load->view('kesehatan/index', $data);
        $this->load->view('template/manage_footer', $data);
    }

    public function filter_kesehatan()
    {
        $jadwal_kesehatan_id = $this->input->post('jadwal_kesehatan_id');

        // Query untuk mendapatkan data berdasarkan filter
        $this->db->select('*');
        $this->db->from('psb_hasil_kesehatan');
        $this->db->join('psb_data_santri', 'psb_data_santri.id_santri=kesehatan_santri_id', 'left');
        $this->db->join('psb_data_pegawai', 'psb_data_pegawai.id_pegawai_psb=pegawai_kesehatan_id', 'left');
        $this->db->join('psb_jadwal_tes', 'psb_jadwal_tes.id_jadwal_tes=jadwal_kesehatan_id', 'left');
        $this->db->where('jadwal_kesehatan_id', $jadwal_kesehatan_id);
        $query = $this->db->get();
        $filtered_data = $query->result_array();

        // Tampilkan data dalam bentuk tabel di dalam card
        $output = '<div class="card mb-2"><div class="card-header bg-primary">';
        $output .= '<h6 class="m-0 font-weight-bold text-white">Input Tes Kesehatan</h6></div>';
        $output .= '<div class="card-body">';
        $output .= '<table id="tesKesehatan_table" class="table table-bordered table-striped" width="100%" cellspacing="0">';
        $output .= '<thead style="background-color: teal;" class="text-white text-center"><tr><th>No</th><th>Nama Santri</th><th>Deskripsi</th><th>Hasil Pemeriksaan</th><th>Panitia Kesehatan</th></tr></thead><tbody>';

        $no = 1;
        foreach ($filtered_data as $row) {
            $output .= '<tr>';
            $output .= '<td>' . $no++ . '</td>';
            $output .= '<td style="display:none;">' . $row['id_hasil_kesehatan'] . '</td>';
            $output .= '<td>' . $row['nama_lengkap'] . '</td>';
            $output .= '<td>' . $row['deskripsi_kesehatan'] . '</td>';
            $output .= '<td>' . $row['hasil'] . '</td>';
            $output .= '<td>' . $row['nama_lengkap_pegawai'] . '</td>';
            $output .= '</tr>';
        }

        $output .= '</tbody></table></div></div>';

        echo $output;
    }

    public function update_kesehatan()
    {
        header('Content-Type: application/json');
        $dataPanitia = $this->psb->user_login($this->session->userdata('username'));
        $id_hasil_kesehatan = $this->input->post('id_hasil_kesehatan');
        $hasil = $this->input->post('hasil');
        $deskripsi_kesehatan = $this->input->post('deskripsi_kesehatan');
        $action = $this->input->post('action');


        if (empty($deskripsi_kesehatan)) {
            echo json_encode(array('success' => false, 'message' => 'Deskripsi tidak boleh kosong.'));
            return;
        }

        if ($action == 'edit') {

            $dataKesehatan =
                array(
                    'pegawai_kesehatan_id' => $dataPanitia['id_pegawai_psb'],
                    'deskripsi_kesehatan' => htmlspecialchars($deskripsi_kesehatan, ENT_QUOTES),
                    'hasil' => htmlspecialchars($hasil, ENT_QUOTES)
                );

            $update = $this->psb->update_data('id_hasil_kesehatan', $id_hasil_kesehatan, 'psb_hasil_kesehatan', $dataKesehatan);

            if ($update) {
                echo json_encode(array('success' => false, 'message' => 'Gagal memperbarui data.'));
            } else {
                echo json_encode(array('success' => true, 'message' => 'Data berhasil diperbarui.'));
            }
        }
    }
}
