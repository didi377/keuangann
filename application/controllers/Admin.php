<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Keuangan_model');
        if ($this->session->userdata('role') !== 'admin') {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $users = $this->User_model->get_all_users();
        foreach ($users as &$user) {
            $user->transaksi = $this->Keuangan_model->get_transaksi_by_user($user->id);
        }
        $data['users'] = $users;
        $this->load->view('admin/dashboard', $data);
    }
    public function tambah_user()
    {
        if ($this->input->post()) {
            $data = [
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'), // bisa di-hash dulu
                'role'     => $this->input->post('role')
            ];
            $this->User_model->insert_user($data);
            redirect('admin');
        } else {
            $this->load->view('admin/tambah_user');
        }
    }

    public function edit_user($id)
    {
        $data['user'] = $this->User_model->get_user_by_id($id);
        if ($this->input->post()) {
            $update = [
                'username' => $this->input->post('username'),
                'role'     => $this->input->post('role')
            ];
            $this->User_model->update_user($id, $update);
            redirect('admin');
        } else {
            $this->load->view('admin/edit_user', $data);
        }
    }

    public function hapus_user($id)
    {
        $this->User_model->delete_user($id);
        redirect('admin');
    }

    public function transaksi_user($user_id)
    {
        $data['user'] = $this->User_model->get_user_by_id($user_id);
        $data['transaksi'] = $this->Keuangan_model->get_transaksi_by_user($user_id);
        $this->load->view('admin/transaksi_user', $data);
    }
}
