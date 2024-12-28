<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Psbapi_model extends CI_Model
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
            ->join($tb_tujuan, $tb_tujuan . '.' . $id_tb_tujuan . '=' . $field_id_join)
            ->order_by($id_tb_tujuan, 'asc')
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
            ->select('psb_data_santri.*, psb_akun.*, psb_jenis_kelamin.*, psb_agama.*, psb_kebutuhan_khusus.*, psb_master_kelurahan.*, psb_master_kecamatan.*, psb_master_kotakab.*, psb_master_provinsi.*, psb_alat_transportasi.*, pend_ayah.nama_pendidikan_ortu AS pendidikan_ayah, kerja_ayah.jenis_pekerjaan AS pekerjaan_ayah, hasil_ayah.range_penghasilan AS penghasilan_ayah, pend_ibu.nama_pendidikan_ortu AS pendidikan_ibu, kerja_ibu.jenis_pekerjaan AS pekerjaan_ibu, hasil_ibu.range_penghasilan AS penghasilan_ibu, pend_wali.nama_pendidikan_ortu AS pendidikan_wali, kerja_wali.jenis_pekerjaan AS pekerjaan_wali, hasil_wali.range_penghasilan AS penghasilan_wali, psb_tahun_pelajaran.*, psb_program_jenjang.*')
            ->get()
            ->row_array();
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
            ->where('status_santri', 1)
            // ->select('psb_data_santri.nama_lengkap, psb_data_santri.no_registrasi, psb_akun.username')
            ->select('psb_data_santri.*, psb_akun.*, psb_jenis_kelamin.*, psb_agama.*, psb_kebutuhan_khusus.*, psb_master_kelurahan.*, psb_master_kecamatan.*, psb_master_kotakab.*, psb_master_provinsi.*, psb_alat_transportasi.*, pend_ayah.nama_pendidikan_ortu AS pendidikan_ayah, kerja_ayah.jenis_pekerjaan AS pekerjaan_ayah, hasil_ayah.range_penghasilan AS penghasilan_ayah, pend_ibu.nama_pendidikan_ortu AS pendidikan_ibu, kerja_ibu.jenis_pekerjaan AS pekerjaan_ibu, hasil_ibu.range_penghasilan AS penghasilan_ibu, pend_wali.nama_pendidikan_ortu AS pendidikan_wali, kerja_wali.jenis_pekerjaan AS pekerjaan_wali, hasil_wali.range_penghasilan AS penghasilan_wali, psb_tahun_pelajaran.*, psb_program_jenjang.*')
            ->get()
            ->result_array();
    }
}
