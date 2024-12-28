<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wawancara extends CI_Controller
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
        $data['title'] = 'Jenis Wawancara';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['DataWawancara'] = $this->psb->show_data('psb_jenis_wawancara');

        $this->form_validation->set_rules('jenis_wawancara', 'Jenis Wawancara', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('wawancara/index', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $jenis_wawancara = $this->input->post('jenis_wawancara');

            $datawawancara =
                [
                    'jenis_wawancara' => $jenis_wawancara,
                ];

            $this->psb->insert_data($datawawancara, 'psb_jenis_wawancara');
            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan!');
            redirect('wawancara');
        }
    }

    public function edit_wawancara()
    {
        is_login(array('1'));
        $data['title'] = 'Jenis Wawancara';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['DataWawancara'] = $this->psb->show_data('psb_jenis_wawancara');

        $this->form_validation->set_rules('jenis_wawancara_edit', 'Jenis Wawancara', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('wawancara/index', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $jenis_wawancara = $this->input->post('jenis_wawancara_edit');
            $id_jenis_wawancara = $this->input->post('id_jenis_wawancara');

            $datawawancara =
                [
                    'jenis_wawancara' => $jenis_wawancara,
                ];

            $this->psb->update_data('id_jenis_wawancara', $id_jenis_wawancara, 'psb_jenis_wawancara', $datawawancara);
            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan!');
            redirect('wawancara');
        }
    }

    public function hapus_wawancara()
    {
        is_login(array('1'));
        $id_jenis_wawancara = $this->input->post('id_jenis_wawancara_hapus');
        $this->psb->delete_data('psb_jenis_wawancara', 'id_jenis_wawancara', $id_jenis_wawancara);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus!');
        redirect('wawancara');
    }

    public function item_wawancara()
    {
        is_login(array('1'));
        $data['title'] = 'Item Wawancara';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['DataItemWawancara'] = $this->psb->show_data('psb_item_wawancara');

        $this->form_validation->set_rules('item_wawancara', 'Item Wawancara', 'trim|required');
        // $this->form_validation->set_rules('wawancara_jenis_id', 'Jenis Wawancara', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('wawancara/item_wawancara', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $item_wawancara = $this->input->post('item_wawancara');
            // $wawancara_jenis_id = $this->input->post('wawancara_jenis_id');

            $dataItemwawancara =
                [
                    'item_wawancara' => $item_wawancara,
                    // 'wawancara_jenis_id' => $wawancara_jenis_id,
                ];

            $this->psb->insert_data($dataItemwawancara, 'psb_item_wawancara');
            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan!');
            redirect('wawancara/item_wawancara');
        }
    }

    public function edit_item_wawancara()
    {
        is_login(array('1'));
        $data['title'] = 'Item Wawancara';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['DataItemWawancara'] = $this->psb->show_data('psb_item_wawancara');

        $this->form_validation->set_rules('item_wawancara_edit', 'Item Wawancara', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('wawancara/item_wawancara', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $item_wawancara = $this->input->post('item_wawancara_edit');
            // $wawancara_jenis_id = $this->input->post('wawancara_jenis_id_edit');
            $id_item_wawancara = $this->input->post('id_item_wawancara');

            $dataItemwawancara =
                [
                    'item_wawancara' => $item_wawancara,
                    // 'wawancara_jenis_id' => $wawancara_jenis_id,
                ];

            $this->psb->update_data('id_item_wawancara', $id_item_wawancara, 'psb_item_wawancara', $dataItemwawancara);
            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan!');
            redirect('wawancara/item_wawancara');
        }
    }

    public function hapus_item_wawancara()
    {
        is_login(array('1'));
        $id_item_wawancara = $this->input->post('id_item_wawancara_hapus');
        $this->psb->delete_data('psb_item_wawancara', 'id_item_wawancara', $id_item_wawancara);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus!');
        redirect('wawancara/item_wawancara');
    }

    public function item_jenis_wawancara()
    {
        is_login(array('1'));
        $data['title'] = 'Item Wawancara';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['DataWawancara'] = $this->psb->show_data('psb_jenis_wawancara');
        $data['DataItemWawancara'] = $this->psb->show_data('psb_item_wawancara');
        $data['ItemJenisWawancara'] = $this->psb->wawancara_byItem();

        $this->form_validation->set_rules('data_jenis_wawancara_id', 'Jenis Wawancara', 'trim|required');
        $this->form_validation->set_rules('data_item_wawancara_id', 'Item Wawancara', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('wawancara/item_jenis_wawancara', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $data_jenis_wawancara_id = $this->input->post('data_jenis_wawancara_id');
            $data_item_wawancara_id = $this->input->post('data_item_wawancara_id');

            $dataItemJeniswawancara =
                [
                    'data_jenis_wawancara_id' => $data_jenis_wawancara_id,
                    'data_item_wawancara_id' => $data_item_wawancara_id,
                ];

            $this->psb->insert_data($dataItemJeniswawancara, 'psb_item_jenis_wawancara');
            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan!');
            redirect('wawancara/item_jenis_wawancara');
        }
    }

    public function edit_item_jenis_wawancara()
    {
        is_login(array('1'));
        $data['title'] = 'Item Wawancara';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['DataWawancara'] = $this->psb->show_data('psb_jenis_wawancara');
        $data['DataItemWawancara'] = $this->psb->show_data('psb_item_wawancara');
        $data['ItemJenisWawancara'] = $this->psb->wawancara_byItem();

        $this->form_validation->set_rules('data_jenis_wawancara_id_edit', 'Jenis Wawancara', 'trim|required');
        $this->form_validation->set_rules('data_item_wawancara_id_edit', 'Item Wawancara', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('wawancara/item_jenis_wawancara', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $id_item_jenis_wawancara = $this->input->post('id_item_jenis_wawancara');
            $data_jenis_wawancara_id = $this->input->post('data_jenis_wawancara_id_edit');
            $data_item_wawancara_id = $this->input->post('data_item_wawancara_id_edit');

            $dataItemJeniswawancara =
                [
                    'data_jenis_wawancara_id' => $data_jenis_wawancara_id,
                    'data_item_wawancara_id' => $data_item_wawancara_id,
                ];

            $this->psb->update_data('id_item_jenis_wawancara', $id_item_jenis_wawancara, 'psb_item_jenis_wawancara', $dataItemJeniswawancara);
            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan!');
            redirect('wawancara/item_jenis_wawancara');
        }
    }

    public function hapus_item_jenis_wawancara()
    {
        is_login(array('1'));
        $id_item_jenis_wawancara = $this->input->post('id_item_jenis_wawancara_hapus');
        $this->psb->delete_data('psb_item_jenis_wawancara', 'id_item_jenis_wawancara', $id_item_jenis_wawancara);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus!');
        redirect('wawancara/item_jenis_wawancara');
    }

    public function sync_wawancara_ekonseling()
    {
        is_login(array('1'));
        $data['title'] = 'Data Sikronisasi Penilaian';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['DataSyncWawancara'] = $this->psb->syncApi_wawancara_santriortu();
        // $data['DataSyncWawancara'] = $this->psb->sync_wawancara_santriortu();
        // $data['DataItemWawancara'] = $this->psb->show_data('psb_item_wawancara');
        // $data['DataJenisWawancara'] = $this->psb->show_data('psb_jenis_wawancara');
        // $data['jumlahItem'] = $this->psb->count_rows('psb_item_wawancara');

        $this->load->view('template/manage_header', $data);
        $this->load->view('template/manage_navbar', $data);
        $this->load->view('wawancara/sync_wawancara_ekonseling', $data);
        $this->load->view('template/manage_footer', $data);
    }

    public function getsync_wawancara_ekonseling()
    {
        is_login(array('1'));

        $url = 'http://36.95.178.42:8080/data_api/api/interview';

        $response = $this->curl->simple_get($url);

        if ($response) {
            $data = json_decode($response, true);

            if ($data['status'] == 'success') {
                foreach ($data['data'] as $item) {
                    $id_santri = '20210868';
                    // $id_santri = $item['no_peserta'];

                    $interviewer_santri = $item['interviewer_santri'];
                    $interviewer_ortu = $item['interviewer_wali_santri'];

                    // Data wawancara untuk tabel hasil_wawancara
                    $data_wawancara = [
                        [
                            'item_jenis_wawancara_id' => 1,
                            'pegawai_wawancara_id' => $interviewer_santri,
                            'deskripsi_wawancara' => $item['motivasi'],
                        ],
                        [
                            'item_jenis_wawancara_id' => 2,
                            'pegawai_wawancara_id' => $interviewer_santri,
                            'deskripsi_wawancara' => $item['kemampuan_beradaptasi'],
                        ],
                        [
                            'item_jenis_wawancara_id' => 3,
                            'pegawai_wawancara_id' => $interviewer_santri,
                            'deskripsi_wawancara' => $item['karakter'],
                        ],
                        [
                            'item_jenis_wawancara_id' => 4,
                            'pegawai_wawancara_id' => $interviewer_santri,
                            'deskripsi_wawancara' => $item['kedekatan'],
                        ],
                        [
                            'item_jenis_wawancara_id' => 5,
                            'pegawai_wawancara_id' => $interviewer_santri,
                            'deskripsi_wawancara' => $item['catatan_khusus'],
                        ],
                        [
                            'item_jenis_wawancara_id' => 6,
                            'pegawai_wawancara_id' => $interviewer_ortu,
                            'deskripsi_wawancara' => $item['motivasi'],
                        ],
                        [
                            'item_jenis_wawancara_id' => 7,
                            'pegawai_wawancara_id' => $interviewer_ortu,
                            'deskripsi_wawancara' => $item['kemampuan_beradaptasi'],
                        ],
                        [
                            'item_jenis_wawancara_id' => 8,
                            'pegawai_wawancara_id' => $interviewer_ortu,
                            'deskripsi_wawancara' => $item['karakter'],
                        ],
                        [
                            'item_jenis_wawancara_id' => 9,
                            'pegawai_wawancara_id' => $interviewer_ortu,
                            'deskripsi_wawancara' => $item['kedekatan'],
                        ],
                        [
                            'item_jenis_wawancara_id' => 10,
                            'pegawai_wawancara_id' => $interviewer_ortu,
                            'deskripsi_wawancara' => $item['catatan_khusus'],
                        ]
                    ];

                    $id_ItemJenis_wawancara = $this->psb->getID_ItemJenis_wawancara();
                    // var_dump($id_ItemJenis_wawancara);
                    // die;

                    $psb_hasil_wawancara = $this->psb->getIDhasilWawancarabySantri_ItemJenis_wawancara($id_ItemJenis_wawancara['id_item_jenis_wawancara'], $id_santri);
                    var_dump($psb_hasil_wawancara);
                    die;
                    // foreach ($id_ItemJenis_wawancara as $row) {
                    // }

                    if ($this->psb->checkIfExists($id_santri, 'wawancara_santri_id', 'psb_hasil_wawancara')) {
                        foreach ($data_wawancara as $wawancara) {
                            // $this->psb->update_syncHasilWawancara($id_santri, $wawancara);
                            // $this->psb->update_syncHasilWawancara($id_santri, $id_ItemJenis_wawancara, $wawancara);
                            $this->psb->update_data('id_hasil_wawancara', $psb_hasil_wawancara['id_hasil_wawancara'], 'psb_hasil_wawancara', $wawancara);
                        }
                    }
                }

                $this->session->set_flashdata('pesan', 'Data Berhasil diambil dari API dan diupdate ke database!');
                redirect('wawancara/sync_wawancara_ekonseling');
            } else {
                $this->session->set_flashdata('pesan', 'Gagal mengambil data dari API!');
                redirect('wawancara/sync_wawancara_ekonseling');
            }
        } else {
            $this->session->set_flashdata('pesan', 'Gagal mengambil data dari API!');
            redirect('wawancara/sync_wawancara_ekonseling');
        }
    }

    public function getsyncapi_wawancara_ekonseling()
    {
        is_login(array('1'));

        $url = 'http://36.95.178.42:8080/data_api/api/interview';

        $response = $this->curl->simple_get($url);

        if ($response) {
            $data = json_decode($response, true);

            if ($data['status'] == 'success') {
                foreach ($data['data'] as $item) {
                    // $id_santri = '20210868';
                    $id_santri = $item['no_peserta'];


                    $dataWawancara = [
                        'pegawai_wawancara_santri_id' => $item['interviewer_santri'],
                        'pegawai_wawancara_ortu_id' => $item['interviewer_wali_santri'],
                        'catatan_khusus' => $item['catatan_khusus'],
                        'motivasi' => $item['motivasi'],
                        'kemampuan_beradaptasi' => $item['kemampuan_beradaptasi'],
                        'karakter' => $item['karakter'],
                        'kedekatan' => $item['kedekatan'],
                        'hasil_rekomendasi' => $item['hasil'],
                    ];

                    $getId_hasil_wawancara_api = $this->psb->getId_data($id_santri, 'psb_hasil_wawancara_api', 'wawancara_api_santri_id');

                    if ($this->psb->checkIfExists($id_santri, 'wawancara_api_santri_id', 'psb_hasil_wawancara_api')) {

                        $this->psb->update_data('id_hasil_wawancara_api', $getId_hasil_wawancara_api['id_hasil_wawancara_api'], 'psb_hasil_wawancara_api', $dataWawancara);
                    }
                }

                $this->session->set_flashdata('pesan', 'Data Berhasil diambil dari API dan diupdate ke database!');
                redirect('wawancara/sync_wawancara_ekonseling');
            } else {
                $this->session->set_flashdata('pesan', 'Gagal mengambil data dari API!');
                redirect('wawancara/sync_wawancara_ekonseling');
            }
        } else {
            $this->session->set_flashdata('pesan', 'Gagal mengambil data dari API!');
            redirect('wawancara/sync_wawancara_ekonseling');
        }
    }

    public function input_wawancara()
    {
        is_login(array('6'));
        $data['title'] = 'Input Wawancara';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        // $data['DataWawancara'] = $this->psb->show_data('psb_jenis_wawancara');
        $data['DataWawancara'] = $this->psb->getwawancaraPembiayaan_ortu();
        $data['DataJadwal'] = $this->psb->jadwal_aktif();
        // $data['DataItemWawancara'] = $this->psb->show_data('psb_item_wawancara');

        $this->load->view('template/manage_header', $data);
        $this->load->view('template/manage_navbar', $data);
        $this->load->view('wawancara/input_wawancara', $data);
        $this->load->view('template/manage_footer', $data);
    }

    public function filter_wawancara()
    {
        $item_jenis_wawancara_id = $this->input->post('item_jenis_wawancara_id');
        $jadwal_wawancara_id = $this->input->post('jadwal_wawancara_id');

        // Query untuk mendapatkan data berdasarkan filter
        $this->db->select('*');
        $this->db->from('psb_hasil_wawancara');
        $this->db->join('psb_data_santri', 'psb_data_santri.id_santri=wawancara_santri_id', 'left');
        $this->db->join('psb_data_pegawai', 'psb_data_pegawai.id_pegawai_psb=pegawai_wawancara_id', 'left');
        $this->db->join('psb_jadwal_tes', 'psb_jadwal_tes.id_jadwal_tes=jadwal_wawancara_id', 'left');
        // $this->db->join('psb_tahun_pelajaran', 'psb_tahun_pelajaran.id_tapel=psb_jadwal_tes.tapel_jadwal_id', 'left');
        // $this->db->join('psb_tahap', 'psb_tahap.id_tahap=psb_jadwal_tes.tahap_id', 'left');
        $this->db->join('psb_item_jenis_wawancara', 'psb_item_jenis_wawancara.id_item_jenis_wawancara=item_jenis_wawancara_id', 'left');
        // $this->db->join('psb_jenis_wawancara', 'psb_jenis_wawancara.id_jenis_wawancara=psb_item_jenis_wawancara.data_jenis_wawancara_id', 'left');
        // $this->db->join('psb_item_wawancara', 'psb_item_wawancara.id_item_wawancara=psb_item_jenis_wawancara.data_item_wawancara_id', 'left');
        $this->db->where('item_jenis_wawancara_id', $item_jenis_wawancara_id);
        $this->db->where('jadwal_wawancara_id', $jadwal_wawancara_id);
        $query = $this->db->get();
        $filtered_data = $query->result_array();

        // Tampilkan data dalam bentuk tabel di dalam card
        $output = '<div class="card mb-2"><div class="card-header bg-primary">';
        $output .= '<h6 class="m-0 font-weight-bold text-white">Input Penilaian</h6></div>';
        $output .= '<div class="card-body">';
        $output .= '<table id="InputWawancara_tabel" class="table table-bordered table-striped" width="100%" cellspacing="0">';
        $output .= '<thead style="background-color: teal;" class="text-white text-center"><tr><th>No</th><th>Nama Santri</th><th>Deskripsi</th><th>Hasil Interview</th><th>Petugas Interview</th></tr></thead><tbody>';

        $no = 1;
        foreach ($filtered_data as $row) {
            $output .= '<tr data-wawancara-id="' . $row['id_hasil_wawancara'] . '" data-wawancara-pegawai-id="' . $row['pegawai_wawancara_id'] . '">';
            // $output .= '<tr>';
            $output .= '<td>' . $no++ . '</td>';
            $output .= '<td style="display:none;">' . $row['id_hasil_wawancara'] . '</td>';
            $output .= '<td>' . $row['nama_lengkap'] . '</td>';
            $output .= '<td>' . $row['deskripsi_wawancara'] . '</td>';
            $output .= '<td>' . $row['hasil'] . '</td>';
            $output .= '<td>' . $row['nama_lengkap_pegawai'] . '</td>';
            $output .= '</tr>';
        }

        $output .= '</tbody></table></div></div>';

        echo $output;
    }

    public function update_wawancara()
    {
        header('Content-Type: application/json');
        $dataPanitia = $this->psb->user_login($this->session->userdata('username'));
        $id_hasil_wawancara = $this->input->post('id_hasil_wawancara');
        $deskripsi_wawancara = $this->input->post('deskripsi_wawancara');
        $hasil = $this->input->post('hasil');
        $action = $this->input->post('action');

        // var_dump($id_hasil_wawancara);
        // die;

        if (empty($deskripsi_wawancara)) {
            echo json_encode(array('success' => false, 'message' => 'Deskripsi tidak boleh kosong.'));
            return;
        }

        if (empty($hasil)) {
            echo json_encode(array('success' => false, 'message' => 'Hasil Wawancara tidak boleh kosong.'));
            return;
        }

        // $existingData = $this->psb->getdata_byID($id_hasil_wawancara, 'psb_hasil_wawancara', 'id_hasil_wawancara');
        // var_dump($existingData);
        // die;
        // if ($existingData['pegawai_wawancara_id'] != $dataPanitia['id_pegawai_psb']) {
        //     echo json_encode(array('success' => false, 'message' => 'Anda tidak memiliki izin untuk mengedit data ini.'));
        //     return;
        // }
        if ($action == 'edit') {

            $dataWawancara =
                array(
                    'deskripsi_wawancara' => htmlspecialchars($deskripsi_wawancara, ENT_QUOTES),
                    'hasil' => htmlspecialchars($hasil, ENT_QUOTES),
                    'pegawai_wawancara_id' => $dataPanitia['id_pegawai_psb']
                );

            $update = $this->psb->update_data('id_hasil_wawancara', $id_hasil_wawancara, 'psb_hasil_wawancara', $dataWawancara);

            if ($update) {
                echo json_encode(array('success' => false, 'message' => 'Gagal memperbarui data.'));
            } else {
                echo json_encode(array('success' => true, 'message' => 'Data berhasil diperbarui.'));
            }
        }
    }
}
