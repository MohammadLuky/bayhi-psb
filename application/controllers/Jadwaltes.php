<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwaltes extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Psb_model', 'psb');
        is_login(array('3'));
    }

    public function index()
    {
        $data['title'] = 'Input Jadwal';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['JadwalTes'] = $this->psb->jadwal_tes();
        $data['AllTahap'] = $this->psb->show_data('psb_tahap');
        $data['Tapel'] = $this->psb->show_data('psb_tahun_pelajaran');
        $data['nama_hari'] = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum`at', 'Sabtu',];

        $this->form_validation->set_rules('nama_jadwal', 'Nama Jadwal', 'trim|required');
        $this->form_validation->set_rules('tahap_id', 'Tahap', 'trim|required');
        $this->form_validation->set_rules('nama_hari', 'Nama Hari', 'trim|required');
        $this->form_validation->set_rules('tanggal_tes', 'Tanggal Tes', 'trim|required');
        $this->form_validation->set_rules('tempat_tes', 'Tempat Tes', 'trim|required');
        $this->form_validation->set_rules('tapel_jadwal_id', 'Tahun Pelajaran', 'trim|required');
        $this->form_validation->set_rules('waktu_tes', 'Waktu Pelaksanaan', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('jadwal_tes/index', $data);
            $this->load->view('template/manage_footer', $data);
        } else {

            $dataJadwal =
                [
                    'nama_jadwal' => htmlspecialchars($this->input->post('nama_jadwal')),
                    'tahap_id' => htmlspecialchars($this->input->post('tahap_id')),
                    'nama_hari' => htmlspecialchars($this->input->post('nama_hari')),
                    'tanggal_tes' => htmlspecialchars($this->input->post('tanggal_tes')),
                    'tempat_tes' => htmlspecialchars($this->input->post('tempat_tes')),
                    'waktu_tes' => htmlspecialchars($this->input->post('waktu_tes')),
                    'tapel_jadwal_id' => htmlspecialchars($this->input->post('tapel_jadwal_id')),
                    'status_jadwal' => 1,
                ];

            $this->psb->insert_data($dataJadwal, 'psb_jadwal_tes');
            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan!');
            redirect('jadwaltes');
        }
    }

    // public function nonaktif_jadwal()
    public function hapus_jadwal()
    {
        $id_jadwal_tes = $this->input->post('id_jadwal_tes_nonaktif');

        // $dataJadwalTes =
        //     [
        //         'status_jadwal' => 0,
        //     ];

        $this->psb->delete_data('psb_jadwal_tes', 'id_jadwal_tes', $id_jadwal_tes);
        // $this->psb->update_data('id_jadwal_tes', $id_jadwal_tes, 'psb_jadwal_tes', $dataJadwalTes);

        $dataantrian =
            [
                'jadwal_tes_id' => 0,
                'status_antrian_santri' => 0,
            ];

        $this->psb->update_data('jadwal_tes_id', $id_jadwal_tes, 'psb_antrian_jadwal', $dataantrian);

        // $this->session->set_flashdata('pesan', 'Data Berhasil Di Non-aktifkan!');
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus!');
        redirect('jadwaltes');
    }

    public function jadwal_selesai()
    {
        $id_jadwal_tes = $this->input->post('id_jadwal_tes_selesai');

        $dataJadwalTes =
            [
                'status_jadwal' => 2,
            ];
        $this->psb->update_data('id_jadwal_tes', $id_jadwal_tes, 'psb_jadwal_tes', $dataJadwalTes);
        $this->session->set_flashdata('pesan', 'Data Berhasil Diselesaikan!');
        redirect('jadwaltes');
    }

    public function kuota_jadwal($id_jadwal_tes)
    {
        $data['title'] = 'Kuota Jadwal';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['IDjadwal'] = $this->psb->getjadwal_satu($id_jadwal_tes);
        $data['AntrianTesbytahap'] = $this->psb->antrian_tes_bytahap($data['IDjadwal']['tahap_id'], $data['IDjadwal']['tapel_jadwal_id']);
        $data['AntrianTes_perjadwal'] = $this->psb->antrian_tes_byjadwal($id_jadwal_tes);

        $next_tahap = $this->psb->getnext_data('psb_tahap', $data['IDjadwal']['tahap_id'], 'id_tahap');
        $data['tahap_berikutnya'] = $next_tahap;

        $this->load->view('template/manage_header', $data);
        $this->load->view('template/manage_navbar', $data);
        $this->load->view('jadwal_tes/antrian_tes', $data);
        $this->load->view('template/manage_footer', $data);
    }

    public function tambah_kuota($id_antrian_jadwal, $id_jadwal_tes)
    {
        $data['IDjadwal'] = $this->psb->getjadwal_satu($id_jadwal_tes);
        $tahap_ini = $data['IDjadwal']['tahap_id'];
        $max_santri = 30;
        $jumlah_santri = $this->psb->count_by_category('jadwal_tes_id', 'psb_antrian_jadwal', $id_jadwal_tes);

        if ($jumlah_santri >= $max_santri) {
            $this->session->set_flashdata('pesan', 'Kuota Santri Telah Mencapai Batas Maksimal Pada Jadwal Tersebut!');
            redirect('jadwaltes/kuota_jadwal/' . $id_jadwal_tes);
        } else {

            $dataantrian =
                [
                    'jadwal_tes_id'             => $id_jadwal_tes,
                    'antrian_tahap_id'          => $tahap_ini,
                    'status_antrian_santri'     => 1,
                ];


            $this->psb->update_data('id_antrian_jadwal', $id_antrian_jadwal, 'psb_antrian_jadwal', $dataantrian);

            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambah!');
            redirect('jadwaltes/kuota_jadwal/' . $id_jadwal_tes);
        }
    }

    public function tahap_ini($id_santri, $id_jadwal_tes, $id_antrian_jadwal)
    {
        $data['IDjadwal'] = $this->psb->getjadwal_satu($id_jadwal_tes);
        $tahap_ini = $data['IDjadwal']['tahap_id'];
        $max_santri = 30;
        $jumlah_santri = $this->psb->count_by_category('jadwal_tes_id', 'psb_antrian_jadwal', $id_jadwal_tes);

        if ($jumlah_santri >= $max_santri) {
            $this->session->set_flashdata('pesan', 'Kuota Santri Telah Mencapai Batas Maksimal Pada Jadwal Tersebut!');
            redirect('jadwaltes/kuota_jadwal/' . $id_jadwal_tes);
        } else {

            $dataantrian =
                [
                    'jadwal_tes_id'             => $id_jadwal_tes,
                    'antrian_tahap_id'          => $tahap_ini,
                    'status_antrian_santri'     => 1,
                ];

            $this->psb->update_data('id_antrian_jadwal', $id_antrian_jadwal, 'psb_antrian_jadwal', $dataantrian);

            $jenis_penilaian = $this->psb->show_data('psb_jenis_penilaian');

            foreach ($jenis_penilaian as $penilaian) {
                $dataPenilaian[] = array(
                    'hasil_santri_id' => $id_santri,
                    'jenis_penilaian_id' => $penilaian['id_jenis_penilaian'],
                    'jadwal_penilaian_id' => $id_jadwal_tes,
                );
            }

            $this->psb->insert_data_batch($dataPenilaian, 'psb_hasil_penilaian');

            $dataWawancara = [
                'wawancara_api_santri_id' => $id_santri,
                'wawancara_jadwal_api_id' => $id_jadwal_tes,
            ];

            $this->psb->insert_data($dataWawancara, 'psb_hasil_wawancara_api');

            $dataWawancara_A = [
                'wawancara_santri_id' => $id_santri,
                'item_jenis_wawancara_id' => 11,
                'jadwal_wawancara_id' => $id_jadwal_tes,
            ];

            $this->psb->insert_data($dataWawancara_A, 'psb_hasil_wawancara');
            // $item_jenis_wawancara = $this->psb->wawancara_byItem();

            // foreach ($item_jenis_wawancara as $wawancara) {
            //     $dataWawancara[] = array(
            //         'wawancara_santri_id' => $id_santri,
            //         'item_jenis_wawancara_id' => $wawancara['id_item_jenis_wawancara'],
            //         'jadwal_wawancara_id' => $id_jadwal_tes,
            //     );
            // }

            // $this->psb->insert_data_batch($dataWawancara, 'psb_hasil_wawancara');

            $dataKesehatan =
                [
                    'kesehatan_santri_id'   => $id_santri,
                    'jadwal_kesehatan_id'   => $id_jadwal_tes,
                ];

            $this->psb->insert_data($dataKesehatan, 'psb_hasil_kesehatan');

            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambah!');
            redirect('jadwaltes/kuota_jadwal/' . $id_jadwal_tes);
        }
    }

    public function tahap_selanjutnya($id_santri, $id_jadwal_tes, $id_antrian_jadwal)
    {
        $data['IDjadwal'] = $this->psb->getjadwal_satu($id_jadwal_tes);
        $tahap_ini = $data['IDjadwal']['tahap_id'];
        $next_tahap = $this->psb->getnext_data('psb_tahap', $data['IDjadwal']['tahap_id'], 'id_tahap');

        $max_santri = 30;
        $jumlah_santri = $this->psb->count_by_category('jadwal_tes_id', 'psb_antrian_jadwal', $id_jadwal_tes);

        if ($jumlah_santri >= $max_santri) {
            $this->session->set_flashdata('pesan', 'Kuota Santri Telah Mencapai Batas Maksimal Pada Jadwal Tersebut!');
            redirect('jadwaltes/kuota_jadwal/' . $id_jadwal_tes);
        } else {

            $dataantrian =
                [
                    'jadwal_tes_id'             => $id_jadwal_tes,
                    'antrian_tahap_id'          => $tahap_ini,
                    'status_antrian_santri'     => 1,
                ];

            $this->psb->update_data('id_antrian_jadwal', $id_antrian_jadwal, 'psb_antrian_jadwal', $dataantrian);

            $no_urut = $this->psb->nomor_antrian();
            $dataAntrianJadwal =
                [
                    'santri_antrian_id'         => $id_santri,
                    'no_urut_antrian'           => $no_urut,
                    'jadwal_tes_id'             => 0,
                    'antrian_tahap_id'          => $next_tahap['id_tahap'],
                    'status_antrian_santri'     => 0,
                    'tanggal_masuk_antrian'     => date('Y-m-d'), // tanggal hari itu juga
                ];
            $this->psb->insert_data($dataAntrianJadwal, 'psb_antrian_jadwal');

            $jenis_penilaian = $this->psb->show_data('psb_jenis_penilaian');

            foreach ($jenis_penilaian as $penilaian) {
                $dataPenilaian[] = array(
                    'hasil_santri_id' => $id_santri,
                    'jenis_penilaian_id' => $penilaian['id_jenis_penilaian'],
                    'jadwal_penilaian_id' => $id_jadwal_tes,
                );
            }
            $this->psb->insert_data_batch($dataPenilaian, 'psb_hasil_penilaian');

            $dataWawancara = [
                'wawancara_api_santri_id' => $id_santri,
                'wawancara_jadwal_api_id' => $id_jadwal_tes,
            ];

            $this->psb->insert_data($dataWawancara, 'psb_hasil_wawancara_api');

            $dataWawancara_A = [
                'wawancara_santri_id' => $id_santri,
                'item_jenis_wawancara_id' => 11,
                'jadwal_wawancara_id' => $id_jadwal_tes,
            ];

            $this->psb->insert_data($dataWawancara_A, 'psb_hasil_wawancara');
            // $item_jenis_wawancara = $this->psb->wawancara_byItem();

            // foreach ($item_jenis_wawancara as $wawancara) {
            //     $dataWawancara[] = array(
            //         'wawancara_santri_id' => $id_santri,
            //         'item_jenis_wawancara_id' => $wawancara['id_item_jenis_wawancara'],
            //         'jadwal_wawancara_id' => $id_jadwal_tes,
            //     );
            // }

            // $this->psb->insert_data_batch($dataWawancara, 'psb_hasil_wawancara');

            $dataKesehatan =
                [
                    'kesehatan_santri_id'   => $id_santri,
                    'jadwal_kesehatan_id'   => $id_jadwal_tes,
                ];

            $this->psb->insert_data($dataKesehatan, 'psb_hasil_kesehatan');

            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambah!');
            redirect('jadwaltes/kuota_jadwal/' . $id_jadwal_tes);
        }
    }

    // public function hapus_kuota($id_santri, $id_jadwal_tes)
    public function hapus_kuota($id_santri, $id_jadwal_tes, $id_antrian_jadwal)
    {
        $tahap_awal = $this->psb->getdata_teratas('psb_tahap', 'id_tahap');
        $dataantrian =
            [
                'jadwal_tes_id'             => 0,
                'status_antrian_santri'     => 0,
                'antrian_tahap_id'          => $tahap_awal['id_tahap'],
            ];

        $this->psb->update_data('id_antrian_jadwal', $id_antrian_jadwal, 'psb_antrian_jadwal', $dataantrian);

        $data['IDjadwal'] = $this->psb->getjadwal_satu($id_jadwal_tes);
        $next_tahap = $this->psb->getnext_data('psb_tahap', $data['IDjadwal']['tahap_id'], 'id_tahap');
        $this->psb->delete_antrianSantriByJadwal($next_tahap['id_tahap'], $id_santri);
        $this->psb->delete_data('psb_hasil_penilaian', 'hasil_santri_id', $id_santri);
        $this->psb->delete_data('psb_hasil_wawancara_api', 'wawancara_api_santri_id', $id_santri);
        $this->psb->delete_data('psb_hasil_wawancara', 'wawancara_santri_id', $id_santri);
        $this->psb->delete_data('psb_hasil_kesehatan', 'kesehatan_santri_id', $id_santri);

        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus!');
        redirect('jadwaltes/kuota_jadwal/' . $id_jadwal_tes);
    }

    public function daftar_hadir($id_jadwal_tes)
    {
        $data['title'] = 'Input Jadwal';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['AntrianTes_perjadwal'] = $this->psb->dafdir_perjadwal($id_jadwal_tes);
        $data['getJdwalTes'] = $this->psb->getsatu_jadwal($id_jadwal_tes);

        $this->load->view('jadwal_tes/daftar_hadir', $data);
    }
}
