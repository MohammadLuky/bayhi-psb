<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Psb_model extends CI_Model
{
    public function insert_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function insert_data_batch($data, $table)
    {
        $this->db->insert_batch($table, $data);
    }

    public function show_data($table)
    {
        return $this->db->get($table)->result_array();
    }

    public function delete_data($table, $id_field, $id_data)
    {
        $this->db->where($id_field, $id_data);
        $this->db->delete($table);
    }

    public function getId_data($id, $table, $id_table)
    {
        return $this->db->get_where($table, [$id_table => $id])->row_array();
    }

    public function update_data($field_id_tb, $id_in_input, $table, $data)
    {
        $this->db->where($field_id_tb, $id_in_input);
        $this->db->update($table, $data);
    }

    public function checkIfExists($id_tabel, $field_id, $tabel)
    {
        $this->db->where($field_id, $id_tabel);
        $query = $this->db->get($tabel);
        return $query->num_rows() > 0;
    }

    public function join2_tables($tb_utama, $tb_tujuan, $id_tb_tujuan, $field_id_join)
    {
        return $this->db->from($tb_utama)
            ->join($tb_tujuan, $tb_tujuan . '.' . $id_tb_tujuan . '=' . $field_id_join, 'left')
            // ->order_by($id_tb_tujuan, 'asc')
            ->get()
            ->result_array();
    }

    public function count_rows($tabel)
    {
        $query = $this->db->get($tabel);
        return $query->num_rows();
    }

    public function getdata_byID($table, $get_field_id, $id)
    {
        $this->db->where($get_field_id, $id);
        return $this->db->get($table)->result_array();
    }

    public function count_by_category($field_category, $tabel, $category)
    {
        $this->db->where($field_category, $category);
        return $this->db->count_all_results($tabel);
    }

    public function getnext_data($tabel, $id_currentData, $field_id)
    {
        $this->db->where($field_id . '>', $id_currentData);
        $this->db->order_by($field_id, 'ASC');
        $this->db->limit(1);
        return $this->db->get($tabel)->row_array();
    }

    public function getdata_teratas($tabel, $nama_kolom)
    {
        $this->db->order_by($nama_kolom, 'ASC');
        $this->db->limit(1);
        return $this->db->get($tabel)->row_array();
    }

    public function generate_id($length = 12)
    {
        // $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $characters = '0123456789'; // Hanya angka
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function nomor_antrian()
    {
        $this->db->select_max('no_urut_antrian');
        $query = $this->db->get('psb_antrian_jadwal');
        $result = $query->row();

        return isset($result->no_urut_antrian) ? $result->no_urut_antrian + 1 : 1;
    }

    public function getsession_auth($username)
    {
        return $this->db->from('psb_akun')
            ->join('psb_data_pegawai', 'psb_data_pegawai.id_pegawai_psb=pegawai_psb_id', 'left')
            ->join('psb_data_santri', 'psb_data_santri.id_santri=santri_id', 'left')
            ->where(['username' => $username])
            ->get()
            ->row_array();
    }

    public function JumlahAllInden($status)
    {
        $this->db->where_in('status_santri', $status);
        return $this->db->count_all_results('psb_data_santri');
    }

    public function JumlahAllIndenTingkat($status, $tingkat)
    {
        $this->db->where('daftar_tingkat_id', $tingkat);
        $this->db->where_in('status_santri', $status);
        return $this->db->count_all_results('psb_data_santri');
    }

    public function jumlahCasanPerTingkat($tingkat, $status, $tahun_pelajaran)
    {
        $this->db->from('psb_data_santri');
        $this->db->where('daftar_tingkat_id', $tingkat);
        $this->db->where_in('status_santri', $status);
        $this->db->where('tapel_inden_id', $tahun_pelajaran);

        return $this->db->count_all_results();
    }

    public function jumlahCasanCowok_diterima($id_jadwal_tes, $tapel_id, $id_program)
    {
        $this->db->from('psb_antrian_jadwal');
        $this->db->join('psb_data_santri', 'psb_data_santri.id_santri=santri_antrian_id', 'left');
        $this->db->join('psb_akun', 'psb_akun.santri_id=psb_data_santri.id_santri', 'left');
        $this->db->join('psb_jenis_kelamin', 'psb_jenis_kelamin.id_jenis_kelamin=psb_data_santri.jenis_kelamin_id', 'left');
        $this->db->join('psb_tahun_pelajaran', 'psb_tahun_pelajaran.id_tapel=psb_data_santri.tapel_inden_id', 'left');
        $this->db->join('psb_tingkat_sekolah', 'psb_tingkat_sekolah.id_tingkat_sekolah=psb_data_santri.daftar_tingkat_id', 'left');
        $this->db->join('psb_program_jenjang', 'psb_program_jenjang.id_program_jenjang=psb_data_santri.program_jenjang_id', 'left');
        $this->db->select('psb_data_santri.id_santri, psb_data_santri.nama_lengkap, psb_data_santri.status_santri, psb_data_santri.tapel_inden_id, psb_data_santri.program_jenjang_id, psb_tahun_pelajaran.ket_tapel, psb_program_jenjang.nama_program, psb_tingkat_sekolah.nama_tingkat, psb_data_santri.kirim_data_santri, psb_data_santri.jenis_kelamin_id');
        $this->db->where('jadwal_tes_id', $id_jadwal_tes);
        $this->db->where('tapel_antrian_id', $tapel_id);
        $this->db->where('psb_data_santri.program_jenjang_id', $id_program);
        $this->db->where('psb_data_santri.jenis_kelamin_id', 1);
        $this->db->where('psb_data_santri.kirim_data_santri', 1);
        $this->db->where_in('psb_data_santri.status_santri', [1, 3]);

        return $this->db->count_all_results();
    }

    public function jumlahCasanCewek_diterima($id_jadwal_tes, $tapel_id, $id_program)
    {
        $this->db->from('psb_antrian_jadwal');
        $this->db->join('psb_data_santri', 'psb_data_santri.id_santri=santri_antrian_id', 'left');
        $this->db->join('psb_akun', 'psb_akun.santri_id=psb_data_santri.id_santri', 'left');
        $this->db->join('psb_jenis_kelamin', 'psb_jenis_kelamin.id_jenis_kelamin=psb_data_santri.jenis_kelamin_id', 'left');
        $this->db->join('psb_tahun_pelajaran', 'psb_tahun_pelajaran.id_tapel=psb_data_santri.tapel_inden_id', 'left');
        $this->db->join('psb_tingkat_sekolah', 'psb_tingkat_sekolah.id_tingkat_sekolah=psb_data_santri.daftar_tingkat_id', 'left');
        $this->db->join('psb_program_jenjang', 'psb_program_jenjang.id_program_jenjang=psb_data_santri.program_jenjang_id', 'left');
        $this->db->select('psb_data_santri.id_santri, psb_data_santri.nama_lengkap, psb_data_santri.status_santri, psb_data_santri.tapel_inden_id, psb_data_santri.program_jenjang_id, psb_tahun_pelajaran.ket_tapel, psb_program_jenjang.nama_program, psb_tingkat_sekolah.nama_tingkat, psb_data_santri.kirim_data_santri, psb_data_santri.jenis_kelamin_id');
        $this->db->where('jadwal_tes_id', $id_jadwal_tes);
        $this->db->where('tapel_antrian_id', $tapel_id);
        $this->db->where('psb_data_santri.program_jenjang_id', $id_program);
        $this->db->where('psb_data_santri.jenis_kelamin_id', 2);
        $this->db->where('psb_data_santri.kirim_data_santri', 1);
        $this->db->where_in('psb_data_santri.status_santri', [1, 3]);

        return $this->db->count_all_results();
    }

    public function jumlahCasanPerJadwal($id_jadwal_tes, $tapel_id)
    {
        $this->db->from('psb_antrian_jadwal');
        $this->db->join('psb_data_santri', 'psb_data_santri.id_santri=santri_antrian_id', 'left');
        $this->db->join('psb_akun', 'psb_akun.santri_id=psb_data_santri.id_santri', 'left');
        $this->db->join('psb_jenis_kelamin', 'psb_jenis_kelamin.id_jenis_kelamin=psb_data_santri.jenis_kelamin_id', 'left');
        $this->db->join('psb_tahun_pelajaran', 'psb_tahun_pelajaran.id_tapel=psb_data_santri.tapel_inden_id', 'left');
        $this->db->join('psb_tingkat_sekolah', 'psb_tingkat_sekolah.id_tingkat_sekolah=psb_data_santri.daftar_tingkat_id', 'left');
        $this->db->join('psb_program_jenjang', 'psb_program_jenjang.id_program_jenjang=psb_data_santri.program_jenjang_id', 'left');
        $this->db->select('psb_data_santri.id_santri, psb_data_santri.nama_lengkap, psb_data_santri.status_santri, psb_data_santri.tapel_inden_id, psb_data_santri.program_jenjang_id, psb_tahun_pelajaran.ket_tapel, psb_program_jenjang.nama_program, psb_tingkat_sekolah.nama_tingkat, psb_data_santri.kirim_data_santri, psb_data_santri.jenis_kelamin_id');
        $this->db->where('jadwal_tes_id', $id_jadwal_tes);
        $this->db->where('tapel_antrian_id', $tapel_id);
        // $this->db->where('psb_data_santri.program_jenjang_id', $id_program);
        $this->db->where('psb_data_santri.kirim_data_santri', 1);
        // $this->db->where('psb_data_santri.status_santri', 1);

        return $this->db->count_all_results();
    }

    public function jumlahCasanAll_diterima($id_jadwal_tes, $tapel_id, $id_program)
    {
        $this->db->from('psb_antrian_jadwal');
        $this->db->join('psb_data_santri', 'psb_data_santri.id_santri=santri_antrian_id', 'left');
        $this->db->join('psb_akun', 'psb_akun.santri_id=psb_data_santri.id_santri', 'left');
        $this->db->join('psb_jenis_kelamin', 'psb_jenis_kelamin.id_jenis_kelamin=psb_data_santri.jenis_kelamin_id', 'left');
        $this->db->join('psb_tahun_pelajaran', 'psb_tahun_pelajaran.id_tapel=psb_data_santri.tapel_inden_id', 'left');
        $this->db->join('psb_tingkat_sekolah', 'psb_tingkat_sekolah.id_tingkat_sekolah=psb_data_santri.daftar_tingkat_id', 'left');
        $this->db->join('psb_program_jenjang', 'psb_program_jenjang.id_program_jenjang=psb_data_santri.program_jenjang_id', 'left');
        $this->db->select('psb_data_santri.id_santri, psb_data_santri.nama_lengkap, psb_data_santri.status_santri, psb_data_santri.tapel_inden_id, psb_data_santri.program_jenjang_id, psb_tahun_pelajaran.ket_tapel, psb_program_jenjang.nama_program, psb_tingkat_sekolah.nama_tingkat, psb_data_santri.kirim_data_santri, psb_data_santri.jenis_kelamin_id');
        $this->db->where('jadwal_tes_id', $id_jadwal_tes);
        $this->db->where('tapel_antrian_id', $tapel_id);
        $this->db->where('psb_data_santri.program_jenjang_id', $id_program);
        $this->db->where('psb_data_santri.kirim_data_santri', 1);
        $this->db->where('psb_data_santri.status_santri', 1);

        return $this->db->count_all_results();
    }

    public function jumlahCasanAll_pending($id_jadwal_tes, $tapel_id, $id_program)
    {
        $this->db->from('psb_antrian_jadwal');
        $this->db->join('psb_data_santri', 'psb_data_santri.id_santri=santri_antrian_id', 'left');
        $this->db->join('psb_akun', 'psb_akun.santri_id=psb_data_santri.id_santri', 'left');
        $this->db->join('psb_jenis_kelamin', 'psb_jenis_kelamin.id_jenis_kelamin=psb_data_santri.jenis_kelamin_id', 'left');
        $this->db->join('psb_tahun_pelajaran', 'psb_tahun_pelajaran.id_tapel=psb_data_santri.tapel_inden_id', 'left');
        $this->db->join('psb_tingkat_sekolah', 'psb_tingkat_sekolah.id_tingkat_sekolah=psb_data_santri.daftar_tingkat_id', 'left');
        $this->db->join('psb_program_jenjang', 'psb_program_jenjang.id_program_jenjang=psb_data_santri.program_jenjang_id', 'left');
        $this->db->select('psb_data_santri.id_santri, psb_data_santri.nama_lengkap, psb_data_santri.status_santri, psb_data_santri.tapel_inden_id, psb_data_santri.program_jenjang_id, psb_tahun_pelajaran.ket_tapel, psb_program_jenjang.nama_program, psb_tingkat_sekolah.nama_tingkat, psb_data_santri.kirim_data_santri, psb_data_santri.jenis_kelamin_id');
        $this->db->where('jadwal_tes_id', $id_jadwal_tes);
        $this->db->where('tapel_antrian_id', $tapel_id);
        $this->db->where('psb_data_santri.program_jenjang_id', $id_program);
        $this->db->where('psb_data_santri.kirim_data_santri', 1);
        $this->db->where('psb_data_santri.status_santri', 3);

        return $this->db->count_all_results();
    }

    public function jumlahCasanAll_ditolak($id_jadwal_tes, $tapel_id, $id_program)
    {
        $this->db->from('psb_antrian_jadwal');
        $this->db->join('psb_data_santri', 'psb_data_santri.id_santri=santri_antrian_id', 'left');
        $this->db->join('psb_akun', 'psb_akun.santri_id=psb_data_santri.id_santri', 'left');
        $this->db->join('psb_jenis_kelamin', 'psb_jenis_kelamin.id_jenis_kelamin=psb_data_santri.jenis_kelamin_id', 'left');
        $this->db->join('psb_tahun_pelajaran', 'psb_tahun_pelajaran.id_tapel=psb_data_santri.tapel_inden_id', 'left');
        $this->db->join('psb_tingkat_sekolah', 'psb_tingkat_sekolah.id_tingkat_sekolah=psb_data_santri.daftar_tingkat_id', 'left');
        $this->db->join('psb_program_jenjang', 'psb_program_jenjang.id_program_jenjang=psb_data_santri.program_jenjang_id', 'left');
        $this->db->select('psb_data_santri.id_santri, psb_data_santri.nama_lengkap, psb_data_santri.status_santri, psb_data_santri.tapel_inden_id, psb_data_santri.program_jenjang_id, psb_tahun_pelajaran.ket_tapel, psb_program_jenjang.nama_program, psb_tingkat_sekolah.nama_tingkat, psb_data_santri.kirim_data_santri, psb_data_santri.jenis_kelamin_id');
        $this->db->where('jadwal_tes_id', $id_jadwal_tes);
        $this->db->where('tapel_antrian_id', $tapel_id);
        $this->db->where('psb_data_santri.program_jenjang_id', $id_program);
        $this->db->where('psb_data_santri.kirim_data_santri', 1);
        $this->db->where('psb_data_santri.status_santri', 99);

        return $this->db->count_all_results();
    }

    public function hapusAntrian_tahap2($id_santri)
    {
        $this->db->where('santri_antrian_id', $id_santri);
        $this->db->where('antrian_tahap_id', 2);
        $this->db->delete('psb_antrian_jadwal');
    }

    public function Data_Tapel()
    {
        return $this->db->from('psb_tahun_pelajaran')
            ->where('status_tapel', 1)
            ->get()
            ->result_array();
    }

    public function user_login($username)
    {
        return $this->db->from('psb_akun')
            ->join('psb_data_santri', 'psb_data_santri.id_santri=santri_id', 'left')
            ->join('psb_data_pegawai', 'psb_data_pegawai.id_pegawai_psb=pegawai_psb_id', 'left')
            ->join('psb_tingkat_sekolah', 'psb_tingkat_sekolah.id_tingkat_sekolah=psb_data_pegawai.unit_tugas_id', 'left')
            ->where(['username' => $username])
            ->get()
            ->row_array();
    }

    public function data_tingkat_program()
    {
        return $this->db->from('psb_data_tingkat_program')
            ->join('psb_tingkat_sekolah', 'psb_tingkat_sekolah.id_tingkat_sekolah=data_tingkat_id', 'left')
            ->join('psb_program_jenjang', 'psb_program_jenjang.id_program_jenjang=data_pogram_id', 'left')
            ->get()
            ->result_array();
    }

    public function data_tingkat_byprogram($data_program_id)
    {
        return $this->db->from('psb_data_tingkat_program')
            ->join('psb_tingkat_sekolah', 'psb_tingkat_sekolah.id_tingkat_sekolah=data_tingkat_id', 'left')
            ->join('psb_program_jenjang', 'psb_program_jenjang.id_program_jenjang=data_pogram_id', 'left')
            ->where('data_pogram_id', $data_program_id)
            ->get()
            ->result_array();
    }

    public function wawancara_byItem()
    {
        return $this->db->from('psb_item_jenis_wawancara')
            ->join('psb_jenis_wawancara', 'psb_jenis_wawancara.id_jenis_wawancara=data_jenis_wawancara_id', 'left')
            ->join('psb_item_wawancara', 'psb_item_wawancara.id_item_wawancara=data_item_wawancara_id', 'left')
            // ->where('data_pogram_id', $data_program_id)
            ->get()
            ->result_array();
    }

    public function getwawancaraPembiayaan_ortu()
    {

        return $this->db->from('psb_item_jenis_wawancara')
            ->join('psb_jenis_wawancara', 'psb_jenis_wawancara.id_jenis_wawancara=data_jenis_wawancara_id', 'left')
            ->join('psb_item_wawancara', 'psb_item_wawancara.id_item_wawancara=data_item_wawancara_id', 'left')
            ->where('id_item_jenis_wawancara', 11)
            ->get()
            ->result_array();
    }

    public function sync_wawancara_santriortu()
    {
        return $this->db->from('psb_hasil_wawancara')
            ->join('psb_data_santri', 'psb_data_santri.id_santri=wawancara_santri_id', 'left')
            ->join('psb_data_pegawai', 'psb_data_pegawai.id_pegawai_psb=pegawai_wawancara_id', 'left')
            ->join('psb_jadwal_tes', 'psb_jadwal_tes.id_jadwal_tes=jadwal_wawancara_id', 'left')
            ->join('psb_tahun_pelajaran', 'psb_tahun_pelajaran.id_tapel=psb_jadwal_tes.tapel_jadwal_id', 'left')
            ->join('psb_tahap', 'psb_tahap.id_tahap=psb_jadwal_tes.tahap_id', 'left')
            ->join('psb_item_jenis_wawancara', 'psb_item_jenis_wawancara.id_item_jenis_wawancara=item_jenis_wawancara_id', 'left')
            ->join('psb_jenis_wawancara', 'psb_jenis_wawancara.id_jenis_wawancara=psb_item_jenis_wawancara.data_jenis_wawancara_id', 'left')
            ->join('psb_item_wawancara', 'psb_item_wawancara.id_item_wawancara=psb_item_jenis_wawancara.data_item_wawancara_id', 'left')
            ->select('psb_data_santri.id_santri, psb_data_santri.nama_lengkap, psb_jenis_wawancara.jenis_wawancara, psb_item_wawancara.item_wawancara, psb_jadwal_tes.nama_jadwal, psb_tahap.nama_tahap, psb_tahun_pelajaran.ket_tapel, psb_hasil_wawancara.deskripsi_wawancara, psb_data_pegawai.nama_lengkap_pegawai')
            ->order_by('psb_data_santri.id_santri, psb_jenis_wawancara.jenis_wawancara')
            ->get()
            ->result_array();
    }

    public function syncApi_wawancara_santriortu()
    {
        return $this->db->from('psb_hasil_wawancara_api')
            ->join('psb_data_santri', 'psb_data_santri.id_santri=wawancara_api_santri_id', 'left')
            ->join('psb_jadwal_tes', 'psb_jadwal_tes.id_jadwal_tes=wawancara_jadwal_api_id', 'left')
            ->join('psb_tahun_pelajaran', 'psb_tahun_pelajaran.id_tapel=psb_jadwal_tes.tapel_jadwal_id', 'left')
            ->join('psb_tahap', 'psb_tahap.id_tahap=psb_jadwal_tes.tahap_id', 'left')
            ->join('psb_data_pegawai as pewawancara_santri', 'pewawancara_santri.id_pegawai_psb=pegawai_wawancara_santri_id', 'left')
            ->join('psb_data_pegawai as pewawancara_ortu', 'pewawancara_ortu.id_pegawai_psb=pegawai_wawancara_ortu_id', 'left')
            ->select('psb_data_santri.id_santri, psb_data_santri.nama_lengkap, psb_jadwal_tes.nama_jadwal, psb_tahap.nama_tahap, psb_tahun_pelajaran.ket_tapel, psb_hasil_wawancara_api.*, pewawancara_santri.nama_lengkap_pegawai AS nama_pewawancara_santri, pewawancara_ortu.nama_lengkap_pegawai AS nama_pewawancara_ortu')
            ->get()
            ->result_array();
    }

    public function itembyjenis_wawancara($id_jenis_wawancara)
    {
        return $this->db->from('psb_item_jenis_wawancara')
            ->join('psb_jenis_wawancara', 'psb_jenis_wawancara.id_jenis_wawancara=data_jenis_wawancara_id', 'left')
            ->join('psb_item_wawancara', 'psb_item_wawancara.id_item_wawancara=data_item_wawancara_id', 'left')
            ->where('data_jenis_wawancara_id', $id_jenis_wawancara)
            ->get()
            ->result_array();
    }

    // public function getID_ItemJenis_wawancara()
    // {
    //     return $this->db->from('psb_item_jenis_wawancara')
    //         // ->where_in('id_item_jenis_wawancara', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]) // 2 -> id tes akademik
    //         ->where('id_item_jenis_wawancara', 3) // 2 -> id tes akademik
    //         ->get()
    //         ->row_array();
    //     // ->result_array();
    // }

    // public function getIDhasilWawancarabySantri_ItemJenis_wawancara($id_item_jenis_wawancara, $id_santri)
    // {
    //     return $this->db->from('psb_hasil_wawancara')
    //         ->where('item_jenis_wawancara_id', $id_item_jenis_wawancara)
    //         ->where('wawancara_santri_id', $id_santri)
    //         ->get()
    //         ->row_array();
    //     // ->result_array();
    // }

    // public function update_syncHasilWawancara($id_santri, $data)
    // // public function update_syncHasilWawancara($id_santri, $array_item_jenis_wawancara, $data)
    // {
    //     $this->db->where('wawancara_santri_id', $id_santri);
    //     // $this->db->where('item_jenis_wawancara_id', $array_item_jenis_wawancara);
    //     $this->db->update('psb_hasil_wawancara', $data);
    // }

    public function allpegawaipsb()
    {
        return $this->db->from('psb_data_pegawai')
            ->join('psb_akun', 'psb_akun.pegawai_psb_id=id_pegawai_psb', 'left')
            ->join('psb_role', 'psb_role.id_role=psb_akun.role_id', 'left')
            ->join('psb_tingkat_sekolah', 'psb_tingkat_sekolah.id_tingkat_sekolah=unit_tugas_id', 'left')
            ->order_by('role_id', 'ASC')
            ->get()
            ->result_array();
    }

    public function dataValidasiBayar()
    {
        return $this->db->from('psb_pembayaran')
            ->join('psb_data_santri', 'psb_data_santri.id_santri=santri_pembayaran_id', 'left')
            ->join('psb_jenis_pembayaran', 'psb_jenis_pembayaran.id_jenis_pembayaran=jepem_id', 'left')
            ->join('psb_master_kelurahan', 'psb_master_kelurahan.id_kel=psb_data_santri.desa_kelurahan_id', 'left')
            ->join('psb_master_kecamatan', 'psb_master_kecamatan.id_kec=psb_master_kelurahan.kec_id', 'left')
            ->join('psb_master_kotakab', 'psb_master_kotakab.id_kota_kab=psb_master_kecamatan.kota_kab_id', 'left')
            ->join('psb_master_provinsi', 'psb_master_provinsi.id_provinsi=psb_master_kotakab.prov_id', 'left')
            ->where('status_pembayaran', 2)
            ->get()
            ->result_array();
    }

    public function DataPembayaran()
    {
        return $this->db->from('psb_jenis_pembayaran')
            ->join('psb_program_jenjang', 'psb_program_jenjang.id_program_jenjang=program_pembayaran_id', 'left')
            ->join('psb_tingkat_sekolah', 'psb_tingkat_sekolah.id_tingkat_sekolah=jenjang_pembayaran_id', 'left')
            ->join('psb_tahun_pelajaran', 'psb_tahun_pelajaran.id_tapel=tapel_pembayaran_id', 'left')
            ->get()
            ->result_array();
    }

    // public function pembayaranPSB_perSantri($id_santri, $program, $jenjang, $tapel)
    public function pembayaranPSB_perSantri($id_santri, $id_jenis_pembayaran)
    {
        return $this->db->from('psb_pembayaran')
            ->join('psb_jenis_pembayaran', 'psb_jenis_pembayaran.id_jenis_pembayaran=jepem_id', 'left')
            ->join('psb_program_jenjang', 'psb_program_jenjang.id_program_jenjang=psb_jenis_pembayaran.program_pembayaran_id', 'left')
            ->join('psb_tingkat_sekolah', 'psb_tingkat_sekolah.id_tingkat_sekolah=psb_jenis_pembayaran.jenjang_pembayaran_id', 'left')
            ->join('psb_tahun_pelajaran', 'psb_tahun_pelajaran.id_tapel=psb_jenis_pembayaran.tapel_pembayaran_id', 'left')
            ->where('santri_pembayaran_id', $id_santri)
            ->where('jepem_id', $id_jenis_pembayaran)
            // ->where('program_pembayaran_id', $program)
            // ->where('jenjang_pembayaran_id', $jenjang)
            // ->where('tapel_pembayaran_id', $tapel)
            ->get()
            ->row_array();
    }

    public function getIDjepem_byRegis($program, $jenjang, $tapel)
    {
        return $this->db->from('psb_jenis_pembayaran')
            ->join('psb_program_jenjang', 'psb_program_jenjang.id_program_jenjang=program_pembayaran_id', 'left')
            ->join('psb_tingkat_sekolah', 'psb_tingkat_sekolah.id_tingkat_sekolah=jenjang_pembayaran_id', 'left')
            ->join('psb_tahun_pelajaran', 'psb_tahun_pelajaran.id_tapel=tapel_pembayaran_id', 'left')
            ->where('program_pembayaran_id', $program)
            ->where('jenjang_pembayaran_id', $jenjang)
            ->where('tapel_pembayaran_id', $tapel)
            ->get()
            ->row_array();
    }

    public function biodata_santri($id_santri)
    {
        return $this->db->from('psb_data_santri')
            ->join('psb_akun', 'psb_akun.santri_id=id_santri', 'left')
            ->join('psb_jenis_kelamin', 'psb_jenis_kelamin.id_jenis_kelamin=jenis_kelamin_id', 'left')
            ->join('psb_agama', 'psb_agama.id_agama=agama_id', 'left')
            ->join('psb_kebutuhan_khusus', 'psb_kebutuhan_khusus.id_kebutuhan_khusus=kebutuhan_khusus_id', 'left')
            ->join('psb_master_kelurahan', 'psb_master_kelurahan.id_kel=desa_kelurahan_id', 'left')
            ->join('psb_master_kecamatan', 'psb_master_kecamatan.id_kec=psb_master_kelurahan.kec_id', 'left')
            ->join('psb_master_kotakab', 'psb_master_kotakab.id_kota_kab=psb_master_kecamatan.kota_kab_id', 'left')
            ->join('psb_master_provinsi', 'psb_master_provinsi.id_provinsi=psb_master_kotakab.prov_id', 'left')
            ->join('psb_alat_transportasi', 'psb_alat_transportasi.id_transportasi=alat_transportasi_id', 'left')
            ->join('psb_pendidikan_ortu AS pend_ayah', 'pend_ayah.id_pendidikan_ortu=pendidikan_ayah_id', 'left')
            ->join('psb_pekerjaan_ortu AS kerja_ayah', 'kerja_ayah.id_pekerjaan_ortu=pekerjaan_ayah_id', 'left')
            ->join('psb_penghasilan_ortu AS hasil_ayah', 'hasil_ayah.id_penghasilan_ortu=penghasilan_ayah_id', 'left')
            ->join('psb_pendidikan_ortu AS pend_ibu', 'pend_ibu.id_pendidikan_ortu=pendidikan_ibu_id', 'left')
            ->join('psb_pekerjaan_ortu AS kerja_ibu', 'kerja_ibu.id_pekerjaan_ortu=pekerjaan_ibu_id', 'left')
            ->join('psb_penghasilan_ortu AS hasil_ibu', 'hasil_ibu.id_penghasilan_ortu=penghasilan_ibu_id', 'left')
            ->join('psb_pendidikan_ortu AS pend_wali', 'pend_wali.id_pendidikan_ortu=pendidikan_wali_id', 'left')
            ->join('psb_pekerjaan_ortu AS kerja_wali', 'kerja_wali.id_pekerjaan_ortu=pekerjaan_wali_id', 'left')
            ->join('psb_penghasilan_ortu AS hasil_wali', 'hasil_wali.id_penghasilan_ortu=penghasilan_wali_id', 'left')
            ->join('psb_tahun_pelajaran', 'psb_tahun_pelajaran.id_tapel=tapel_inden_id', 'left')
            ->join('psb_tingkat_sekolah', 'psb_tingkat_sekolah.id_tingkat_sekolah=daftar_tingkat_id', 'left')
            ->join('psb_program_jenjang', 'psb_program_jenjang.id_program_jenjang=program_jenjang_id', 'left')
            ->where('id_santri', $id_santri)
            ->select('psb_data_santri.*, psb_akun.*, psb_jenis_kelamin.*, psb_agama.*, psb_kebutuhan_khusus.*, psb_master_kelurahan.*, psb_master_kecamatan.*, psb_master_kotakab.*, psb_master_provinsi.*, psb_alat_transportasi.*, pend_ayah.nama_pendidikan_ortu AS pendidikan_ayah, kerja_ayah.jenis_pekerjaan AS pekerjaan_ayah, hasil_ayah.range_penghasilan AS penghasilan_ayah, pend_ibu.nama_pendidikan_ortu AS pendidikan_ibu, kerja_ibu.jenis_pekerjaan AS pekerjaan_ibu, hasil_ibu.range_penghasilan AS penghasilan_ibu, pend_wali.nama_pendidikan_ortu AS pendidikan_wali, kerja_wali.jenis_pekerjaan AS pekerjaan_wali, hasil_wali.range_penghasilan AS penghasilan_wali, psb_tahun_pelajaran.*, psb_program_jenjang.*, psb_tingkat_sekolah.*')
            ->get()
            ->row_array();
    }

    public function casan_QStahap2($id_santri)
    {
        return $this->db->from('psb_antrian_jadwal')
            ->where('santri_antrian_id', $id_santri)
            ->where('antrian_tahap_id', 2)
            ->get()
            ->row_array();
    }

    public function update_dataTahap2($id_santri, $data)
    {
        $this->db->where('antrian_tahap_id', 2);
        $this->db->where('santri_antrian_id', $id_santri);
        $this->db->update('psb_antrian_jadwal', $data);
    }

    public function dataAll_santri()
    {
        return $this->db->from('psb_data_santri')
            ->join('psb_akun', 'psb_akun.santri_id=id_santri', 'left')
            ->join('psb_jenis_kelamin', 'psb_jenis_kelamin.id_jenis_kelamin=jenis_kelamin_id', 'left')
            ->join('psb_agama', 'psb_agama.id_agama=agama_id', 'left')
            ->join('psb_kebutuhan_khusus', 'psb_kebutuhan_khusus.id_kebutuhan_khusus=kebutuhan_khusus_id', 'left')
            ->join('psb_master_kelurahan', 'psb_master_kelurahan.id_kel=desa_kelurahan_id', 'left')
            ->join('psb_master_kecamatan', 'psb_master_kecamatan.id_kec=psb_master_kelurahan.kec_id', 'left')
            ->join('psb_master_kotakab', 'psb_master_kotakab.id_kota_kab=psb_master_kecamatan.kota_kab_id', 'left')
            ->join('psb_master_provinsi', 'psb_master_provinsi.id_provinsi=psb_master_kotakab.prov_id', 'left')
            ->join('psb_alat_transportasi', 'psb_alat_transportasi.id_transportasi=alat_transportasi_id', 'left')
            ->join('psb_pendidikan_ortu AS pend_ayah', 'pend_ayah.id_pendidikan_ortu=pendidikan_ayah_id', 'left')
            ->join('psb_pekerjaan_ortu AS kerja_ayah', 'kerja_ayah.id_pekerjaan_ortu=pekerjaan_ayah_id', 'left')
            ->join('psb_penghasilan_ortu AS hasil_ayah', 'hasil_ayah.id_penghasilan_ortu=penghasilan_ayah_id', 'left')
            ->join('psb_pendidikan_ortu AS pend_ibu', 'pend_ibu.id_pendidikan_ortu=pendidikan_ibu_id', 'left')
            ->join('psb_pekerjaan_ortu AS kerja_ibu', 'kerja_ibu.id_pekerjaan_ortu=pekerjaan_ibu_id', 'left')
            ->join('psb_penghasilan_ortu AS hasil_ibu', 'hasil_ibu.id_penghasilan_ortu=penghasilan_ibu_id', 'left')
            ->join('psb_pendidikan_ortu AS pend_wali', 'pend_wali.id_pendidikan_ortu=pendidikan_wali_id', 'left')
            ->join('psb_pekerjaan_ortu AS kerja_wali', 'kerja_wali.id_pekerjaan_ortu=pekerjaan_wali_id', 'left')
            ->join('psb_penghasilan_ortu AS hasil_wali', 'hasil_wali.id_penghasilan_ortu=penghasilan_wali_id', 'left')
            ->join('psb_tahun_pelajaran', 'psb_tahun_pelajaran.id_tapel=tapel_inden_id', 'left')
            ->join('psb_tingkat_sekolah', 'psb_tingkat_sekolah.id_tingkat_sekolah=daftar_tingkat_id', 'left')
            ->join('psb_program_jenjang', 'psb_program_jenjang.id_program_jenjang=program_jenjang_id', 'left')
            ->where('kirim_data_santri', 1)
            ->select('psb_data_santri.*, psb_akun.*, psb_jenis_kelamin.*, psb_agama.*, psb_kebutuhan_khusus.*, psb_master_kelurahan.*, psb_master_kecamatan.*, psb_master_kotakab.*, psb_master_provinsi.*, psb_alat_transportasi.*, pend_ayah.nama_pendidikan_ortu AS pendidikan_ayah, kerja_ayah.jenis_pekerjaan AS pekerjaan_ayah, hasil_ayah.range_penghasilan AS penghasilan_ayah, pend_ibu.nama_pendidikan_ortu AS pendidikan_ibu, kerja_ibu.jenis_pekerjaan AS pekerjaan_ibu, hasil_ibu.range_penghasilan AS penghasilan_ibu, pend_wali.nama_pendidikan_ortu AS pendidikan_wali, kerja_wali.jenis_pekerjaan AS pekerjaan_wali, hasil_wali.range_penghasilan AS penghasilan_wali, psb_tahun_pelajaran.*, psb_program_jenjang.*, psb_tingkat_sekolah.*')
            ->get()
            ->result_array();
    }

    public function DataHasilSync()
    {
        return $this->db->from('psb_data_santri')
            ->join('psb_akun', 'psb_akun.santri_id=id_santri', 'left')
            ->join('psb_jenis_kelamin', 'psb_jenis_kelamin.id_jenis_kelamin=jenis_kelamin_id', 'left')
            ->join('psb_agama', 'psb_agama.id_agama=agama_id', 'left')
            ->join('psb_kebutuhan_khusus', 'psb_kebutuhan_khusus.id_kebutuhan_khusus=kebutuhan_khusus_id', 'left')
            ->join('psb_master_kelurahan', 'psb_master_kelurahan.id_kel=desa_kelurahan_id', 'left')
            ->join('psb_master_kecamatan', 'psb_master_kecamatan.id_kec=psb_master_kelurahan.kec_id', 'left')
            ->join('psb_master_kotakab', 'psb_master_kotakab.id_kota_kab=psb_master_kecamatan.kota_kab_id', 'left')
            ->join('psb_master_provinsi', 'psb_master_provinsi.id_provinsi=psb_master_kotakab.prov_id', 'left')
            ->join('psb_tahun_pelajaran', 'psb_tahun_pelajaran.id_tapel=tapel_inden_id', 'left')
            ->join('psb_tingkat_sekolah', 'psb_tingkat_sekolah.id_tingkat_sekolah=daftar_tingkat_id', 'left')
            ->join('psb_program_jenjang', 'psb_program_jenjang.id_program_jenjang=program_jenjang_id', 'left')
            ->where_in('kirim_data_santri', [1, 0])
            // ->where_in('status_santri', [1, 2, 3, 99, 0])
            ->select('psb_data_santri.id_santri, psb_data_santri.nama_lengkap, psb_data_santri.alamat, psb_data_santri.nama_ayah, psb_data_santri.nama_ibu, psb_data_santri.asal_sekolah, psb_data_santri.status_santri, psb_data_santri.tapel_inden_id, psb_master_kelurahan.nama_kelurahan, psb_master_kecamatan.nama_kecamatan, psb_master_kotakab.nama_kota_kab, psb_master_provinsi.nama_provinsi, psb_tahun_pelajaran.ket_tapel, psb_program_jenjang.nama_program, psb_tingkat_sekolah.nama_tingkat, psb_akun.username, psb_akun.pass_tampil')
            ->order_by('tgl_inden', 'desc')
            // ->order_by('status_santri', 'desc')
            ->get()
            ->result_array();
    }

    public function DataModal_CasanSync()
    {
        return $this->db->from('psb_data_santri')
            ->join('psb_akun', 'psb_akun.santri_id=id_santri', 'left')
            ->where_in('kirim_data_santri', [1, 0])
            ->select('psb_data_santri.id_santri, psb_data_santri.tapel_inden_id, psb_akun.username, psb_akun.pass_tampil')
            ->order_by('tgl_inden', 'desc')
            ->get()
            ->result_array();
    }

    public function dataFilter_CasanSync($id_tapel)
    {
        return $this->db->from('psb_data_santri')
            ->join('psb_akun', 'psb_akun.santri_id=id_santri', 'left')
            ->join('psb_jenis_kelamin', 'psb_jenis_kelamin.id_jenis_kelamin=jenis_kelamin_id', 'left')
            ->join('psb_agama', 'psb_agama.id_agama=agama_id', 'left')
            ->join('psb_kebutuhan_khusus', 'psb_kebutuhan_khusus.id_kebutuhan_khusus=kebutuhan_khusus_id', 'left')
            ->join('psb_master_kelurahan', 'psb_master_kelurahan.id_kel=desa_kelurahan_id', 'left')
            ->join('psb_master_kecamatan', 'psb_master_kecamatan.id_kec=psb_master_kelurahan.kec_id', 'left')
            ->join('psb_master_kotakab', 'psb_master_kotakab.id_kota_kab=psb_master_kecamatan.kota_kab_id', 'left')
            ->join('psb_master_provinsi', 'psb_master_provinsi.id_provinsi=psb_master_kotakab.prov_id', 'left')
            ->join('psb_tahun_pelajaran', 'psb_tahun_pelajaran.id_tapel=tapel_inden_id', 'left')
            ->join('psb_tingkat_sekolah', 'psb_tingkat_sekolah.id_tingkat_sekolah=daftar_tingkat_id', 'left')
            ->join('psb_program_jenjang', 'psb_program_jenjang.id_program_jenjang=program_jenjang_id', 'left')
            ->select('psb_data_santri.id_santri, psb_data_santri.nama_lengkap, psb_data_santri.alamat, psb_data_santri.nama_ayah, psb_data_santri.nama_wali, psb_data_santri.nohp_ayah, psb_data_santri.nohp_ibu, psb_data_santri.nohp_wali, psb_data_santri.nama_ibu, psb_data_santri.asal_sekolah, psb_data_santri.status_santri, psb_data_santri.tapel_inden_id, psb_data_santri.daftar_tingkat_id, psb_data_santri.program_jenjang_id, psb_master_kelurahan.nama_kelurahan, psb_master_kecamatan.nama_kecamatan, psb_master_kotakab.nama_kota_kab, psb_master_provinsi.nama_provinsi, psb_tahun_pelajaran.ket_tapel, psb_program_jenjang.nama_program, psb_tingkat_sekolah.nama_tingkat, psb_akun.username, psb_akun.pass_tampil')
            ->where_in('kirim_data_santri', [1, 0])
            ->where('tapel_inden_id', $id_tapel)
            ->order_by('status_santri', 'desc')
            ->order_by('tgl_inden', 'desc')
            ->get()
            ->result_array();
    }

    public function dataSantri_diterima_ditolak()
    {
        return $this->db->from('psb_data_santri')
            ->join('psb_akun', 'psb_akun.santri_id=id_santri', 'left')
            ->join('psb_jenis_kelamin', 'psb_jenis_kelamin.id_jenis_kelamin=jenis_kelamin_id', 'left')
            ->join('psb_agama', 'psb_agama.id_agama=agama_id', 'left')
            ->join('psb_kebutuhan_khusus', 'psb_kebutuhan_khusus.id_kebutuhan_khusus=kebutuhan_khusus_id', 'left')
            ->join('psb_master_kelurahan', 'psb_master_kelurahan.id_kel=desa_kelurahan_id', 'left')
            ->join('psb_master_kecamatan', 'psb_master_kecamatan.id_kec=psb_master_kelurahan.kec_id', 'left')
            ->join('psb_master_kotakab', 'psb_master_kotakab.id_kota_kab=psb_master_kecamatan.kota_kab_id', 'left')
            ->join('psb_master_provinsi', 'psb_master_provinsi.id_provinsi=psb_master_kotakab.prov_id', 'left')
            ->join('psb_alat_transportasi', 'psb_alat_transportasi.id_transportasi=alat_transportasi_id', 'left')
            ->join('psb_pendidikan_ortu AS pend_ayah', 'pend_ayah.id_pendidikan_ortu=pendidikan_ayah_id', 'left')
            ->join('psb_pekerjaan_ortu AS kerja_ayah', 'kerja_ayah.id_pekerjaan_ortu=pekerjaan_ayah_id', 'left')
            ->join('psb_penghasilan_ortu AS hasil_ayah', 'hasil_ayah.id_penghasilan_ortu=penghasilan_ayah_id', 'left')
            ->join('psb_pendidikan_ortu AS pend_ibu', 'pend_ibu.id_pendidikan_ortu=pendidikan_ibu_id', 'left')
            ->join('psb_pekerjaan_ortu AS kerja_ibu', 'kerja_ibu.id_pekerjaan_ortu=pekerjaan_ibu_id', 'left')
            ->join('psb_penghasilan_ortu AS hasil_ibu', 'hasil_ibu.id_penghasilan_ortu=penghasilan_ibu_id', 'left')
            ->join('psb_pendidikan_ortu AS pend_wali', 'pend_wali.id_pendidikan_ortu=pendidikan_wali_id', 'left')
            ->join('psb_pekerjaan_ortu AS kerja_wali', 'kerja_wali.id_pekerjaan_ortu=pekerjaan_wali_id', 'left')
            ->join('psb_penghasilan_ortu AS hasil_wali', 'hasil_wali.id_penghasilan_ortu=penghasilan_wali_id', 'left')
            ->join('psb_tahun_pelajaran', 'psb_tahun_pelajaran.id_tapel=tapel_inden_id', 'left')
            ->join('psb_tingkat_sekolah', 'psb_tingkat_sekolah.id_tingkat_sekolah=daftar_tingkat_id', 'left')
            ->join('psb_program_jenjang', 'psb_program_jenjang.id_program_jenjang=program_jenjang_id', 'left')
            ->where('kirim_data_santri', 1)
            ->where_in('status_santri', [1, 99])
            ->select('psb_data_santri.*, psb_akun.*, psb_jenis_kelamin.*, psb_agama.*, psb_kebutuhan_khusus.*, psb_master_kelurahan.*, psb_master_kecamatan.*, psb_master_kotakab.*, psb_master_provinsi.*, psb_alat_transportasi.*, pend_ayah.nama_pendidikan_ortu AS pendidikan_ayah, kerja_ayah.jenis_pekerjaan AS pekerjaan_ayah, hasil_ayah.range_penghasilan AS penghasilan_ayah, pend_ibu.nama_pendidikan_ortu AS pendidikan_ibu, kerja_ibu.jenis_pekerjaan AS pekerjaan_ibu, hasil_ibu.range_penghasilan AS penghasilan_ibu, pend_wali.nama_pendidikan_ortu AS pendidikan_wali, kerja_wali.jenis_pekerjaan AS pekerjaan_wali, hasil_wali.range_penghasilan AS penghasilan_wali, psb_tahun_pelajaran.*, psb_program_jenjang.*, psb_tingkat_sekolah.*')
            ->get()
            ->result_array();
    }

    public function dataFilter_santri($id_tapel)
    {
        return $this->db->from('psb_data_santri')
            ->join('psb_akun', 'psb_akun.santri_id=id_santri', 'left')
            ->join('psb_jenis_kelamin', 'psb_jenis_kelamin.id_jenis_kelamin=jenis_kelamin_id', 'left')
            ->join('psb_agama', 'psb_agama.id_agama=agama_id', 'left')
            ->join('psb_kebutuhan_khusus', 'psb_kebutuhan_khusus.id_kebutuhan_khusus=kebutuhan_khusus_id', 'left')
            ->join('psb_master_kelurahan', 'psb_master_kelurahan.id_kel=desa_kelurahan_id', 'left')
            ->join('psb_master_kecamatan', 'psb_master_kecamatan.id_kec=psb_master_kelurahan.kec_id', 'left')
            ->join('psb_master_kotakab', 'psb_master_kotakab.id_kota_kab=psb_master_kecamatan.kota_kab_id', 'left')
            ->join('psb_master_provinsi', 'psb_master_provinsi.id_provinsi=psb_master_kotakab.prov_id', 'left')
            ->join('psb_tahun_pelajaran', 'psb_tahun_pelajaran.id_tapel=tapel_inden_id', 'left')
            ->join('psb_tingkat_sekolah', 'psb_tingkat_sekolah.id_tingkat_sekolah=daftar_tingkat_id', 'left')
            ->join('psb_program_jenjang', 'psb_program_jenjang.id_program_jenjang=program_jenjang_id', 'left')
            ->select('psb_data_santri.id_santri, psb_data_santri.nama_lengkap, psb_data_santri.alamat, psb_data_santri.nama_ayah, psb_data_santri.nama_ibu, psb_data_santri.asal_sekolah, psb_data_santri.status_santri, psb_data_santri.tapel_inden_id, psb_data_santri.daftar_tingkat_id, psb_data_santri.program_jenjang_id, psb_master_kelurahan.nama_kelurahan, psb_master_kecamatan.nama_kecamatan, psb_master_kotakab.nama_kota_kab, psb_master_provinsi.nama_provinsi, psb_tahun_pelajaran.ket_tapel, psb_program_jenjang.nama_program, psb_tingkat_sekolah.nama_tingkat, psb_akun.username, psb_akun.pass_tampil')
            ->where('kirim_data_santri', 1)
            ->where('status_santri', 3)
            ->where('tapel_inden_id', $id_tapel)
            ->order_by('tgl_inden', 'desc')
            ->get()
            ->result_array();
    }

    public function DataSantriPErTingkat($daftar_tingkat_id, $id_tapel)
    {
        return $this->db->from('psb_data_santri')
            ->join('psb_akun', 'psb_akun.santri_id=id_santri', 'left')
            ->join('psb_jenis_kelamin', 'psb_jenis_kelamin.id_jenis_kelamin=jenis_kelamin_id', 'left')
            ->join('psb_agama', 'psb_agama.id_agama=agama_id', 'left')
            ->join('psb_kebutuhan_khusus', 'psb_kebutuhan_khusus.id_kebutuhan_khusus=kebutuhan_khusus_id', 'left')
            ->join('psb_master_kelurahan', 'psb_master_kelurahan.id_kel=desa_kelurahan_id', 'left')
            ->join('psb_master_kecamatan', 'psb_master_kecamatan.id_kec=psb_master_kelurahan.kec_id', 'left')
            ->join('psb_master_kotakab', 'psb_master_kotakab.id_kota_kab=psb_master_kecamatan.kota_kab_id', 'left')
            ->join('psb_master_provinsi', 'psb_master_provinsi.id_provinsi=psb_master_kotakab.prov_id', 'left')
            ->join('psb_tahun_pelajaran', 'psb_tahun_pelajaran.id_tapel=tapel_inden_id', 'left')
            ->join('psb_tingkat_sekolah', 'psb_tingkat_sekolah.id_tingkat_sekolah=daftar_tingkat_id', 'left')
            ->join('psb_program_jenjang', 'psb_program_jenjang.id_program_jenjang=program_jenjang_id', 'left')
            ->where('daftar_tingkat_id', $daftar_tingkat_id)
            ->where('tapel_inden_id', $id_tapel)
            ->where('kirim_data_santri', 1)
            ->where('status_santri', 3)
            ->select('psb_data_santri.id_santri, psb_data_santri.nama_lengkap, psb_data_santri.alamat, psb_data_santri.nama_ayah, psb_data_santri.nama_ibu, psb_data_santri.asal_sekolah, psb_data_santri.status_santri, psb_data_santri.tapel_inden_id, psb_data_santri.daftar_tingkat_id, psb_data_santri.program_jenjang_id, psb_master_kelurahan.nama_kelurahan, psb_master_kecamatan.nama_kecamatan, psb_master_kotakab.nama_kota_kab, psb_master_provinsi.nama_provinsi, psb_tahun_pelajaran.ket_tapel, psb_program_jenjang.nama_program, psb_tingkat_sekolah.nama_tingkat, psb_akun.username, psb_akun.pass_tampil')
            ->order_by('tgl_inden', 'desc')
            ->get()
            ->result_array();
    }

    public function DataSantri_byJadwal($id_jadwal_tes, $tapel_id)
    {
        return $this->db->from('psb_antrian_jadwal')
            ->join('psb_data_santri', 'psb_data_santri.id_santri=santri_antrian_id', 'left')
            ->join('psb_akun', 'psb_akun.santri_id=psb_data_santri.id_santri', 'left')
            ->join('psb_jenis_kelamin', 'psb_jenis_kelamin.id_jenis_kelamin=psb_data_santri.jenis_kelamin_id', 'left')
            ->join('psb_agama', 'psb_agama.id_agama=psb_data_santri.agama_id', 'left')
            ->join('psb_kebutuhan_khusus', 'psb_kebutuhan_khusus.id_kebutuhan_khusus=psb_data_santri.kebutuhan_khusus_id', 'left')
            ->join('psb_master_kelurahan', 'psb_master_kelurahan.id_kel=psb_data_santri.desa_kelurahan_id', 'left')
            ->join('psb_master_kecamatan', 'psb_master_kecamatan.id_kec=psb_master_kelurahan.kec_id', 'left')
            ->join('psb_master_kotakab', 'psb_master_kotakab.id_kota_kab=psb_master_kecamatan.kota_kab_id', 'left')
            ->join('psb_master_provinsi', 'psb_master_provinsi.id_provinsi=psb_master_kotakab.prov_id', 'left')
            ->join('psb_tahun_pelajaran', 'psb_tahun_pelajaran.id_tapel=psb_data_santri.tapel_inden_id', 'left')
            ->join('psb_tingkat_sekolah', 'psb_tingkat_sekolah.id_tingkat_sekolah=psb_data_santri.daftar_tingkat_id', 'left')
            ->join('psb_program_jenjang', 'psb_program_jenjang.id_program_jenjang=psb_data_santri.program_jenjang_id', 'left')
            ->where('tapel_antrian_id', $tapel_id)
            ->where('jadwal_tes_id', $id_jadwal_tes)
            ->where('kirim_data_santri', 1)
            ->where('status_santri', 3)
            ->select('psb_data_santri.id_santri, psb_data_santri.nama_lengkap, psb_data_santri.alamat, psb_data_santri.nama_ayah, psb_data_santri.nama_ibu, psb_data_santri.asal_sekolah, psb_data_santri.status_santri, psb_data_santri.tapel_inden_id, psb_master_kelurahan.nama_kelurahan, psb_master_kecamatan.nama_kecamatan, psb_master_kotakab.nama_kota_kab, psb_master_provinsi.nama_provinsi, psb_tahun_pelajaran.ket_tapel, psb_program_jenjang.nama_program, psb_tingkat_sekolah.nama_tingkat')
            ->order_by('tgl_inden', 'desc')
            ->get()
            ->result_array();
    }

    public function Casan_ByJadwalByProgram($id_jadwal_tes, $tapel_id, $id_program)
    {
        return $this->db->from('psb_antrian_jadwal')
            ->join('psb_data_santri', 'psb_data_santri.id_santri=santri_antrian_id', 'left')
            ->join('psb_akun', 'psb_akun.santri_id=psb_data_santri.id_santri', 'left')
            ->join('psb_jenis_kelamin', 'psb_jenis_kelamin.id_jenis_kelamin=psb_data_santri.jenis_kelamin_id', 'left')
            ->join('psb_agama', 'psb_agama.id_agama=psb_data_santri.agama_id', 'left')
            ->join('psb_kebutuhan_khusus', 'psb_kebutuhan_khusus.id_kebutuhan_khusus=psb_data_santri.kebutuhan_khusus_id', 'left')
            ->join('psb_master_kelurahan', 'psb_master_kelurahan.id_kel=psb_data_santri.desa_kelurahan_id', 'left')
            ->join('psb_master_kecamatan', 'psb_master_kecamatan.id_kec=psb_master_kelurahan.kec_id', 'left')
            ->join('psb_master_kotakab', 'psb_master_kotakab.id_kota_kab=psb_master_kecamatan.kota_kab_id', 'left')
            ->join('psb_master_provinsi', 'psb_master_provinsi.id_provinsi=psb_master_kotakab.prov_id', 'left')
            ->join('psb_tahun_pelajaran', 'psb_tahun_pelajaran.id_tapel=psb_data_santri.tapel_inden_id', 'left')
            ->join('psb_tingkat_sekolah', 'psb_tingkat_sekolah.id_tingkat_sekolah=psb_data_santri.daftar_tingkat_id', 'left')
            ->join('psb_program_jenjang', 'psb_program_jenjang.id_program_jenjang=psb_data_santri.program_jenjang_id', 'left')
            ->select('psb_data_santri.id_santri, psb_data_santri.nama_lengkap, psb_data_santri.alamat, psb_data_santri.nama_ayah, psb_data_santri.nama_ibu, psb_data_santri.asal_sekolah, psb_data_santri.status_santri, psb_data_santri.tapel_inden_id, psb_data_santri.program_jenjang_id, psb_master_kelurahan.nama_kelurahan, psb_master_kecamatan.nama_kecamatan, psb_master_kotakab.nama_kota_kab, psb_master_provinsi.nama_provinsi, psb_tahun_pelajaran.ket_tapel, psb_program_jenjang.nama_program, psb_tingkat_sekolah.nama_tingkat')
            ->where('tapel_antrian_id', $tapel_id)
            ->where('jadwal_tes_id', $id_jadwal_tes)
            ->where('psb_data_santri.program_jenjang_id', $id_program)
            ->where('kirim_data_santri', 1)
            ->where('status_santri', 3)
            ->order_by('tgl_inden', 'desc')
            ->get()
            ->result_array();
    }

    public function dataSantriDiterima($id_tapel)
    {
        return $this->db->from('psb_data_santri')
            ->join('psb_akun', 'psb_akun.santri_id=id_santri', 'left')
            ->join('psb_jenis_kelamin', 'psb_jenis_kelamin.id_jenis_kelamin=jenis_kelamin_id', 'left')
            ->join('psb_agama', 'psb_agama.id_agama=agama_id', 'left')
            ->join('psb_kebutuhan_khusus', 'psb_kebutuhan_khusus.id_kebutuhan_khusus=kebutuhan_khusus_id', 'left')
            ->join('psb_master_kelurahan', 'psb_master_kelurahan.id_kel=desa_kelurahan_id', 'left')
            ->join('psb_master_kecamatan', 'psb_master_kecamatan.id_kec=psb_master_kelurahan.kec_id', 'left')
            ->join('psb_master_kotakab', 'psb_master_kotakab.id_kota_kab=psb_master_kecamatan.kota_kab_id', 'left')
            ->join('psb_master_provinsi', 'psb_master_provinsi.id_provinsi=psb_master_kotakab.prov_id', 'left')
            ->join('psb_tahun_pelajaran', 'psb_tahun_pelajaran.id_tapel=tapel_inden_id', 'left')
            ->join('psb_tingkat_sekolah', 'psb_tingkat_sekolah.id_tingkat_sekolah=daftar_tingkat_id', 'left')
            ->join('psb_program_jenjang', 'psb_program_jenjang.id_program_jenjang=program_jenjang_id', 'left')
            ->select('psb_data_santri.id_santri, psb_data_santri.nama_lengkap, psb_data_santri.alamat, psb_data_santri.nama_ayah, psb_data_santri.nama_ibu, psb_data_santri.asal_sekolah, psb_data_santri.status_santri, psb_data_santri.tapel_inden_id, psb_data_santri.daftar_tingkat_id, psb_data_santri.program_jenjang_id, psb_master_kelurahan.nama_kelurahan, psb_master_kecamatan.nama_kecamatan, psb_master_kotakab.nama_kota_kab, psb_master_provinsi.nama_provinsi, psb_tahun_pelajaran.ket_tapel, psb_program_jenjang.nama_program, psb_tingkat_sekolah.nama_tingkat, psb_akun.username, psb_akun.pass_tampil')
            ->where('kirim_data_santri', 1)
            ->where('status_santri', 1)
            ->where('tapel_inden_id', $id_tapel)
            ->order_by('tgl_inden', 'asc')
            ->get()
            ->result_array();
    }

    public function dataSantriDiterimaPertingkat($id_tapel, $daftar_tingkat_id)
    {
        return $this->db->from('psb_data_santri')
            ->join('psb_akun', 'psb_akun.santri_id=id_santri', 'left')
            ->join('psb_jenis_kelamin', 'psb_jenis_kelamin.id_jenis_kelamin=jenis_kelamin_id', 'left')
            ->join('psb_agama', 'psb_agama.id_agama=agama_id', 'left')
            ->join('psb_kebutuhan_khusus', 'psb_kebutuhan_khusus.id_kebutuhan_khusus=kebutuhan_khusus_id', 'left')
            ->join('psb_master_kelurahan', 'psb_master_kelurahan.id_kel=desa_kelurahan_id', 'left')
            ->join('psb_master_kecamatan', 'psb_master_kecamatan.id_kec=psb_master_kelurahan.kec_id', 'left')
            ->join('psb_master_kotakab', 'psb_master_kotakab.id_kota_kab=psb_master_kecamatan.kota_kab_id', 'left')
            ->join('psb_master_provinsi', 'psb_master_provinsi.id_provinsi=psb_master_kotakab.prov_id', 'left')
            ->join('psb_tahun_pelajaran', 'psb_tahun_pelajaran.id_tapel=tapel_inden_id', 'left')
            ->join('psb_tingkat_sekolah', 'psb_tingkat_sekolah.id_tingkat_sekolah=daftar_tingkat_id', 'left')
            ->join('psb_program_jenjang', 'psb_program_jenjang.id_program_jenjang=program_jenjang_id', 'left')
            ->select('psb_data_santri.id_santri, psb_data_santri.nama_lengkap, psb_data_santri.alamat, psb_data_santri.nama_ayah, psb_data_santri.nama_ibu, psb_data_santri.asal_sekolah, psb_data_santri.status_santri, psb_data_santri.tapel_inden_id, psb_data_santri.daftar_tingkat_id, psb_data_santri.program_jenjang_id, psb_master_kelurahan.nama_kelurahan, psb_master_kecamatan.nama_kecamatan, psb_master_kotakab.nama_kota_kab, psb_master_provinsi.nama_provinsi, psb_tahun_pelajaran.ket_tapel, psb_program_jenjang.nama_program, psb_tingkat_sekolah.nama_tingkat, psb_akun.username, psb_akun.pass_tampil')
            ->where('kirim_data_santri', 1)
            ->where('status_santri', 1)
            ->where('daftar_tingkat_id', $daftar_tingkat_id)
            ->where('tapel_inden_id', $id_tapel)
            ->get()
            ->result_array();
    }

    public function jadwal_tes()
    {
        return $this->db->from('psb_jadwal_tes')
            ->join('psb_tahun_pelajaran', 'psb_tahun_pelajaran.id_tapel=tapel_jadwal_id', 'left')
            ->join('psb_tahap', 'psb_tahap.id_tahap=tahap_id', 'left')
            ->where_not_in('status_jadwal', [0])
            ->get()
            ->result_array();
    }

    public function getjadwal_satu($id_jadwal_tes)
    {
        return $this->db->from('psb_jadwal_tes')
            ->join('psb_tahun_pelajaran', 'psb_tahun_pelajaran.id_tapel=tapel_jadwal_id', 'left')
            ->join('psb_tahap', 'psb_tahap.id_tahap=tahap_id', 'left')
            ->where('id_jadwal_tes', $id_jadwal_tes)
            ->where_not_in('status_jadwal', [0])
            ->get()
            ->row_array();
    }

    public function antrian_tes_byjadwal($id_jadwal_tes)
    {
        return $this->db->from('psb_antrian_jadwal')
            ->join('psb_data_santri', 'psb_data_santri.id_santri=santri_antrian_id', 'left')
            ->join('psb_jadwal_tes', 'psb_jadwal_tes.id_jadwal_tes=jadwal_tes_id', 'left')
            ->where('status_antrian_santri', 1)
            ->where('jadwal_tes_id', $id_jadwal_tes)
            ->order_by('no_urut_antrian', 'ASC')
            ->get()
            ->result_array();
    }

    public function dafdir_perjadwal($id_jadwal_tes)
    {
        return $this->db->from('psb_antrian_jadwal')
            ->join('psb_data_santri', 'psb_data_santri.id_santri=santri_antrian_id', 'left')
            ->join('psb_jadwal_tes', 'psb_jadwal_tes.id_jadwal_tes=jadwal_tes_id', 'left')
            ->join('psb_master_kelurahan', 'psb_master_kelurahan.id_kel=psb_data_santri.desa_kelurahan_id', 'left')
            ->join('psb_master_kecamatan', 'psb_master_kecamatan.id_kec=psb_master_kelurahan.kec_id', 'left')
            ->join('psb_master_kotakab', 'psb_master_kotakab.id_kota_kab=psb_master_kecamatan.kota_kab_id', 'left')
            ->join('psb_master_provinsi', 'psb_master_provinsi.id_provinsi=psb_master_kotakab.prov_id', 'left')
            ->join('psb_jenis_kelamin', 'psb_jenis_kelamin.id_jenis_kelamin=psb_data_santri.jenis_kelamin_id', 'left')
            ->join('psb_alat_transportasi', 'psb_alat_transportasi.id_transportasi=alat_transportasi_id', 'left')
            ->join('psb_tahun_pelajaran', 'psb_tahun_pelajaran.id_tapel=tapel_inden_id', 'left')
            ->join('psb_tingkat_sekolah', 'psb_tingkat_sekolah.id_tingkat_sekolah=daftar_tingkat_id', 'left')
            ->join('psb_program_jenjang', 'psb_program_jenjang.id_program_jenjang=program_jenjang_id', 'left')
            ->select('psb_data_santri.*, psb_jenis_kelamin.*, psb_master_kelurahan.*, psb_master_kecamatan.*, psb_master_kotakab.*, psb_master_provinsi.*, psb_alat_transportasi.*, psb_tahun_pelajaran.*, psb_program_jenjang.*')
            ->where('status_antrian_santri', 1)
            ->where('jadwal_tes_id', $id_jadwal_tes)
            ->order_by('no_urut_antrian', 'ASC')
            ->get()
            ->result_array();
    }

    public function getsatu_jadwal($id_jadwal_tes)
    {
        return $this->db->from('psb_jadwal_tes')
            ->join('psb_tahun_pelajaran', 'psb_tahun_pelajaran.id_tapel=tapel_jadwal_id', 'left')
            ->join('psb_tahap', 'psb_tahap.id_tahap=tahap_id', 'left')
            ->where('id_jadwal_tes', $id_jadwal_tes)
            ->get()
            ->row_array();
    }

    public function antrian_tes()
    {
        return $this->db->from('psb_antrian_jadwal')
            ->join('psb_data_santri', 'psb_data_santri.id_santri=santri_antrian_id', 'left')
            ->join('psb_program_jenjang', 'psb_program_jenjang.id_program_jenjang=psb_data_santri.program_jenjang_id', 'left')
            ->get()
            ->result_array();
    }

    public function antrian_tesnotahap()
    {
        return $this->db->from('psb_antrian_jadwal')
            ->join('psb_data_santri', 'psb_data_santri.id_santri=santri_antrian_id', 'left')
            ->join('psb_program_jenjang', 'psb_program_jenjang.id_program_jenjang=psb_data_santri.program_jenjang_id', 'left')
            ->where('antrian_tahap_id', 0)
            ->where('status_antrian_santri', 0)
            ->where('jadwal_tes_id', 0)
            ->order_by('no_urut_antrian', 'ASC')
            ->get()
            ->result_array();
    }

    public function antrian_tes_bytahap($tahap_id, $id_tapel)
    {
        return $this->db->from('psb_antrian_jadwal')
            ->join('psb_data_santri', 'psb_data_santri.id_santri=santri_antrian_id', 'left')
            ->join('psb_jadwal_tes', 'psb_jadwal_tes.id_jadwal_tes=jadwal_tes_id', 'left')
            ->join('psb_program_jenjang', 'psb_program_jenjang.id_program_jenjang=psb_data_santri.program_jenjang_id', 'left')
            ->where('tapel_antrian_id', $id_tapel)
            ->where('antrian_tahap_id', $tahap_id)
            ->where('status_antrian_santri', 7)
            // ->where('status_antrian_santri', 0)
            ->order_by('no_urut_antrian', 'ASC')
            ->get()
            ->result_array();
    }

    public function delete_antrianSantriByJadwal($antrian_tahap_id, $santri_antrian_id)
    {
        $this->db->where('antrian_tahap_id', $antrian_tahap_id);
        $this->db->where('santri_antrian_id', $santri_antrian_id);
        $this->db->delete('psb_antrian_jadwal');
    }

    public function jadwal_persantri($id_santri)
    {
        return $this->db->from('psb_antrian_jadwal')
            ->join('psb_data_santri', 'psb_data_santri.id_santri=santri_antrian_id', 'left')
            ->join('psb_jadwal_tes', 'psb_jadwal_tes.id_jadwal_tes=jadwal_tes_id', 'left')
            ->where('santri_antrian_id', $id_santri)
            ->where('status_antrian_santri', 1)
            ->get()
            ->row_array();
    }

    // public function datawawancara()
    // {
    //     return $this->db->from('psb_jenis_wawancara')
    //         ->join('psb_data_pegawai', 'psb_data_pegawai.id_pegawai_psb=penilai_id', 'left')
    //         ->get()
    //         ->result_array();
    // }

    public function datapenilaian()
    {
        return $this->db->from('psb_jenis_penilaian')
            ->join('psb_data_pegawai', 'psb_data_pegawai.id_pegawai_psb=penilai_id', 'left')
            ->get()
            ->result_array();
    }

    public function datapenilai_noadmin()
    {
        return $this->db->from('psb_data_pegawai')
            ->join('psb_akun', 'psb_akun.pegawai_psb_id=id_pegawai_psb', 'left')
            ->where_not_in('psb_akun.role_id', [1])
            ->get()
            ->result_array();
    }

    public function getTesAkademik()
    {
        return $this->db->from('psb_jenis_penilaian')
            ->where('id_jenis_penilaian', 2) // 2 -> id tes akademik
            ->get()
            ->row_array();
    }

    public function getIDhasilNilaibySantri_Tesakademik($id_tes_akademik, $id_santri)
    {
        return $this->db->from('psb_hasil_penilaian')
            ->where('jenis_penilaian_id', $id_tes_akademik)
            ->where('hasil_santri_id', $id_santri)
            ->get()
            ->row_array();
    }

    public function sync_nilaiesantri_tesAkademik()
    {
        return $this->db->from('psb_hasil_penilaian')
            ->join('psb_data_santri', 'psb_data_santri.id_santri=hasil_santri_id', 'left')
            ->join('psb_data_pegawai', 'psb_data_pegawai.id_pegawai_psb=pegawai_penilaian_id', 'left')
            ->join('psb_jenis_penilaian', 'psb_jenis_penilaian.id_jenis_penilaian=jenis_penilaian_id', 'left')
            ->join('psb_jadwal_tes', 'psb_jadwal_tes.id_jadwal_tes=jadwal_penilaian_id', 'left')
            ->join('psb_tahun_pelajaran', 'psb_tahun_pelajaran.id_tapel=psb_jadwal_tes.tapel_jadwal_id', 'left')
            ->join('psb_tahap', 'psb_tahap.id_tahap=psb_jadwal_tes.tahap_id', 'left')
            ->where('jenis_penilaian_id', 2)
            ->where('psb_jadwal_tes.status_jadwal', 1)
            ->order_by('jadwal_penilaian_id', 'asc')
            ->get()
            ->result_array();
    }

    public function jadwal_aktif()
    {
        return $this->db->from('psb_jadwal_tes')
            ->join('psb_tahap', 'psb_tahap.id_tahap=tahap_id', 'left')
            // ->join('psb_akun', 'psb_akun.pegawai_psb_id=id_pegawai_psb', 'left')
            ->where('status_jadwal', 1)
            ->get()
            ->result_array();
    }

    public function Data_HasilPenilaian($id_santri)
    {
        return $this->db->from('psb_hasil_penilaian')
            ->join('psb_data_santri', 'psb_data_santri.id_santri=hasil_santri_id', 'left')
            ->join('psb_jenis_penilaian', 'psb_jenis_penilaian.id_jenis_penilaian=jenis_penilaian_id', 'left')
            ->join('psb_jadwal_tes', 'psb_jadwal_tes.id_jadwal_tes=jadwal_penilaian_id', 'left')
            ->join('psb_data_pegawai', 'psb_data_pegawai.id_pegawai_psb=pegawai_penilaian_id', 'left')
            ->where('hasil_santri_id', $id_santri)
            ->get()
            ->result_array();
    }

    public function Data_HasilKesehatan($id_santri)
    {
        return $this->db->from('psb_hasil_kesehatan')
            ->join('psb_data_santri', 'psb_data_santri.id_santri=kesehatan_santri_id', 'left')
            ->join('psb_jadwal_tes', 'psb_jadwal_tes.id_jadwal_tes=jadwal_kesehatan_id', 'left')
            ->join('psb_data_pegawai', 'psb_data_pegawai.id_pegawai_psb=pegawai_kesehatan_id', 'left')
            ->where('kesehatan_santri_id', $id_santri)
            ->get()
            ->row_array();
        // ->result_array();
    }

    public function Data_HasilWawancara($id_santri)
    {
        return $this->db->from('psb_hasil_wawancara_api')
            ->join('psb_data_santri', 'psb_data_santri.id_santri=wawancara_api_santri_id', 'left')
            ->join('psb_jadwal_tes', 'psb_jadwal_tes.id_jadwal_tes=wawancara_jadwal_api_id', 'left')
            ->join('psb_tahun_pelajaran', 'psb_tahun_pelajaran.id_tapel=psb_jadwal_tes.tapel_jadwal_id', 'left')
            ->join('psb_tahap', 'psb_tahap.id_tahap=psb_jadwal_tes.tahap_id', 'left')
            ->join('psb_data_pegawai as pewawancara_santri', 'pewawancara_santri.id_pegawai_psb=pegawai_wawancara_santri_id', 'left')
            ->join('psb_data_pegawai as pewawancara_ortu', 'pewawancara_ortu.id_pegawai_psb=pegawai_wawancara_ortu_id', 'left')
            ->select('psb_data_santri.id_santri, psb_data_santri.nama_lengkap, psb_jadwal_tes.nama_jadwal, psb_tahap.nama_tahap, psb_tahun_pelajaran.ket_tapel, psb_hasil_wawancara_api.*, pewawancara_santri.nama_lengkap_pegawai AS nama_pewawancara_santri, pewawancara_ortu.nama_lengkap_pegawai AS nama_pewawancara_ortu')
            ->where('wawancara_api_santri_id', $id_santri)
            ->get()
            ->row_array();
    }

    public function getPembiayaan_ortu($id_santri)
    {
        return $this->db->from('psb_hasil_wawancara')
            ->join('psb_data_santri', 'psb_data_santri.id_santri=wawancara_santri_id', 'left')
            ->join('psb_data_pegawai', 'psb_data_pegawai.id_pegawai_psb=pegawai_wawancara_id', 'left')
            ->join('psb_jadwal_tes', 'psb_jadwal_tes.id_jadwal_tes=jadwal_wawancara_id', 'left')
            ->join('psb_tahun_pelajaran', 'psb_tahun_pelajaran.id_tapel=psb_jadwal_tes.tapel_jadwal_id', 'left')
            ->join('psb_tahap', 'psb_tahap.id_tahap=psb_jadwal_tes.tahap_id', 'left')
            ->join('psb_item_jenis_wawancara', 'psb_item_jenis_wawancara.id_item_jenis_wawancara=item_jenis_wawancara_id', 'left')
            ->join('psb_jenis_wawancara', 'psb_jenis_wawancara.id_jenis_wawancara=psb_item_jenis_wawancara.data_jenis_wawancara_id', 'left')
            ->join('psb_item_wawancara', 'psb_item_wawancara.id_item_wawancara=psb_item_jenis_wawancara.data_item_wawancara_id', 'left')
            ->where('wawancara_santri_id', $id_santri)
            ->where('item_jenis_wawancara_id', 11)
            ->get()
            ->row_array();
        // ->result_array();
    }
}
