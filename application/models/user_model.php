<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_user($username, $password)
    {
        // Hash password kalau di database passwordnya di-hash
        // $password = md5($password); // kalau pakai md5

        $this->db->where('username', $username);
        $this->db->where('password', $password); // atau password yang sudah di-hash
        $query = $this->db->get('users'); // Pastikan nama tabel kamu 'users'

        if ($query->num_rows() == 1) {
            return $query->row(); // Return data user
        } else {
            return false; // Gagal login
        }
    }
    public function get_all_users()
{
    return $this->db->get('users')->result();
}

public function get_user_by_id($id)
{
    return $this->db->get_where('users', ['id' => $id])->row();
}

public function insert_user($data)
{
    return $this->db->insert('users', $data);
}

public function update_user($id, $data)
{
    return $this->db->where('id', $id)->update('users', $data);
}

public function delete_user($id)
{
    return $this->db->delete('users', ['id' => $id]);
}

}
?>
