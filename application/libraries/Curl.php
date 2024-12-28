<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Curl
{

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    public function simple_get($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}
