<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keuangan_model extends CI_Model {

    public function get_all()
    {
        return $this->db->get('transaksi')->result();
    }

    public function get_total_by_type($jenis)
{
    $this->db->select_sum('jumlah');
    $this->db->where('jenis', $jenis);
    $query = $this->db->get('transaksi');
    return $query->row()->jumlah ?? 0;
}
public function get_transaksi_by_user($user_id)
{
    return $this->db->get_where('transaksi', ['user_id' => $user_id])->result();
}

}
