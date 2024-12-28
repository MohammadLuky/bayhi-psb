<?php
require FCPATH . 'vendor/autoload.php';
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Santri extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Psb_model', 'psb');
        $this->load->library('curl');
        // is_login(array('2', '3', '5', '6', '7'));
    }

    public function index()
    {
        $data['title'] = 'Data Santri Baru';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['AllSantri'] = $this->psb->show_data('psb_data_santri');

        $this->load->view('template/manage_header', $data);
        $this->load->view('template/manage_navbar', $data);
        $this->load->view('santri/index', $data);
        $this->load->view('template/manage_footer', $data);
    }

    public function sync_psbhosting()
    {
        is_login(array('1'));
        $data['title'] = 'Data Santri Baru';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        // $data['AllSantri'] = $this->psb->dataAll_santri();
        // $data['AllSantri'] = $this->psb->DataHasilSync();
        $data['AllSantri'] = $this->psb->DataModal_CasanSync();
        $data['TapelAll'] = $this->psb->show_data('psb_tahun_pelajaran');

        $this->load->view('template/manage_header', $data);
        $this->load->view('template/manage_navbar', $data);
        $this->load->view('santri/santri_syncron', $data);
        $this->load->view('template/manage_footer', $data);
    }

    public function load_CasanSync()
    {
        $tapel_inden_id = $this->input->post('tapel_syncCasan');

        $calonSantri = $this->psb->dataFilter_CasanSync($tapel_inden_id);

        // Tampilkan data dalam bentuk tabel di dalam card
        $output = '<div class="col-md-12"><div class="card mb-2"><div class="card-header bg-primary py-3 d-flex flex-row align-items-center justify-content-between">';
        $output .= '<h6 class="m-0 font-weight-bold text-white">Data Calon Santri</h6>
                            <a href="' . base_url("santri/download_CasanSync/" . $tapel_inden_id) . '" class="btn btn-sm btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Download Data Santri">
                                <i class="fas fa-cloud-download-alt"></i> Download Calon Santri
                            </a>
                        </div>';
        $output .= '<div class="card-body">';
        $output .= '<div class="table-responsive"><table id="table_CasanSync" class="table table-bordered table-striped" width="100%" cellspacing="0">';
        $output .= '<thead style="background-color: teal;" class="text-white text-center">
                        <tr>
                            <th>No</th>
                            <th>ID Santri</th>
                            <th>Nama Santri</th>
                            <th>Alamat</th>
                            <th>Nama Orang Tua</th>
                            <th>Asal Sekolah</th>
                            <th>Tahun Pelajaran Inden</th>
                            <th>Jenjang & Program</th>
                            <th>Aksi</th>
                            </tr>
                            </thead><tbody>';
        // <th>Program</th>
        $no = 1;
        foreach ($calonSantri as $santri) {
            if ($santri['status_santri'] == 0) {
                $output .= '<tr style="background-color: indianred;" class="text-white">';
            } elseif ($santri['status_santri'] == 1) {
                $output .= '<tr style="background-color: aquamarine;">';
            } else {
                $output .= '<tr>';
            }
            $output .= '<td class="text-center">' . $no++ . ' | <a href="#" class="badge badge-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Santri" data-toggle="modal" data-target="#HapusSantriPermanent' . $santri['id_santri'] . '"><i class="fas fa-trash-alt"></i></a></td>';
            $output .= '<td>' . $santri['id_santri'] . '</td>';
            $output .= '<td>' . $santri['nama_lengkap'] . '</td>';
            $output .= '<td class="text-center">' . $santri['alamat'] . ' Kelurahan ' . $santri['nama_kelurahan'] . ' Kecamatan ' . $santri['nama_kecamatan'] . ' ' . $santri['nama_kota_kab'] . ' ' . $santri['nama_provinsi'] . '</td>';
            if ($santri['nama_wali'] != '') {
                $output .= '<td class="text-center">' . 'Bpk. ' . $santri['nama_ayah'] . ' | Ibu ' . $santri['nama_ibu'] . '</td>';
            } else {
                $output .= '<td class="text-center">' . 'Bpk. ' . $santri['nama_wali'] . '</td>';
            }
            $output .= '<td class="text-center">' . $santri['asal_sekolah'] . '</td>';
            $output .= '<td class="text-center">' . $santri['ket_tapel'] . '</td>';
            // $output .= '<td class="text-center">' . $santri['nama_tingkat'] . '</td>';
            $output .= '<td class="text-center">' . $santri['nama_tingkat'] . ' - ' . $santri['nama_program'] . '</td>';
            $output .= '<td><a href="' . base_url("santri/cetak_biodata/" . $santri['id_santri']) . '" class="badge badge-success" target="_blank"><i class="fas fa-eye"></i></a>';
            if ($santri['status_santri'] == 2) {
                $output .= '
                <a href="' . base_url("santri/status_kirim_data/" . $santri['id_santri']) . '" class="badge badge-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Status Kirim Data"><i class="fas fa-paper-plane"></i></a>
                <a href="#" class="badge badge-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Ganti Tapel" data-toggle="modal" data-target="#GantiTapel' . $santri['id_santri'] . '"><i class="fas fa-exchange-alt"></i></a>
                <a href="#" class="badge badge-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Akun Santri" data-toggle="modal" data-target="#AkunSantri' . $santri['id_santri'] . '"><i class="fas fa-user"></i></a>
                <a href="#" class="badge badge-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Santri DiAktif" data-toggle="modal" data-target="#SantriDiaktifkan' . $santri['id_santri'] . '"><i class="fas fa-user-check"></i></a>
                <a href="#" class="badge badge-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Santri" data-toggle="modal" data-target="#HapusSantri' . $santri['id_santri'] . '"><i class="fas fa-user-times"></i></a>
                ';
            } elseif ($santri['status_santri'] == 3) {
                $output .= '
                <a href="' . base_url("santri/status_baru_daftar/" . $santri['id_santri']) . '" class="badge badge-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Status Baru Daftar"><i class="fas fa-user-plus"></i></a>
                <a href="#" class="badge badge-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Ganti Tapel" data-toggle="modal" data-target="#GantiTapel' . $santri['id_santri'] . '"><i class="fas fa-exchange-alt"></i></a>
                <a href="#" class="badge badge-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Akun Santri" data-toggle="modal" data-target="#AkunSantri' . $santri['id_santri'] . '"><i class="fas fa-user"></i></a>
                <a href="#" class="badge badge-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Santri DiAktif" data-toggle="modal" data-target="#SantriDiaktifkan' . $santri['id_santri'] . '"><i class="fas fa-user-check"></i></a>
                <a href="#" class="badge badge-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Santri" data-toggle="modal" data-target="#HapusSantri' . $santri['id_santri'] . '"><i class="fas fa-user-times"></i></a>
                ';
            } elseif ($santri['status_santri'] == 0) {
                $output .= '
                <a href="' . base_url("santri/status_baru_daftar/" . $santri['id_santri']) . '" class="badge badge-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Status Baru Daftar"><i class="fas fa-user-plus"></i></a>
                ';
            }
            $output .= '</td></tr>';
        }

        $output .= '</tbody></table></div></div></div></div>';

        echo $output;
    }

    public function download_CasanSync($tapel_inden_id)
    {
        // $tapel_inden_id = $this->input->post('tapel_syncCasan');
        $tapel = $this->psb->getId_data($tapel_inden_id, 'psb_tahun_pelajaran', 'id_tapel');
        $Judul = 'Data Calon Santri Baru - ' . $tapel['ket_tapel'];
        $calonSantri = $this->psb->dataFilter_CasanSync($tapel_inden_id);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->mergeCells('A1:H1');
        $sheet->setCellValue('A1', $Judul);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->mergeCells('A2:H2');
        $sheet->setCellValue('A2', 'Yayasan Pondok Pesantren Bayt Al-hikmah');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(14);
        $sheet->mergeCells('A3:H3');
        $sheet->setCellValue('A3', 'Pasuruan - Jawa Timur');
        $sheet->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A3')->getFont()->setBold(true)->setSize(14);

        $headerData = array(
            'A4' => array('NO', 5),
            'B4' => array('ID Santri', 15),
            'C4' => array('Nama Lengkap Santri', 50),
            'D4' => array('Alamat Lengkap', 80),
            'E4' => array('Nama Orang Tua', 50),
            'F4' => array('Asal Sekolah', 35),
            'G4' => array('Tahun Pelajaran Inden', 22),
            'H4' => array('Jenjang & Program', 30),
            // 'I4' => array('KOTA/KABUPATEN', 22),
            // 'J4' => array('ALAMAT DOMISILI', 35),
            // 'K4' => array('KELURAHAN', 22),
            // 'L4' => array('KECAMATAN', 22),
            // 'M4' => array('KOTA/KABUPATEN', 22),
            // 'N4' => array('JABATAN', 20),
            // 'O4' => array('UNIT KERJA', 30),
            // 'P4' => array('MATA PELAJARAN(GURU)', 35),
            // 'Q4' => array('STATUS PEGAWAI', 18),
            // 'R4' => array('NO TELP / WA', 21),
            // 'S4' => array('EMAIL PEGAWAI', 27),
            // 'T4' => array('PENDIDIKAN TERAKHIR', 35),
            // 'U4' => array('TAHUN MASUK', 15)
        );

        foreach ($headerData as $cell => $data) {
            $sheet->setCellValue($cell, $data[0])->getColumnDimension(substr($cell, 0, 1))->setWidth($data[1]);
            $sheet->getStyle($cell)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($cell)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle($cell)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle($cell)->getFill()->getStartColor()->setARGB('7AFCFF');
            $sheet->getStyle($cell)->getAlignment()->setWrapText(true);
            $sheet->getStyle($cell)->getFont()->setBold(true)->setSize(12);
        }

        $borderStyle = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
                'inside' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000']
                ]
            ],
        ];
        $sheet->getStyle('A4:H250')->applyFromArray($borderStyle);

        $row = 5;
        $no = 1;
        foreach ($calonSantri as $santri) {
            $rowRange = "A{$row}:H{$row}";
            if ($santri['status_santri'] == 0) {
                $sheet->getStyle($rowRange)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $sheet->getStyle($rowRange)->getFill()->getStartColor()->setARGB('FF4B4B');
            } elseif ($santri['status_santri'] == 1) {
                $sheet->getStyle($rowRange)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $sheet->getStyle($rowRange)->getFill()->getStartColor()->setARGB('4BFF63');
            }
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->getStyle('A' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('B' . $row, $santri['id_santri']);
            $sheet->getStyle('B' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('C' . $row, $santri['nama_lengkap']);
            $sheet->setCellValue('D' . $row, $santri['alamat'] . ', Kelurahan ' . $santri['nama_kelurahan'] . ' Kecamatan ' . $santri['nama_kecamatan'] . ', ' . $santri['nama_kota_kab'] . ', ' . $santri['nama_provinsi']);
            $sheet->getStyle('D' . $row)->getAlignment()->setWrapText(true);
            if ($santri['nama_wali'] != '') {
                $sheet->setCellValue('E' . $row, 'Bpk.' . $santri['nama_ayah'] . '| Ibu ' . $santri['nama_ibu']);
                $sheet->getStyle('E' . $row)->getAlignment()->setWrapText(true);
            } else {
                $sheet->setCellValue('E' . $row, 'Bpk. ' . $santri['nama_wali']);
                $sheet->getStyle('E' . $row)->getAlignment()->setWrapText(true);
            }
            $sheet->setCellValue('F' . $row, $santri['asal_sekolah']);
            $sheet->setCellValue('G' . $row, $santri['ket_tapel']);
            $sheet->getStyle('G' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('H' . $row, $santri['nama_tingkat'] . ' - ' . $santri['nama_program']);
            $sheet->getStyle('H' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $sheet->getStyle('A' . $row . ':H' . $row)->applyFromArray($borderStyle);

            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = $Judul  . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function getsync_datasantri()
    {
        is_login(array('1'));
        // $url = 'http://localhost/e-pegawai/apidata/data_agama';
        $url = 'http://36.95.178.42:8080/data_api/api/psb_baru';

        $response = $this->curl->simple_get($url);

        $data = json_decode($response, true);
        // var_dump($data);
        // die;

        if ($data) {
            foreach ($data as $item) {
                $id_santri          = $item['siswa_id'];
                $no_registrasi      = $this->psb->generate_id();
                //Jenis Kelamin
                $jenis_kelamin = 0;
                if (strtoupper($item['jekel']) === 'LAKI-LAKI') {
                    $jenis_kelamin = 1;
                } elseif (strtoupper($item['jekel']) === 'PEREMPUAN') {
                    $jenis_kelamin = 2;
                }
                $program = 0;
                $jenjang = 0;
                $tapel = 0;
                // Program MI/QS
                if (in_array($item['jenjang_pendidikan_id'], [17, 18, 21, 22, 23, 24, 25, 26, 29, 30, 31, 32, 33, 34, 37, 38, 39, 40])) {
                    $program = 1;
                } elseif (in_array($item['jenjang_pendidikan_id'], [19, 20, 27, 28, 35, 36])) {
                    $program = 2;
                }
                // Jenjang Sekolah SMP. SMA, SMK
                if (in_array($item['jenjang_pendidikan_id'], [17, 18, 19, 20, 25, 26, 27, 28, 33, 34, 35, 36])) {
                    $jenjang = 1;
                } elseif (in_array($item['jenjang_pendidikan_id'], [21, 22, 29, 30, 37, 38])) {
                    $jenjang = 2;
                } elseif (in_array($item['jenjang_pendidikan_id'], [23, 24, 31, 32, 39, 40])) {
                    $jenjang = 3;
                }
                // Tahun Pelajaran
                if (in_array($item['jenjang_pendidikan_id'], [17, 18, 19, 20, 21, 22, 23, 24])) {
                    $tapel = 1;
                } elseif (in_array($item['jenjang_pendidikan_id'], [25, 26, 27, 28, 29, 30, 31, 32])) {
                    $tapel = 2;
                } elseif (in_array($item['jenjang_pendidikan_id'], [33, 34, 35, 36, 37, 38, 39, 40])) {
                    $tapel = 4;
                }
                $dataPSBSantri = [
                    'id_santri'                 => $id_santri,
                    'nisn_santri'               => isset($item['nisn']) ? $item['nisn'] : 0,
                    'no_registrasi'             => $no_registrasi,
                    'nama_lengkap'              => isset($item['nama_lengkap']) ? $item['nama_lengkap'] : 0,
                    'nama_panggilan'            => isset($item['nama_panggilan']) ? $item['nama_panggilan'] : 0,
                    'foto_santri'               => 'akun.jpg',
                    'jenis_kelamin_id'          => $jenis_kelamin,
                    'tempat_lahir'              => isset($item['tmpt_lahir']) ? $item['tmpt_lahir'] : 0,
                    'tanggal_lahir'             => isset($item['tgl_lahir']) ? $item['tgl_lahir'] : 0,
                    'agama_id'                  => isset($item['agama_id']) ? $item['agama_id'] : 0,
                    'akta_lahir'                => isset($item['no_akta_kelahiran']) ? $item['no_akta_kelahiran'] : 0,
                    'nik_santri'                => isset($item['nik']) ? $item['nik'] : 0,
                    'kk_santri'                 => isset($item['no_kk']) ? $item['no_kk'] : 0,
                    'alamat'                    => isset($item['alamat_jalan']) ? $item['alamat_jalan'] : 0,
                    'kode_pos'                  => isset($item['kode_pos']) ? $item['kode_pos'] : 0,
                    'tinggi_badan'              => isset($item['tinggi_badan']) ? $item['tinggi_badan'] : 0,
                    'berat_badan'               => isset($item['berat_badan']) ? $item['berat_badan'] : 0,
                    'skhun'                     => isset($item['no_skhun']) ? $item['no_skhun'] : 0,
                    'nama_ayah'                 => isset($item['nama_ayah']) ? $item['nama_ayah'] : 0,
                    'nik_ayah'                  => isset($item['nik_ayah']) ? $item['nik_ayah'] : 0,
                    'tahun_lahir_ayah'          => substr($item['tgl_lahir_ayah'], 0, 4),
                    'pendidikan_ayah_id'        => isset($item['pendidikan_terakhir_id_ayah']) ? $item['pendidikan_terakhir_id_ayah'] : 0,
                    'pekerjaan_ayah_id'         => isset($item['pekerjaan_id_ayah']) ? $item['pekerjaan_id_ayah'] : 0,
                    'penghasilan_ayah_id'       => isset($item['penghasilan_ayah']) ? $item['penghasilan_ayah'] : 0,
                    'nohp_ayah'                 => isset($item['telp_ayah_1']) ? $item['telp_ayah_1'] : 0,
                    'nama_ibu'                  => isset($item['nama_ibu']) ? $item['nama_ibu'] : 0,
                    'nik_ibu'                   => isset($item['nik_ibu']) ? $item['nik_ibu'] : 0,
                    'tahun_lahir_ibu'           => substr($item['tgl_lahir_ibu'], 0, 4),
                    'pendidikan_ibu_id'         => isset($item['pendidikan_terakhir_id_ibu']) ? $item['pendidikan_terakhir_id_ibu'] : 0,
                    'pekerjaan_ibu_id'          => isset($item['pekerjaan_id_ibu']) ? $item['pekerjaan_id_ibu'] : 0,
                    'penghasilan_ibu_id'        => isset($item['penghasilan_ibu']) ? $item['penghasilan_ibu'] : 0,
                    'nohp_ibu'                  => isset($item['telp_ibu_1']) ? $item['telp_ibu_1'] : 0,
                    'nama_wali'                 => isset($item['nama_wali']) ? $item['nama_wali'] : 0,
                    'nik_wali'                  => isset($item['nik_wali']) ? $item['nik_wali'] : 0,
                    'tahun_lahir_wali'          => substr($item['tgl_lahir_wali'], 0, 4),
                    'pendidikan_wali_id'        => isset($item['pendidikan_terakhir_id_wali']) ? $item['pendidikan_terakhir_id_wali'] : 0,
                    'pekerjaan_wali_id'         => isset($item['pekerjaan_id_wali']) ? $item['pekerjaan_id_wali'] : 0,
                    'penghasilan_wali_id'       => isset($item['penghasilan_wali']) ? $item['penghasilan_wali'] : 0,
                    'nohp_wali'                 => isset($item['telp_wali_1']) ? $item['telp_wali_1'] : 0,
                    'asal_sekolah'              => isset($item['lulusan_dari_sekolah']) ? $item['lulusan_dari_sekolah'] : 0,
                    'nomor_ijazah'              => isset($item['no_seri_ijasah']) ? $item['no_seri_ijasah'] : 0,
                    'tapel_inden_id'            => $tapel,
                    'daftar_tingkat_id'         => $jenjang,
                    'program_jenjang_id'        => $program,
                    'kirim_data_santri'         => 1,
                    'status_santri'             => 2,
                    'tgl_inden'                 => isset($item['siswa_tgl']) ? $item['siswa_tgl'] : 0,
                ];

                $getDataSantri = $this->psb->getId_data($id_santri, 'psb_data_santri', 'id_santri');

                if (!$this->psb->checkIfExists($id_santri, 'id_santri', 'psb_data_santri')) {
                    // if ($getDataSantri['status_santri'] != 3 && $getDataSantri['tapel_inden_id'] == $tapel && $getDataSantri['program_jenjang_id'] == $program) {
                    //     $this->psb->update_data('id_santri', $id_santri, 'psb_data_santri', $dataPSBSantri);
                    // }
                    $this->psb->insert_data($dataPSBSantri, 'psb_data_santri');
                }
                //  else {
                // }
                // $id_santri =  $this->db->insert_id();
                // $id_santri_update = $this->psb->getId_data($no_registrasi, 'psb_data_santri', 'no_registrasi');

                // if (!$this->psb->checkIfExists($id_santri, 'id_santri', 'psb_data_santri')) {
                if (!$this->psb->checkIfExists($id_santri, 'santri_id', 'psb_akun')) {
                    $dataAkunSantri =
                        [
                            'santri_id' => $id_santri,
                            'pegawai_psb_id' => 0,
                            'username' => $item['telp_ayah_1'],
                            'password' => password_hash($item['telp_ayah_1'], PASSWORD_DEFAULT),
                            'pass_tampil' => $item['telp_ayah_1'],
                            'role_id' => 5,
                        ];
                    $this->psb->insert_data($dataAkunSantri, 'psb_akun');
                }

                if (!$this->psb->checkIfExists($id_santri, 'santri_pembayaran_id', 'psb_pembayaran')) {
                    $dataPembayaran =
                        [
                            'santri_pembayaran_id' => $id_santri,
                            'jepem_id' => 1,
                            'status_pembayaran' => 0,
                        ];
                    $this->psb->insert_data($dataPembayaran, 'psb_pembayaran');
                }
                // }
            }
        } else {
            echo json_encode('status', 'Data Tidak ada');
        }

        $this->session->set_flashdata('pesan', 'Data Berhasil Diduplikat dari API.');
        redirect('santri/sync_psbhosting');
    }

    public function status_kirim_data($id_santri)
    {
        $getData = $this->psb->getId_data($id_santri, 'psb_data_santri', 'id_santri');
        $dataSantri =
            [
                'kirim_data_santri'         => 1,
                'status_santri'             => 3, // status Kirim Data
            ];

        $this->psb->update_data('id_santri', $id_santri, 'psb_data_santri', $dataSantri);

        $tapel_id = $getData['tapel_inden_id'];
        $no_urut = $this->psb->nomor_antrian();
        $tahap_awal = $this->psb->getdata_teratas('psb_tahap', 'id_tahap');
        $dataAntrianJadwal =
            [
                'santri_antrian_id'         => $id_santri,
                'tapel_antrian_id'          => $tapel_id,
                'no_urut_antrian'           => $no_urut,
                'antrian_tahap_id'          => $tahap_awal['id_tahap'],
                'tanggal_masuk_antrian'     => date('Y-m-d'), // tanggal hari itu juga
            ];
        if ($this->psb->checkIfExists($id_santri, 'santri_antrian_id', 'psb_antrian_jadwal')) {
            $this->psb->update_data('santri_antrian_id', $id_santri, 'psb_antrian_jadwal', $dataAntrianJadwal);
        } else {
            $this->psb->insert_data($dataAntrianJadwal, 'psb_antrian_jadwal');
        }
        $this->session->set_flashdata('pesan', $getData['nama_lengkap'] . ' Berhasil Menjadi Status Kirim Data.');
        redirect('santri/sync_psbhosting');
    }

    public function status_baru_daftar($id_santri)
    {
        $getData = $this->psb->getId_data($id_santri, 'psb_data_santri', 'id_santri');
        $dataSantri =
            [
                'kirim_data_santri'         => 1, // status Baru Daftar
                'status_santri'             => 2, // status Baru Daftar
            ];
        $this->psb->update_data('id_santri', $id_santri, 'psb_data_santri', $dataSantri);

        $dataAntrianJadwal =
            [
                'santri_antrian_id'         => $id_santri,
                'tapel_antrian_id'          => 0,
                'antrian_tahap_id'          => 0,
                'tanggal_masuk_antrian'     => date('Y-m-d'), // tanggal hari itu juga
            ];
        if ($this->psb->checkIfExists($id_santri, 'santri_id', 'psb_akun')) {
            $this->psb->update_data('santri_antrian_id', $id_santri, 'psb_antrian_jadwal', $dataAntrianJadwal);
        } else {
            $this->psb->insert_data($dataAntrianJadwal, 'psb_antrian_jadwal');
        }

        $no_telp_regis = $getData['nohp_ayah'];
        $dataAkunSantri =
            [
                'santri_id' => $id_santri,
                'pegawai_psb_id' => 0,
                'username' => $no_telp_regis,
                'password' => password_hash($no_telp_regis, PASSWORD_DEFAULT),
                'pass_tampil' => $no_telp_regis,
                'role_id' => 5,
            ];

        if (!$this->psb->checkIfExists($id_santri, 'santri_id', 'psb_akun')) {
            $this->psb->insert_data($dataAkunSantri, 'psb_akun');
        }

        $this->session->set_flashdata('pesan', $getData['nama_lengkap'] . ' Berhasil Menjadi Status Baru Daftar.');
        redirect('santri/sync_psbhosting');
    }

    public function status_santri_aktif($id_santri)
    {
        $getData = $this->psb->getId_data($id_santri, 'psb_data_santri', 'id_santri');
        $dataSantri =
            [
                'kirim_data_santri'         => 1, // status Santri Aktif
                'status_santri'             => 1, // status Santri Aktif
            ];
        $this->psb->update_data('id_santri', $id_santri, 'psb_data_santri', $dataSantri);
        $this->session->set_flashdata('pesan', $getData['nama_lengkap'] . ' Berhasil Menjadi Status Santri Aktif.');
        redirect('santri/sync_psbhosting');
    }

    public function ganti_tapel($id_santri)
    {
        $getData = $this->psb->getId_data($id_santri, 'psb_data_santri', 'id_santri');
        $tapel_inden_id = $this->input->post('ganti_tapel_id');

        $dataSantri =
            [
                'tapel_inden_id'         => $tapel_inden_id, // status Baru Daftar
                // 'status_santri'             => 2, // status Baru Daftar
            ];
        $this->psb->update_data('id_santri', $id_santri, 'psb_data_santri', $dataSantri);

        $this->session->set_flashdata('pesan', $getData['nama_lengkap'] . ' Berhasil Diubah Tahun Pelajaran Inden.');
        redirect('santri/sync_psbhosting');
    }

    public function hapus_santri($id_santri)
    {
        $getData = $this->psb->getId_data($id_santri, 'psb_data_santri', 'id_santri');
        // $id_penghasilan_ortu = $this->input->post('id_penghasilan_ortu_hapus');
        $dataSantri =
            [
                'kirim_data_santri'     => 0,
                'status_santri'         => 0,
            ];

        $this->psb->update_data(
            'id_santri',
            $id_santri,
            'psb_data_santri',
            $dataSantri
        );
        // $this->psb->delete_data('psb_data_santri', 'id_santri', $id_santri);
        $this->psb->delete_data('psb_akun', 'santri_id', $id_santri);
        $this->psb->delete_data('psb_antrian_jadwal', 'santri_antrian_id', $id_santri);
        $this->psb->delete_data('psb_hasil_kesehatan', 'kesehatan_santri_id', $id_santri);
        $this->psb->delete_data('psb_hasil_penilaian', 'hasil_santri_id', $id_santri);
        $this->psb->delete_data('psb_hasil_wawancara', 'wawancara_santri_id', $id_santri);
        $this->psb->delete_data('psb_hasil_wawancara_api', 'wawancara_api_santri_id', $id_santri);
        $this->session->set_flashdata('pesan', 'Data ' . $getData['nama_lengkap'] . ' Berhasil Dihapus!');
        redirect('santri/sync_psbhosting');
    }

    public function hapus_permanen_santri($id_santri)
    {
        // $getData = $this->psb->getId_data($id_santri, 'psb_data_santri', 'id_santri');
        // $id_penghasilan_ortu = $this->input->post('id_penghasilan_ortu_hapus');
        // $dataSantri =
        //     [
        //         'kirim_data_santri'     => 0,
        //         'status_santri'         => 0,
        //     ];

        // $this->psb->update_data(
        //     'id_santri',
        //     $id_santri,
        //     'psb_data_santri',
        //     $dataSantri
        // );
        $this->psb->delete_data('psb_data_santri', 'id_santri', $id_santri);
        $this->psb->delete_data('psb_akun', 'santri_id', $id_santri);
        $this->psb->delete_data('psb_antrian_jadwal', 'santri_antrian_id', $id_santri);
        $this->psb->delete_data('psb_hasil_kesehatan', 'kesehatan_santri_id', $id_santri);
        $this->psb->delete_data('psb_hasil_penilaian', 'hasil_santri_id', $id_santri);
        $this->psb->delete_data('psb_hasil_wawancara', 'wawancara_santri_id', $id_santri);
        $this->psb->delete_data('psb_hasil_wawancara_api', 'wawancara_api_santri_id', $id_santri);
        $this->session->set_flashdata('pesan', 'Data Santri Berhasil Dihapus!');
        redirect('santri/sync_psbhosting');
    }

    public function biodata_santri()
    {
        is_login(array('5'));
        $data['title'] = 'Biodata Santri Baru';
        $data['walsan'] = $this->psb->user_login($this->session->userdata('username'));
        $data['santri_bayar'] = $this->psb->getId_data($data['walsan']['id_santri'], 'psb_pembayaran', 'santri_pembayaran_id');
        $data['bio_santri'] = $this->psb->biodata_santri($data['walsan']['id_santri']);

        $data['jenis_kelamin'] = $this->psb->show_data('psb_jenis_kelamin');
        $data['agama'] = $this->psb->show_data('psb_agama');
        $data['provinsi'] = $this->psb->show_data('psb_master_provinsi');
        $data['tahun_pelajaran'] = $this->psb->show_data('psb_tahun_pelajaran');
        $data['jenjang_sekolah'] = $this->psb->show_data('psb_tingkat_sekolah');
        $data['program_jenjang'] = $this->psb->show_data('psb_program_jenjang');
        $data['transportasi'] = $this->psb->show_data('psb_alat_transportasi');
        $data['kebutuhan_khusus'] = $this->psb->show_data('psb_kebutuhan_khusus');

        $this->form_validation->set_rules('nik_santri', 'NIK Santri', 'trim|required');
        $this->form_validation->set_rules('kk_santri', 'No KK Santri', 'trim|required');
        $this->form_validation->set_rules('nisn_santri', 'NISN Santri', 'trim|required');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap Santri', 'trim|required');
        $this->form_validation->set_rules('nama_panggilan', 'Nama Panggilan Santri', 'trim|required');
        $this->form_validation->set_rules('agama_id', 'Agama Santri', 'trim|required');
        $this->form_validation->set_rules('jenis_kelamin_id', 'Jenis Kelamin Santri', 'trim|required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir Santri', 'trim|required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir Santri', 'trim|required');
        if (empty($data['bio_santri']['alamat'])) {
            $this->form_validation->set_rules('alamat', 'Alamat Santri', 'trim|required');
            $this->form_validation->set_rules('prov_santri', 'Provinsi Santri', 'trim|required');
            $this->form_validation->set_rules('kotakab_santri', 'Kota Kabupaten Santri', 'trim|required');
            $this->form_validation->set_rules('kec_santri', 'Kecamatan Santri', 'trim|required');
            $this->form_validation->set_rules('kel_santri', 'Kelurahan Santri', 'trim|required');
        }
        $this->form_validation->set_rules('asal_sekolah', 'Asal Sekolah', 'trim|required');
        // $this->form_validation->set_rules('tapel_inden_id', 'Tahun Pelajaran', 'trim|required');
        // $this->form_validation->set_rules('program_jenjang_id', 'Program Jenjang', 'trim|required');
        // $this->form_validation->set_rules('daftar_tingkat_id', 'Jenjang Sekolah', 'trim|required');
        $this->form_validation->set_rules('berat_badan', 'Berat Badan', 'trim|required');
        $this->form_validation->set_rules('tinggi_badan', 'Tinggi Badan', 'trim|required');
        $this->form_validation->set_rules('email', 'Email Santri', 'trim|required');
        // $this->form_validation->set_rules('skhun', 'SKHUN Santri', 'trim|required');
        // $this->form_validation->set_rules('nomor_ijazah', 'Nomor Ijazah Santri', 'trim|required');
        // $this->form_validation->set_rules('tanggal_ijazah', 'Tanggal Ijazah Santri', 'trim|required');
        // $this->form_validation->set_rules('kode_pos', 'Kode Pos', 'trim|required');
        // $this->form_validation->set_rules('no_hp', 'No HP Santri', 'trim|required');
        // $this->form_validation->set_rules('kebutuhan_khusus_id', 'Kebutuhan Khusus', 'trim|required');
        // $this->form_validation->set_rules('alat_transportasi_id', 'Alat Transportasi', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('santri/biodata_santri', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $id_santri = $data['bio_santri']['id_santri'];
            $nik_santri = htmlspecialchars($this->input->post('nik_santri'));
            $kk_santri = htmlspecialchars($this->input->post('kk_santri'));
            $nisn_santri = htmlspecialchars($this->input->post('nisn_santri'));
            $nama_lengkap = htmlspecialchars($this->input->post('nama_lengkap'));
            $nama_panggilan = htmlspecialchars($this->input->post('nama_panggilan'));
            $agama_id = htmlspecialchars($this->input->post('agama_id'));
            $jenis_kelamin_id = htmlspecialchars($this->input->post('jenis_kelamin_id'));
            $tempat_lahir = htmlspecialchars($this->input->post('tempat_lahir'));
            $tanggal_lahir = htmlspecialchars($this->input->post('tanggal_lahir'));
            $alamat = htmlspecialchars($this->input->post('alamat'));
            // $prov_santri = htmlspecialchars($this->input->post('prov_santri'));
            // $kotakab_santri = htmlspecialchars($this->input->post('kotakab_santri'));
            // $kec_santri = htmlspecialchars($this->input->post('kec_santri'));
            $kel_santri = htmlspecialchars($this->input->post('kel_santri'));
            $kode_pos = htmlspecialchars($this->input->post('kode_pos'));
            $no_hp = htmlspecialchars($this->input->post('no_hp'));
            $email = htmlspecialchars($this->input->post('email'));
            $skhun = htmlspecialchars($this->input->post('skhun'));
            $nomor_ijazah = htmlspecialchars($this->input->post('nomor_ijazah'));
            $tanggal_ijazah = htmlspecialchars($this->input->post('tanggal_ijazah'));
            $asal_sekolah = htmlspecialchars($this->input->post('asal_sekolah'));
            $tapel_inden_id = htmlspecialchars($this->input->post('tapel_inden_id'));
            $program_jenjang_id = htmlspecialchars($this->input->post('program_jenjang_id'));
            $daftar_tingkat_id = htmlspecialchars($this->input->post('daftar_tingkat_id'));
            $alat_transportasi_id = htmlspecialchars($this->input->post('alat_transportasi_id'));
            $kebutuhan_khusus_id = htmlspecialchars($this->input->post('kebutuhan_khusus_id'));
            $berat_badan = htmlspecialchars($this->input->post('berat_badan'));
            $tinggi_badan = htmlspecialchars($this->input->post('tinggi_badan'));

            if (empty($data['bio_santri']['alamat'])) {
                $dataSantri =
                    [
                        'nik_santri'     => $nik_santri,
                        'kk_santri'     => $kk_santri,
                        'nisn_santri'     => $nisn_santri,
                        'nama_lengkap'     => $nama_lengkap,
                        'nama_panggilan'     => $nama_panggilan,
                        'agama_id'     => $agama_id,
                        'jenis_kelamin_id'     => $jenis_kelamin_id,
                        'tempat_lahir'     => $tempat_lahir,
                        'tanggal_lahir'     => $tanggal_lahir,
                        'alamat'     => $alamat,
                        'desa_kelurahan_id'     => $kel_santri,
                        // 'prov_santri'     => $prov_santri,
                        // 'kotakab_santri'     => $kotakab_santri,
                        // 'kec_santri'     => $kec_santri,
                        'kode_pos'     => $kode_pos,
                        'no_hp'     => $no_hp,
                        'email'     => $email,
                        'skhun'     => $skhun,
                        'nomor_ijazah'     => $nomor_ijazah,
                        'tanggal_ijazah'     => $tanggal_ijazah,
                        'asal_sekolah'     => $asal_sekolah,
                        // 'tapel_inden_id'     => $tapel_inden_id,
                        // 'program_jenjang_id'     => $program_jenjang_id,
                        // 'daftar_tingkat_id'     => $daftar_tingkat_id,
                        'kebutuhan_khusus_id'     => $kebutuhan_khusus_id,
                        'alat_transportasi_id'     => $alat_transportasi_id,
                        'berat_badan'     => $berat_badan,
                        'tinggi_badan'     => $tinggi_badan,
                    ];
            } else {
                $dataSantri =
                    [
                        'nik_santri'     => $nik_santri,
                        'kk_santri'     => $kk_santri,
                        'nisn_santri'     => $nisn_santri,
                        'nama_lengkap'     => $nama_lengkap,
                        'nama_panggilan'     => $nama_panggilan,
                        'agama_id'     => $agama_id,
                        'jenis_kelamin_id'     => $jenis_kelamin_id,
                        'tempat_lahir'     => $tempat_lahir,
                        'tanggal_lahir'     => $tanggal_lahir,
                        'kode_pos'     => $kode_pos,
                        'no_hp'     => $no_hp,
                        'email'     => $email,
                        'skhun'     => $skhun,
                        'nomor_ijazah'     => $nomor_ijazah,
                        'tanggal_ijazah'     => $tanggal_ijazah,
                        'asal_sekolah'     => $asal_sekolah,
                        'tapel_inden_id'     => $tapel_inden_id,
                        'program_jenjang_id'     => $program_jenjang_id,
                        'daftar_tingkat_id'     => $daftar_tingkat_id,
                        'kebutuhan_khusus_id'     => $kebutuhan_khusus_id,
                        'alat_transportasi_id'     => $alat_transportasi_id,
                        'berat_badan'     => $berat_badan,
                        'tinggi_badan'     => $tinggi_badan,
                    ];
            }

            $this->psb->update_data('id_santri', $id_santri, 'psb_data_santri', $dataSantri);
            $this->session->set_flashdata('pesan', 'Data Berhasil Disimpan!');
            redirect('santri/biodata_santri');
        }
    }

    public function edit_program_jenjang()
    {
        $data['walsan'] = $this->psb->user_login($this->session->userdata('username'));
        $data['santri_bayar'] = $this->psb->getId_data($data['walsan']['id_santri'], 'psb_pembayaran', 'santri_pembayaran_id');
        $data['bio_santri'] = $this->psb->biodata_santri($data['walsan']['id_santri']);

        $id_santri = $data['bio_santri']['id_santri'];
        $dataSantri =
            [
                'program_jenjang_id'     => 0,
                'daftar_tingkat_id'     => 0,
                'tapel_inden_id'     => 0,
            ];

        $this->psb->update_data('id_santri', $id_santri, 'psb_data_santri', $dataSantri);
        redirect('santri/biodata_santri');
    }

    public function edit_alamat()
    {
        $data['walsan'] = $this->psb->user_login($this->session->userdata('username'));
        $data['santri_bayar'] = $this->psb->getId_data($data['walsan']['id_santri'], 'psb_pembayaran', 'santri_pembayaran_id');
        $data['bio_santri'] = $this->psb->biodata_santri($data['walsan']['id_santri']);

        $id_santri = $data['bio_santri']['id_santri'];
        $dataSantri =
            [
                'alamat'     => '',
                'desa_kelurahan_id'     => '',
            ];

        $this->psb->update_data('id_santri', $id_santri, 'psb_data_santri', $dataSantri);
        redirect('santri/biodata_santri');
    }

    public function data_orangtua()
    {
        is_login(array('5'));
        $data['title'] = 'Biodata Santri Baru';
        $data['walsan'] = $this->psb->user_login($this->session->userdata('username'));
        $data['santri_bayar'] = $this->psb->getId_data($data['walsan']['id_santri'], 'psb_pembayaran', 'santri_pembayaran_id');
        $data['bio_santri'] = $this->psb->biodata_santri($data['walsan']['id_santri']);

        $data['pendidikan_ortu'] = $this->psb->show_data('psb_pendidikan_ortu');
        $data['pekerjaan_ortu'] = $this->psb->show_data('psb_pekerjaan_ortu');
        $data['penghasilan_ortu'] = $this->psb->show_data('psb_penghasilan_ortu');

        $cekbox = $this->input->post('customCheck');

        $this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'trim|required');
        $this->form_validation->set_rules('nik_ayah', 'NIK Ayah', 'trim|required');
        $this->form_validation->set_rules('tahun_lahir_ayah', 'Tahun Lahir Ayah', 'trim|required');
        $this->form_validation->set_rules('nohp_ayah', 'No HP Ayah', 'trim|required');
        $this->form_validation->set_rules('pendidikan_ayah_id', 'Pendidikan Ayah', 'trim|required');
        $this->form_validation->set_rules('pekerjaan_ayah_id', 'Pekerjaan Ayah', 'trim|required');
        $this->form_validation->set_rules('penghasilan_ayah_id', 'Penghasilan Ayah', 'trim|required');
        $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'trim|required');
        $this->form_validation->set_rules('nik_ibu', 'NIK Ibu', 'trim|required');
        $this->form_validation->set_rules('tahun_lahir_ibu', 'Tahun Lahir Ibu', 'trim|required');
        $this->form_validation->set_rules('nohp_ibu', 'No HP Ibu', 'trim|required');
        $this->form_validation->set_rules('pendidikan_ibu_id', 'Pendidikan Ibu', 'trim|required');
        $this->form_validation->set_rules('pekerjaan_ibu_id', 'Pekerjaan Ibu', 'trim|required');
        $this->form_validation->set_rules('penghasilan_ibu_id', 'Penghasilan Ibu', 'trim|required');
        if ($cekbox == 1) {
            $this->form_validation->set_rules('nama_wali', 'Nama Wali', 'trim|required');
            $this->form_validation->set_rules('nik_wali', 'NIK Wali', 'trim|required');
            $this->form_validation->set_rules('tahun_lahir_wali', 'Tahun Lahir Wali', 'trim|required');
            $this->form_validation->set_rules('nohp_wali', 'No HP Wali', 'trim|required');
            $this->form_validation->set_rules('pendidikan_wali_id', 'Pendidikan Wali', 'trim|required');
            $this->form_validation->set_rules('pekerjaan_wali_id', 'Pekerjaan Wali', 'trim|required');
            $this->form_validation->set_rules('penghasilan_wali_id', 'Penghasilan Wali', 'trim|required');
        }

        if ($this->form_validation->run() == false) {
            $this->load->view('template/manage_header', $data);
            $this->load->view('template/manage_navbar', $data);
            $this->load->view('santri/data_orangtua', $data);
            $this->load->view('template/manage_footer', $data);
        } else {
            $id_santri = $data['bio_santri']['id_santri'];
            $nama_ayah = htmlspecialchars($this->input->post('nama_ayah'));
            $nik_ayah = htmlspecialchars($this->input->post('nik_ayah'));
            $tahun_lahir_ayah = htmlspecialchars($this->input->post('tahun_lahir_ayah'));
            $nohp_ayah = htmlspecialchars($this->input->post('nohp_ayah'));
            $pendidikan_ayah_id = htmlspecialchars($this->input->post('pendidikan_ayah_id'));
            $pekerjaan_ayah_id = htmlspecialchars($this->input->post('pekerjaan_ayah_id'));
            $penghasilan_ayah_id = htmlspecialchars($this->input->post('penghasilan_ayah_id'));
            $nama_ibu = htmlspecialchars($this->input->post('nama_ibu'));
            $nik_ibu = htmlspecialchars($this->input->post('nik_ibu'));
            $tahun_lahir_ibu = htmlspecialchars($this->input->post('tahun_lahir_ibu'));
            $nohp_ibu = htmlspecialchars($this->input->post('nohp_ibu'));
            $pendidikan_ibu_id = htmlspecialchars($this->input->post('pendidikan_ibu_id'));
            $pekerjaan_ibu_id = htmlspecialchars($this->input->post('pekerjaan_ibu_id'));
            $penghasilan_ibu_id = htmlspecialchars($this->input->post('penghasilan_ibu_id'));
            $nama_wali = htmlspecialchars($this->input->post('nama_wali'));
            $nik_wali = htmlspecialchars($this->input->post('nik_wali'));
            $tahun_lahir_wali = htmlspecialchars($this->input->post('tahun_lahir_wali'));
            $nohp_wali = htmlspecialchars($this->input->post('nohp_wali'));
            $pendidikan_wali_id = htmlspecialchars($this->input->post('pendidikan_wali_id'));
            $pekerjaan_wali_id = htmlspecialchars($this->input->post('pekerjaan_wali_id'));
            $penghasilan_wali_id = htmlspecialchars($this->input->post('penghasilan_wali_id'));

            $dataSantri =
                [
                    'nama_ayah'     => $nama_ayah,
                    'nik_ayah'     => $nik_ayah,
                    'tahun_lahir_ayah'     => $tahun_lahir_ayah,
                    'nohp_ayah'     => $nohp_ayah,
                    'pendidikan_ayah_id'     => $pendidikan_ayah_id,
                    'pekerjaan_ayah_id'     => $pekerjaan_ayah_id,
                    'penghasilan_ayah_id'     => $penghasilan_ayah_id,
                    'nama_ibu'     => $nama_ibu,
                    'nik_ibu'     => $nik_ibu,
                    'tahun_lahir_ibu'     => $tahun_lahir_ibu,
                    'nohp_ibu'     => $nohp_ibu,
                    'pendidikan_ibu_id'     => $pendidikan_ibu_id,
                    'pekerjaan_ibu_id'     => $pekerjaan_ibu_id,
                    'penghasilan_ibu_id'     => $penghasilan_ibu_id,
                    'nama_wali'     => $nama_wali,
                    'nik_wali'     => $nik_wali,
                    'tahun_lahir_wali'     => $tahun_lahir_wali,
                    'nohp_wali'     => $nohp_wali,
                    'pendidikan_wali_id'     => $pendidikan_wali_id,
                    'pekerjaan_wali_id'     => $pekerjaan_wali_id,
                    'penghasilan_wali_id'     => $penghasilan_wali_id,
                ];

            $this->psb->update_data('id_santri', $id_santri, 'psb_data_santri', $dataSantri);
            $this->session->set_flashdata('pesan', 'Data Berhasil Disimpan!');
            redirect('santri/data_orangtua');
        }
    }

    public function foto_santri()
    {
        is_login(array('5'));
        $data['title'] = 'Biodata Santri Baru';
        $data['walsan'] = $this->psb->user_login($this->session->userdata('username'));
        $data['santri_bayar'] = $this->psb->getId_data($data['walsan']['id_santri'], 'psb_pembayaran', 'santri_pembayaran_id');
        $data['bio_santri'] = $this->psb->biodata_santri($data['walsan']['id_santri']);

        $this->load->view('template/manage_header', $data);
        $this->load->view('template/manage_navbar', $data);
        $this->load->view('santri/foto_santri', $data);
        $this->load->view('template/manage_footer', $data);
    }

    public function upload_foto_santri()
    {
        $data['walsan'] = $this->psb->user_login($this->session->userdata('username'));

        $config['upload_path'] = './assets/file_foto/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 512;
        $config['file_name'] = $data['walsan']['id_santri'] . '_' . $data['walsan']['nama_lengkap'] . '_' . $data['walsan']['no_registrasi'];

        $this->load->library('upload', $config);
        // $this->upload->initialize($config);
        if (!$this->upload->do_upload('file_foto_santri')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            return redirect('santri/foto_santri');
        } else {
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];
            $id_santri = $data['walsan']['id_santri'];
            $nama_file = $data['walsan']['foto_santri'];

            $dataSantri = [
                'foto_santri' => $file_name,
            ];

            if ($nama_file && file_exists('./assets/file_foto/' . $nama_file)) {
                if ($nama_file != 'akun.jpg') {
                    unlink('./assets/file_foto/' . $nama_file);
                }
            }

            $this->psb->update_data('id_santri', $id_santri, 'psb_data_santri', $dataSantri);
            $this->session->set_flashdata('pesan', 'Foto Berhasil Diunggah.');
            redirect('santri/foto_santri');
        }
    }

    public function jadwal_tes()
    {
        is_login(array('5'));
        $data['title'] = 'Jadwal Tes Santri';
        $data['walsan'] = $this->psb->user_login($this->session->userdata('username'));
        $data['santri_bayar'] = $this->psb->getId_data($data['walsan']['id_santri'], 'psb_pembayaran', 'santri_pembayaran_id');
        $data['bio_santri'] = $this->psb->biodata_santri($data['walsan']['id_santri']);
        $data['jadwal_santri'] = $this->psb->jadwal_persantri($data['walsan']['id_santri']);

        $this->load->view('template/manage_header', $data);
        $this->load->view('template/manage_navbar', $data);
        $this->load->view('santri/jadwal_tes', $data);
        $this->load->view('template/manage_footer', $data);
    }

    public function kirim_data()
    {
        is_login(array('5'));
        $data['title'] = 'Biodata Santri Baru';
        $data['walsan'] = $this->psb->user_login($this->session->userdata('username'));
        $data['santri_bayar'] = $this->psb->getId_data($data['walsan']['id_santri'], 'psb_pembayaran', 'santri_pembayaran_id');
        $data['bio_santri'] = $this->psb->biodata_santri($data['walsan']['id_santri']);

        $id_santri = $data['bio_santri']['id_santri'];
        $tapel_id = $data['bio_santri']['tapel_inden_id'];
        $dataSantri =
            [
                'kirim_data_santri'     => 1,
                'status_santri'         => 3, // status dalam seleksi
            ];

        $this->psb->update_data('id_santri', $id_santri, 'psb_data_santri', $dataSantri);

        $no_urut = $this->psb->nomor_antrian();
        $tahap_awal = $this->psb->getdata_teratas('psb_tahap', 'id_tahap');
        $dataAntrianJadwal =
            [
                'santri_antrian_id'         => $id_santri,
                'tapel_antrian_id'          => $tapel_id,
                'no_urut_antrian'           => $no_urut,
                'antrian_tahap_id'          => $tahap_awal['id_tahap'],
                'tanggal_masuk_antrian'     => date('Y-m-d'), // tanggal hari itu juga
            ];
        $this->psb->insert_data($dataAntrianJadwal, 'psb_antrian_jadwal');
        $this->session->set_flashdata('pesan', 'Data Berhasil Dikirim!');
        redirect('santri/biodata_santri');
    }

    public function cetak_biodata($id_santri)
    {
        is_login(array('1', '2', '3'));
        $data['title'] = 'Biodata Santri Baru';
        $data['bio_santri'] = $this->psb->biodata_santri($id_santri);

        $this->load->view('santri/cetak_biodata', $data);
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

    public function DataSantri_bySekolah()
    {
        is_login(array('2', '3'));
        $data['title'] = 'Data Calon Santri';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        // var_dump($data['panitia']);
        // die;
        $data['AllTapel'] = $this->psb->show_data('psb_tahun_pelajaran');

        $this->load->view('template/manage_header', $data);
        $this->load->view('template/manage_navbar', $data);
        $this->load->view('santri/data_santri_sekolah', $data);
        $this->load->view('template/manage_footer', $data);
    }

    public function load_dataSantriSekolah()
    {
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $daftar_tingkat_id = $data['panitia']['unit_tugas_id'];
        // var_dump($daftar_tingkat_id);
        // die;
        $tapel_inden_id = $this->input->post('filterData_santri_tingkat');

        $calonSantri = $this->psb->DataSantriPErTingkat($daftar_tingkat_id, $tapel_inden_id);
        // $calonSantri = $this->psb->dataFilter_santri($tapel_inden_id);

        // Tampilkan data dalam bentuk tabel di dalam card
        $output = '<div class="col-md-12"><div class="card mb-2"><div class="card-header bg-primary">';
        $output .= '<h6 class="m-0 font-weight-bold text-white">Data Calon Santri</h6></div>';
        $output .= '<div class="card-body">';
        $output .= '<div class="table-responsive"><table id="Casan_perSekolah" class="table table-bordered table-striped" width="100%" cellspacing="0">';
        $output .= '<thead style="background-color: teal;" class="text-white text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Santri</th>
                            <th>Alamat</th>
                            <th>Nama Ayah</th>
                            <th>Asal Sekolah</th>
                            <th>Tahun Pelajaran Inden</th>
                            <th>Jenjang</th>
                            <th>Program</th>
                            <th>Aksi</th>
                        </tr>
                    </thead><tbody>';

        $no = 1;
        foreach ($calonSantri as $santri) {
            $output .= '<tr>';
            $output .= '<td class="text-center">' . $no++ . '</td>';
            $output .= '<td>' . $santri['nama_lengkap'] . '</td>';
            $output .= '<td class="text-center">' . $santri['alamat'] . ' Kelurahan ' . $santri['nama_kelurahan'] . ' Kecamatan ' . $santri['nama_kecamatan'] . ' ' . $santri['nama_kota_kab'] . ' ' . $santri['nama_provinsi'] . '</td>';
            $output .= '<td class="text-center">' . $santri['nama_ayah'] . '</td>';
            $output .= '<td class="text-center">' . $santri['asal_sekolah'] . '</td>';
            if ($santri['tapel_inden_id'] != 0) {
                $output .= '<td class="text-center">' . $santri['ket_tapel'] . '</td>';
            } else {
                $output .= '<td class="text-center"><span class="badge badge-danger">Data Belum Ada</span></td>';
            }
            if ($santri['daftar_tingkat_id'] != 0) {
                $output .= '<td class="text-center">' . $santri['nama_tingkat'] . '</td>';
            } else {
                $output .= '<td class="text-center"><span class="badge badge-danger">Data Belum Ada</span></td>';
            }
            if ($santri['program_jenjang_id'] != 0) {
                $output .= '<td class="text-center">' . $santri['nama_program'] . '</td>';
            } else {
                $output .= '<td class="text-center"><span class="badge badge-danger">Data Belum Ada</span></td>';
            }
            $output .= '<td><a href="' . base_url("santri/cetak_biodata/" . $santri['id_santri']) . '" class="badge badge-success" target="_blank"><i class="fas fa-eye"></i> Biodata</a> || <a href="' . base_url("pembayaran/pembayaran_santri/" . $santri['id_santri']) . '" class="badge badge-danger" target="_blank"><i class="far fa-money-bill-alt"></i> Bayar Regis</a> || <a href="' . base_url("santri/resume_nilai/" . $santri['id_santri']) . '" class="badge badge-info" target="_blank"><i class="far fa-list-alt"></i> Resume Nilai</a></td>';
            $output .= '</tr>';
        }

        $output .= '</tbody></table></div></div></div></div>';

        echo $output;
    }

    public function data_santri()
    {
        is_login(array('2', '3'));
        $data['title'] = 'Data Calon Santri';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['AllTapel'] = $this->psb->show_data('psb_tahun_pelajaran');

        $this->load->view('template/manage_header', $data);
        $this->load->view('template/manage_navbar', $data);
        $this->load->view('santri/data_santri', $data);
        $this->load->view('template/manage_footer', $data);
    }

    public function load_dataSantri()
    {
        $tapel_inden_id = $this->input->post('filter_tapel_casan');

        $calonSantri = $this->psb->dataFilter_santri($tapel_inden_id);

        // Tampilkan data dalam bentuk tabel di dalam card
        $output = '<div class="col-md-12"><div class="card mb-2"><div class="card-header bg-primary">';
        $output .= '<h6 class="m-0 font-weight-bold text-white">Data Calon Santri</h6></div>';
        $output .= '<div class="card-body">';
        $output .= '<div class="table-responsive"><table id="table_Datacasan" class="table table-bordered table-striped" width="100%" cellspacing="0">';
        $output .= '<thead style="background-color: teal;" class="text-white text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Santri</th>
                            <th>Alamat</th>
                            <th>Nama Orang Tua</th>
                            <th>Asal Sekolah</th>
                            <th>Tahun Pelajaran Inden</th>
                            <th>Jenjang</th>
                            <th>Program</th>
                            <th>Aksi</th>
                        </tr>
                    </thead><tbody>';

        $no = 1;
        foreach ($calonSantri as $santri) {
            $output .= '<tr>';
            $output .= '<td class="text-center">' . $no++ . '</td>';
            $output .= '<td>' . $santri['nama_lengkap'] . '</td>';
            $output .= '<td class="text-center">' . $santri['alamat'] . ' Kelurahan ' . $santri['nama_kelurahan'] . ' Kecamatan ' . $santri['nama_kecamatan'] . ' ' . $santri['nama_kota_kab'] . ' ' . $santri['nama_provinsi'] . '</td>';
            $output .= '<td class="text-center">' . 'Bpk. ' . $santri['nama_ayah'] . ' | Ibu ' . $santri['nama_ibu'] . '</td>';
            $output .= '<td class="text-center">' . $santri['asal_sekolah'] . '</td>';
            if ($santri['tapel_inden_id'] != 0) {
                $output .= '<td class="text-center">' . $santri['ket_tapel'] . '</td>';
            } else {
                $output .= '<td class="text-center"><span class="badge badge-danger">Data Belum Ada</span></td>';
            }
            if ($santri['daftar_tingkat_id'] != 0) {
                $output .= '<td class="text-center">' . $santri['nama_tingkat'] . '</td>';
            } else {
                $output .= '<td class="text-center"><span class="badge badge-danger">Data Belum Ada</span></td>';
            }
            if ($santri['program_jenjang_id'] != 0) {
                $output .= '<td class="text-center">' . $santri['nama_program'] . '</td>';
            } else {
                $output .= '<td class="text-center"><span class="badge badge-danger">Data Belum Ada</span></td>';
            }
            $output .= '<td><a href="' . base_url("santri/cetak_biodata/" . $santri['id_santri']) . '" class="badge badge-success" target="_blank"><i class="fas fa-eye"></i> Biodata</a> || <a href="' . base_url("pembayaran/pembayaran_santri/" . $santri['id_santri']) . '" class="badge badge-danger" target="_blank"><i class="far fa-money-bill-alt"></i> Bayar Regis</a> || <a href="' . base_url("santri/resume_nilai/" . $santri['id_santri']) . '" class="badge badge-info" target="_blank"><i class="far fa-list-alt"></i> Resume Nilai</a></td>';
            $output .= '</tr>';
        }

        $output .= '</tbody></table></div></div></div></div>';

        echo $output;
    }

    public function resume_nilai($id_santri)
    {
        is_login(array('2', '3'));
        $data['title'] = 'Data Calon Santri';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['bio_santri'] = $this->psb->biodata_santri($id_santri);
        $data['Tahap2QS'] = $this->psb->casan_QStahap2($id_santri);
        $data['AllPenilaian'] = $this->psb->Data_HasilPenilaian($id_santri);
        $data['AllKesehatan'] = $this->psb->Data_HasilKesehatan($id_santri);
        $data['WawancaraOrtuSantri'] = $this->psb->Data_HasilWawancara($id_santri);
        $data['PembiayaanOrtu'] = $this->psb->getPembiayaan_ortu($id_santri);

        $this->load->view('template/manage_header', $data);
        $this->load->view('template/manage_navbar', $data);
        $this->load->view('santri/resume_nilai', $data);
        $this->load->view('template/manage_footer', $data);
    }

    public function cetak_resume_nilai($id_santri)
    {
        is_login(array('2', '3'));
        $data['title'] = 'Resume Santri Baru';
        $data['bio_santri'] = $this->psb->biodata_santri($id_santri);
        $data['AllPenilaian'] = $this->psb->Data_HasilPenilaian($id_santri);
        $data['AllKesehatan'] = $this->psb->Data_HasilKesehatan($id_santri);
        $data['WawancaraOrtuSantri'] = $this->psb->Data_HasilWawancara($id_santri);
        $data['PembiayaanOrtu'] = $this->psb->getPembiayaan_ortu($id_santri);

        $this->load->view('santri/cetak_resume_nilai', $data);
    }

    public function proses_plenoPSB()
    {
        is_login(array('2', '3'));
        $data['title'] = 'Data Pleno PSB';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $data['JadwalTes'] = $this->psb->jadwal_tes();
        $data['ProgramJenjang'] = $this->psb->show_data('psb_program_jenjang');
        $data['TahunPelajaran'] = $this->psb->show_data('psb_tahun_pelajaran');

        $this->load->view('template/manage_header', $data);
        $this->load->view('template/manage_navbar', $data);
        $this->load->view('santri/proses_pleno_psb', $data);
        $this->load->view('template/manage_footer', $data);
    }

    public function load_rekapPlenobyJadwal()
    {
        $id_jadwal_tes = $this->input->post('jadwal_santri_diterima');
        $id_program = $this->input->post('filter_program_pleno');

        $getData = $this->psb->getId_data($id_jadwal_tes, 'psb_antrian_jadwal', 'jadwal_tes_id');
        $tapel_id = $getData['tapel_antrian_id'];

        $getJadwal = $this->psb->getId_data($id_jadwal_tes, 'psb_jadwal_tes', 'id_jadwal_tes');
        $getProgram = $this->psb->getId_data($id_program, 'psb_program_jenjang', 'id_program_jenjang');
        // $calonSantri = $this->psb->DataSantri_byJadwal($id_jadwal_tes, $tapel_id);
        // $calonSantri = $this->psb->Casan_ByJadwalByProgram($id_jadwal_tes, $tapel_id, $id_program);
        $AllCasanPerJadwal = $this->psb->jumlahCasanPerJadwal($id_jadwal_tes, $tapel_id);
        $AllCasanDiterima = $this->psb->jumlahCasanAll_diterima($id_jadwal_tes, $tapel_id, $id_program);
        $AllCasanDitolak = $this->psb->jumlahCasanAll_ditolak($id_jadwal_tes, $tapel_id, $id_program);
        $AllCasanPending = $this->psb->jumlahCasanAll_pending($id_jadwal_tes, $tapel_id, $id_program);
        $CasanCowok = $this->psb->jumlahCasanCowok_diterima($id_jadwal_tes, $tapel_id, $id_program);
        $CasanCewek = $this->psb->jumlahCasanCewek_diterima($id_jadwal_tes, $tapel_id, $id_program);

        // Tampilkan data dalam bentuk tabel di dalam card
        $output = '
        <div class="row mb-4">
            <div class="col-lg-4 mb-2">
                <div class="card bg-gradient-success text-white shadow">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="card-title mb-0">Total Santri ' . $getProgram['nama_program'] . ' Diterima</h5>
                                <span class="h2 font-weight-bold mb-0">' . $AllCasanDiterima . '</span>
                            </div>
                            <div>
                                <i class="fas fa-users fa-3x opacity-75"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="text-white-50">Pada ' . $getJadwal['nama_jadwal'] . ' Hari ' . $getJadwal['nama_hari'] . ' Tanggal ' . tanggal_indonesia_format2($getJadwal['tanggal_tes']) . '</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-2">
                <div class="card bg-gradient-warning text-white shadow">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="card-title mb-0">Total Santri ' . $getProgram['nama_program'] . ' Pending</h5>
                                <span class="h2 font-weight-bold mb-0">' . $AllCasanPending . '</span>
                            </div>
                            <div>
                                <i class="fas fa-users fa-3x opacity-75"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="text-white-50">Pada ' . $getJadwal['nama_jadwal'] . ' Hari ' . $getJadwal['nama_hari'] . ' Tanggal ' . tanggal_indonesia_format2($getJadwal['tanggal_tes']) . '</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-2">
                <div class="card bg-gradient-danger text-white shadow">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="card-title mb-0">Total Santri ' . $getProgram['nama_program'] . ' Ditolak</h5>
                                <span class="h2 font-weight-bold mb-0">' . $AllCasanDitolak . '</span>
                            </div>
                            <div>
                                <i class="fas fa-users fa-3x opacity-75"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="text-white-50">Pada ' . $getJadwal['nama_jadwal'] . ' Hari ' . $getJadwal['nama_hari'] . ' Tanggal ' . tanggal_indonesia_format2($getJadwal['tanggal_tes']) . '</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Jumlah Santri ' . $getJadwal['nama_jadwal'] . '</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">' . $AllCasanPerJadwal . '</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Laki-laki</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">' . $CasanCowok . '</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-male fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Perempuan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">' . $CasanCewek . '</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-female fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ';

        echo $output;
    }

    public function load_prosesterimasantri()
    {
        $id_jadwal_tes = $this->input->post('jadwal_santri_diterima');
        $id_program = $this->input->post('filter_program_pleno');

        $getData = $this->psb->getId_data($id_jadwal_tes, 'psb_antrian_jadwal', 'jadwal_tes_id');
        $tapel_id = $getData['tapel_antrian_id'];

        // $calonSantri = $this->psb->DataSantri_byJadwal($id_jadwal_tes, $tapel_id);
        $calonSantri = $this->psb->Casan_ByJadwalByProgram($id_jadwal_tes, $tapel_id, $id_program);

        // Tampilkan data dalam bentuk tabel di dalam card
        $output = '<div class="col-md-12"><div class="card mb-2"><div class="card-header bg-primary">';
        $output .= '<h6 class="m-0 font-weight-bold text-white">Data Calon Santri</h6></div>';
        $output .= '<div class="card-body">';
        $output .= '<div class="table-responsive"><table id="tableSantri_byJadwal" class="table table-bordered table-striped" width="100%" cellspacing="0">';
        $output .= '<thead style="background-color: teal;" class="text-white text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Santri</th>
                            <th>Alamat</th>
                            <th>Nama Orang Tua</th>
                            <th>Asal Sekolah</th>
                            <th>Program Dipilih</th>
                            <th>Aksi</th>
                        </tr>
                    </thead><tbody>';

        $no = 1;
        foreach ($calonSantri as $santri) {
            $output .= '<tr>';
            $output .= '<td class="text-center">' . $no++ . '</td>';
            $output .= '<td>' . $santri['nama_lengkap'] . '</td>';
            $output .= '<td class="text-center">' . $santri['alamat'] . ' Kelurahan ' . $santri['nama_kelurahan'] . ' Kecamatan ' . $santri['nama_kecamatan'] . ' ' . $santri['nama_kota_kab'] . ' ' . $santri['nama_provinsi'] . '</td>';
            $output .= '<td class="text-center">' . 'Bpk. ' . $santri['nama_ayah'] . ' | Ibu ' . $santri['nama_ibu'] . '</td>';
            $output .= '<td class="text-center">' . $santri['asal_sekolah'] . '</td>';
            if ($santri['tapel_inden_id'] != 0) {
                $output .= '<td class="text-center">' . $santri['nama_tingkat'] . '-' . $santri['nama_program'] . '-' . $santri['ket_tapel'] . '</td>';
            } else {
                $output .= '<td class="text-center"><span class="badge badge-danger">Data Belum Ada</span></td>';
            }
            $output .= '<td><a href="' . base_url("santri/cetak_biodata/" . $santri['id_santri']) . '" class="badge badge-success" target="_blank"><i class="fas fa-eye"></i> Biodata</a> || <a href="' . base_url("santri/resume_nilai/" . $santri['id_santri']) . '" class="badge badge-info" target="_blank"><i class="far fa-list-alt"></i> Resume Nilai</a></td>';
            $output .= '</tr>';
        }

        $output .= '</tbody></table></div></div></div></div>';

        echo $output;
    }

    public function diterima($id_santri)
    {
        $getData = $this->psb->getId_data($id_santri, 'psb_data_santri', 'id_santri');
        $dataSantri =
            [
                'status_santri'         => 1, // status Diterima
            ];

        $this->psb->update_data('id_santri', $id_santri, 'psb_data_santri', $dataSantri);
        $this->session->set_flashdata('pesan', $getData['nama_lengkap'] . ' Telah Diterima Sebagai Santri Bayl-Alhikmah. :)');
        redirect('santri/resume_nilai/' . $id_santri);
    }

    public function masuk_MI($id_santri)
    {
        $getData = $this->psb->getId_data($id_santri, 'psb_data_santri', 'id_santri');
        $dataSantri =
            [
                'status_santri'              => 1, // status Diterima
                'program_jenjang_id'         => 1, // status Diterima
            ];

        $this->psb->update_data('id_santri', $id_santri, 'psb_data_santri', $dataSantri);
        $this->psb->hapusAntrian_tahap2($id_santri);
        $this->session->set_flashdata('pesan', $getData['nama_lengkap'] . ' Telah Diterima Sebagai Santri Bayl-Alhikmah. :)');
        redirect('santri/resume_nilai/' . $id_santri);
    }

    public function ditolak($id_santri)
    {
        $getData = $this->psb->getId_data($id_santri, 'psb_data_santri', 'id_santri');
        $dataSantri =
            [
                'status_santri'         => 99, // status Ditolak
            ];

        $this->psb->update_data('id_santri', $id_santri, 'psb_data_santri', $dataSantri);
        $this->psb->hapusAntrian_tahap2($id_santri);
        $this->session->set_flashdata('pesan', $getData['nama_lengkap'] . ' Telah Ditolak Sebagai Santri Bayl-Alhikmah. :(');
        redirect('santri/resume_nilai/' . $id_santri);
    }

    public function batal_diterima($id_santri)
    {
        $getData = $this->psb->getId_data($id_santri, 'psb_data_santri', 'id_santri');
        $dataSantri =
            [
                'status_santri'         => 2, // status Dikembalikan untuk Mengisi
            ];

        $this->psb->update_data('id_santri', $id_santri, 'psb_data_santri', $dataSantri);
        $this->session->set_flashdata('pesan', $getData['nama_lengkap'] . ' Telah Dibatalkan Sebagai Santri Bayl-Alhikmah Atau Diulang Registrasinya. :(');
        redirect('santri/resume_nilai/' . $id_santri);
    }

    public function lanjut_tahap2($id_santri)
    {
        $getData = $this->psb->getId_data($id_santri, 'psb_data_santri', 'id_santri');
        $dataSantri =
            [
                'status_antrian_santri'         => 7, // status Lanjut Ke Tahap 2
            ];

        $this->psb->update_dataTahap2($id_santri, $dataSantri);
        $this->session->set_flashdata('pesan', $getData['nama_lengkap'] . ' Telah Berhasil Melanjutkan ke Tahap Selanjutnya. :)');
        redirect('santri/resume_nilai/' . $id_santri);
    }

    public function santri_diterima()
    {
        is_login(array('2', '3'));
        $data['title'] = 'Data Calon Santri Diterima';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        // $data['DataSantri_Finish'] = $this->psb->dataSantri_diterima_ditolak();
        $data['AllTapel'] = $this->psb->show_data('psb_tahun_pelajaran');

        $this->load->view('template/manage_header', $data);
        $this->load->view('template/manage_navbar', $data);
        $this->load->view('santri/santri_diterima', $data);
        $this->load->view('template/manage_footer', $data);
    }

    public function load_SantriFinish()
    {
        $tapel_inden_id = $this->input->post('tapel_santri_finish');

        $calonSantri = $this->psb->dataSantriDiterima($tapel_inden_id);

        // Tampilkan data dalam bentuk tabel di dalam card
        $output = '<div class="col-md-12"><div class="card mb-2"><div class="card-header bg-primary">';
        $output .= '<h6 class="m-0 font-weight-bold text-white">Data Calon Santri</h6></div>';
        $output .= '<div class="card-body">';
        $output .= '<div class="table-responsive"><table id="table_SantriDiterima" class="table table-bordered table-striped" width="100%" cellspacing="0">';
        $output .= '<thead style="background-color: teal;" class="text-white text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Santri</th>
                            <th>Alamat</th>
                            <th>Nama Orang Tua</th>
                            <th>Asal Sekolah</th>
                            <th>Tahun Pelajaran Inden</th>
                            <th>Jenjang</th>
                            <th>Program</th>
                            <th>Aksi</th>
                        </tr>
                    </thead><tbody>';

        $no = 1;
        foreach ($calonSantri as $santri) {
            $output .= '<tr>';
            $output .= '<td class="text-center">' . $no++ . '</td>';
            $output .= '<td>' . $santri['nama_lengkap'] . '</td>';
            $output .= '<td class="text-center">' . $santri['alamat'] . ' Kelurahan ' . $santri['nama_kelurahan'] . ' Kecamatan ' . $santri['nama_kecamatan'] . ' ' . $santri['nama_kota_kab'] . ' ' . $santri['nama_provinsi'] . '</td>';
            $output .= '<td class="text-center">' . 'Bpk. ' . $santri['nama_ayah'] . ' | Ibu ' . $santri['nama_ibu'] . '</td>';
            $output .= '<td class="text-center">' . $santri['asal_sekolah'] . '</td>';
            if ($santri['tapel_inden_id'] != 0) {
                $output .= '<td class="text-center">' . $santri['ket_tapel'] . '</td>';
            } else {
                $output .= '<td class="text-center"><span class="badge badge-danger">Data Belum Ada</span></td>';
            }
            if ($santri['daftar_tingkat_id'] != 0) {
                $output .= '<td class="text-center">' . $santri['nama_tingkat'] . '</td>';
            } else {
                $output .= '<td class="text-center"><span class="badge badge-danger">Data Belum Ada</span></td>';
            }
            if ($santri['program_jenjang_id'] != 0) {
                $output .= '<td class="text-center">' . $santri['nama_program'] . '</td>';
            } else {
                $output .= '<td class="text-center"><span class="badge badge-danger">Data Belum Ada</span></td>';
            }
            $output .= '<td><a href="' . base_url("santri/cetak_biodata/" . $santri['id_santri']) . '" class="badge badge-success" target="_blank"><i class="fas fa-eye"></i> Biodata</a> || <a href="' . base_url("santri/resume_nilai/" . $santri['id_santri']) . '" class="badge badge-info" target="_blank"><i class="far fa-list-alt"></i> Resume Nilai</a></td>';
            $output .= '</tr>';
        }

        $output .= '</tbody></table></div></div></div></div>';

        echo $output;
    }

    public function santri_diterima_pertingkat()
    {
        is_login(array('2', '3'));
        $data['title'] = 'Data Calon Santri Diterima';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        // $data['DataSantri_Finish'] = $this->psb->dataSantri_diterima_ditolak();
        $data['AllTapel'] = $this->psb->show_data('psb_tahun_pelajaran');

        $this->load->view('template/manage_header', $data);
        $this->load->view('template/manage_navbar', $data);
        $this->load->view('santri/santri_diterima_sekolah', $data);
        $this->load->view('template/manage_footer', $data);
    }

    public function load_SantriFinish_pertingkat()
    {
        $tapel_inden_id = $this->input->post('tapel_finish_persekolah');
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $daftar_tingkat_id = $data['panitia']['unit_tugas_id'];
        $calonSantri = $this->psb->dataSantriDiterimaPertingkat($tapel_inden_id, $daftar_tingkat_id);

        // Tampilkan data dalam bentuk tabel di dalam card
        $output = '<div class="col-md-12"><div class="card mb-2"><div class="card-header bg-primary">';
        $output .= '<h6 class="m-0 font-weight-bold text-white">Data Calon Santri</h6></div>';
        $output .= '<div class="card-body">';
        $output .= '<div class="table-responsive"><table id="table_SantriDiterima_pertingkat" class="table table-bordered table-striped" width="100%" cellspacing="0">';
        $output .= '<thead style="background-color: teal;" class="text-white text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Santri</th>
                            <th>Alamat</th>
                            <th>Nama Orang Tua</th>
                            <th>Asal Sekolah</th>
                            <th>Tahun Pelajaran Inden</th>
                            <th>Jenjang</th>
                            <th>Program</th>
                            <th>Aksi</th>
                        </tr>
                    </thead><tbody>';

        $no = 1;
        foreach ($calonSantri as $santri) {
            $output .= '<tr>';
            $output .= '<td class="text-center">' . $no++ . '</td>';
            $output .= '<td>' . $santri['nama_lengkap'] . '</td>';
            $output .= '<td class="text-center">' . $santri['alamat'] . ' Kelurahan ' . $santri['nama_kelurahan'] . ' Kecamatan ' . $santri['nama_kecamatan'] . ' ' . $santri['nama_kota_kab'] . ' ' . $santri['nama_provinsi'] . '</td>';
            $output .= '<td class="text-center">' . 'Bpk. ' . $santri['nama_ayah'] . ' | Ibu ' . $santri['nama_ibu'] . '</td>';
            $output .= '<td class="text-center">' . $santri['asal_sekolah'] . '</td>';
            if ($santri['tapel_inden_id'] != 0) {
                $output .= '<td class="text-center">' . $santri['ket_tapel'] . '</td>';
            } else {
                $output .= '<td class="text-center"><span class="badge badge-danger">Data Belum Ada</span></td>';
            }
            if ($santri['daftar_tingkat_id'] != 0) {
                $output .= '<td class="text-center">' . $santri['nama_tingkat'] . '</td>';
            } else {
                $output .= '<td class="text-center"><span class="badge badge-danger">Data Belum Ada</span></td>';
            }
            if ($santri['program_jenjang_id'] != 0) {
                $output .= '<td class="text-center">' . $santri['nama_program'] . '</td>';
            } else {
                $output .= '<td class="text-center"><span class="badge badge-danger">Data Belum Ada</span></td>';
            }
            $output .= '<td><a href="' . base_url("santri/cetak_biodata/" . $santri['id_santri']) . '" class="badge badge-success" target="_blank"><i class="fas fa-eye"></i> Biodata</a> || <a href="' . base_url("santri/resume_nilai/" . $santri['id_santri']) . '" class="badge badge-info" target="_blank"><i class="far fa-list-alt"></i> Resume Nilai</a></td>';
            $output .= '</tr>';
        }

        $output .= '</tbody></table></div></div></div></div>';

        echo $output;
    }
}
