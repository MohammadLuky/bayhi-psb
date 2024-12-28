<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Psb_model', 'psb');
        is_login(array('1', '2', '3', '4', '5', '6', '7', '8'));
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $StatusSantri_DB = [2, 3];

        if ($this->session->userdata('role_id') != 5) {
            $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
            $data['TotalAllIndenSMP'] = $this->psb->JumlahAllIndenTingkat($StatusSantri_DB, 1);
            $data['TotalAllIndenSMA'] = $this->psb->JumlahAllIndenTingkat($StatusSantri_DB, 2);
            $data['TotalAllIndenSMK'] = $this->psb->JumlahAllIndenTingkat($StatusSantri_DB, 3);
            $data['TotalAllInden'] = $this->psb->JumlahAllInden($StatusSantri_DB);

            $data['JumlahCasanPerTingkat'] = $this->psb->JumlahAllIndenTingkat($StatusSantri_DB, $data['panitia']['unit_tugas_id']);
        } else {
            $data['walsan'] = $this->psb->user_login($this->session->userdata('username'));
            $data['santri_bayar'] = $this->psb->getId_data($data['walsan']['id_santri'], 'psb_pembayaran', 'santri_pembayaran_id');
        }
        $this->load->view('template/manage_header', $data);
        $this->load->view('template/manage_navbar', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('template/manage_footer', $data);
    }

    public function JumlahAllInden()
    {
        $data['title'] = 'Dashboard';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $AllTapel = $this->psb->show_data('psb_tahun_pelajaran');
        $AllTingkat = $this->psb->show_data('psb_tingkat_sekolah');
        // var_dump($AllTingkat);
        // die;
        $AllProgram = $this->psb->show_data('psb_program_jenjang');
        $StatusSantri_DB = [2, 3];

        $hasil_perhitungan = [];
        foreach ($AllTingkat as $tingkat_jenjang) {
            foreach ($AllTapel as $tahun) {
                $jumlah_santri = $this->psb->jumlahCasanPerTingkat($tingkat_jenjang['id_tingkat_sekolah'], $StatusSantri_DB, $tahun['id_tapel']);

                $hasil_perhitungan[] = [
                    'tingkat' => $tingkat_jenjang['nama_tingkat'],
                    'tahun_pelajaran' => $tahun['ket_tapel'],
                    'jumlah' => $jumlah_santri
                ];
            }
        }
        $data['hasil_perhitungan'] = $hasil_perhitungan;

        $this->load->view('template/manage_header', $data);
        $this->load->view('template/manage_navbar', $data);
        $this->load->view('dashboard/total_all', $data);
        $this->load->view('template/manage_footer', $data);
    }

    public function JumlahIndenPerTingkat($id_tingkat_sekolah)
    {
        $data['title'] = 'Dashboard';
        $data['panitia'] = $this->psb->user_login($this->session->userdata('username'));
        $AllTapel = $this->psb->show_data('psb_tahun_pelajaran');
        $AllTingkat = $this->psb->show_data('psb_tingkat_sekolah');
        $AllProgram = $this->psb->show_data('psb_program_jenjang');
        $StatusSantri_DB = [2, 3];

        $hasil_perhitungan = [];
        foreach ($AllTapel as $tahun) {
            $jumlah_santri = $this->psb->jumlahCasanPerTingkat($id_tingkat_sekolah, $StatusSantri_DB, $tahun['id_tapel']);

            $hasil_perhitungan[] = [
                'tingkat_id' => $id_tingkat_sekolah,
                'tahun_pelajaran' => $tahun['ket_tapel'],
                'jumlah' => $jumlah_santri
            ];
        }
        $data['hasil_perhitungan'] = $hasil_perhitungan;
        $data['getIDtingkat'] = $id_tingkat_sekolah;
        $data['Alltingkat'] = $AllTingkat;

        $this->load->view('template/manage_header', $data);
        $this->load->view('template/manage_navbar', $data);
        $this->load->view('dashboard/total_perTingkat', $data);
        $this->load->view('template/manage_footer', $data);
    }
}
