<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Apidata extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Psb_model', 'psb');
        $this->load->model('Psbapi_model', 'api');
        // is_login(array('1', '2', '3', '4', '5', '6', '7'));
    }

    public function santri_psb()
    {
        $pegawai_santripsb = $this->api->dataAll_santri();

        $tampil_data = json_encode($pegawai_santripsb);
        echo $tampil_data;
    }
}
