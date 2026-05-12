<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function index()
    {
        $this->load->view('login');
    }

    public function proses()
    {
        $u = trim($this->input->post('username'));
        $p = trim($this->input->post('password'));

        $user = $this->db->get_where('users', ['username'=>$u])->row();

        if($user && password_verify($p, $user->password))
        {
            // $this->session->set_userdata([
            //     'login' => true,
            //     'nama'  => $user->nama
            // ]);

//                 $this->session->set_userdata([
//     'login'   => true,
//     'user_id' => $user->id,   // 🔥 INI YANG sebelumnya
//     'nama'    => $user->nama
// ]);
        $this->session->set_userdata([
    'login'   => true,
    'user_id' => $user->id,
    'nama'    => $user->nama,
    'role'    => $user->role // 🔥 WAJIB ADA
]);

            log_activity('LOGIN', 'User login: ' . $user->nama);

            redirect('dashboard');
        }
else
{
    $this->session->set_flashdata('error', 'Username atau Password salah!');
    redirect('auth');
}
    }

    public function logout()
    {
        log_activity('LOGOUT', 'User logout: ' . $this->session->userdata('nama'));
        $this->session->sess_destroy();
        redirect('auth');
    }
}