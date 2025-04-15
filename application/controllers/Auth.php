<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function login()
    {
        if ($this->input->post()) {
            // Ambil data username dan password dari form
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // Cek apakah username dan password valid
            $user = $this->User_model->get_user($username, $password);

            if ($user) {
                // Login berhasil, simpan data session
                $this->session->set_userdata('username', $user->username);
                $this->session->set_userdata('role', $user->role);
                $this->session->set_userdata('user_id', $user->id);

                if ($user->role == 'admin') {
                    redirect('admin'); // Setelah login, redirect ke halaman keuangan
                }
                redirect('keuangan'); // Setelah login, redirect ke halaman keuangan
            } else {
                // Login gagal, beri pesan error
                $this->session->set_flashdata('error', 'Username atau password salah!');
                redirect('auth/login'); // Redirect ke halaman login dengan pesan error
            }
        } else {
            // Tampilkan halaman login
            $this->load->view('login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login'); // Redirect ke halaman login setelah logout
    }
}
