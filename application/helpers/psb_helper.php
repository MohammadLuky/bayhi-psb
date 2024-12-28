<?php


function is_login($peran_ids)
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        redirect('auth');
    } else {
        $role = $ci->session->userdata('role_id');
        // var_dump($peran_ids);
        // die;

        if (!is_array($peran_ids)) {
            $peran_ids = array($peran_ids);
        }

        if (!in_array($role, $peran_ids)) {
            redirect('auth/blocked');
        }
    }
}

function tanggal_indonesia_format2($tanggal)
{
    $bulan = array(
        1 => 'JANUARI',
        2 => 'FEBRUARI',
        3 => 'MARET',
        4 => 'APRIL',
        5 => 'MEI',
        6 => 'JUNI',
        7 => 'JULI',
        8 => 'AGUSTUS',
        9 => 'SEPTEMBER',
        10 => 'OKTOBER',
        11 => 'NOVEMBER',
        12 => 'DESEMBER'
    );

    $parts = explode('-', $tanggal);
    $bulan_num = (int)$parts[1];
    $hari = (int)$parts[2];
    $tahun = $parts[0];

    $tanggal_indonesia =  $hari . ' ' . $bulan[$bulan_num] . ' ' . $tahun;
    return $tanggal_indonesia;
}
function tanggal_indonesia_format($tanggal)
{
    $bulan = array(
        1 => 'JANUARI',
        2 => 'FEBRUARI',
        3 => 'MARET',
        4 => 'APRIL',
        5 => 'MEI',
        6 => 'JUNI',
        7 => 'JULI',
        8 => 'AGUSTUS',
        9 => 'SEPTEMBER',
        10 => 'OKTOBER',
        11 => 'NOVEMBER',
        12 => 'DESEMBER'
    );

    $parts = explode('/', $tanggal);
    $bulan_num = (int)$parts[0];
    $hari = (int)$parts[1];
    $tahun = $parts[2];

    $tanggal_indonesia =  $hari . ' ' . $bulan[$bulan_num] . ' ' . $tahun;
    return $tanggal_indonesia;
}

function formatRupiah($angka)
{
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

// if (!function_exists('calculate_age')) {
//     function calculate_age($birthdate)
//     {
//         $birthdate = DateTime::createFromFormat('d/m/Y', $birthdate);
//         if (!$birthdate) {
//             return null;
//         }
//         $today = new DateTime('today');
//         $age = $birthdate->diff($today)->y;
//         return $age;
//     }
// }

function perpendekNama($username, $length = 5)
{
    if (strlen($username) > $length) {
        return substr($username, 0, $length) . '...';
    }
    return $username;
}

function HitungData($tabel, $fieldJoinWithId, $id_tabel)
{
    $ci = get_instance();
    $selectIdData = $ci->db->where($fieldJoinWithId, $id_tabel);
    return $selectIdData->count_all_results($tabel);
}
