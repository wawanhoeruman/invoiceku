<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if(!$this->session->userdata('login'))
        {
            redirect('auth');
        }

        if($this->session->userdata('role') != 'admin')
        {
            show_error('Akses ditolak', 403);
        }
    }

public function index()
{
    // statistik
    $data['total_user'] = $this->db->count_all('users');

    $data['total_admin'] = $this->db
        ->where('role','admin')
        ->count_all_results('users');

    $data['total_staff'] = $this->db
        ->where('role','staff')
        ->count_all_results('users');

    $this->load->view('user/menu', $data);
}

public function list()
{
    $this->load->library('pagination');

    $keyword = $this->input->get('keyword');

    // filter
    if($keyword){
        $this->db->like('nama', $keyword);
        $this->db->or_like('username', $keyword);
    }

    // hitung total data
    $total = $this->db->count_all_results('users');

    // config pagination
    $config['base_url'] = site_url('user/list');
    $config['total_rows'] = $total;
    $config['per_page'] = 8;
    $config['uri_segment'] = 3;

    // style bootstrap (biar bagus)
    $config['full_tag_open'] = '<nav><ul class="pagination">';
    $config['full_tag_close'] = '</ul></nav>';

    $config['first_link'] = 'First';
    $config['last_link'] = 'Last';

    $config['next_link'] = 'Next';
    $config['prev_link'] = 'Prev';

    $config['num_tag_open'] = '<li class="page-item">';
    $config['num_tag_close'] = '</li>';

    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
    $config['cur_tag_close'] = '</a></li>';

    $config['attributes'] = ['class' => 'page-link'];

    $this->pagination->initialize($config);

    // ambil data sesuai limit
    $start = $this->uri->segment(3);

    if($keyword){
        $this->db->like('nama', $keyword);
        $this->db->or_like('username', $keyword);
    }

//     $data['users'] = $this->db
//         ->limit($config['per_page'], $start)
//         ->get('users')
//         ->result();

//     $data['pagination'] = $this->pagination->create_links();
//     $data['keyword'] = $keyword;

//     $this->load->view('user/index', $data);
// }
// ... bagian kode atas tetap sama ...

    $data['users'] = $this->db
        ->limit($config['per_page'], $start)
        ->get('users')
        ->result();

    $data['pagination'] = $this->pagination->create_links();
    $data['keyword'] = $keyword;
    $data['total_rows'] = $total; // 🌟 TAMBAHKAN BARIS INI BIAR DATA ASLINYA KIRIM KE VIEW

    $this->load->view('user/index', $data);
}

    public function tambah()
{
    $this->load->view('user/tambah');
}

//     public function simpan()
// {
//     $nama     = $this->input->post('nama');
//     $username = $this->input->post('username');
//     $password = $this->input->post('password');
//     $role     = $this->input->post('role');

//     // 🔐 HASH PASSWORD
//     $password_hash = password_hash($password, PASSWORD_DEFAULT);

//     $data = [
//         'nama'     => $nama,
//         'username' => $username,
//         'password' => $password_hash,
//         'role'     => $role,
//         'created_at' => date('Y-m-d H:i:s')
//     ];

//     // $this->db->insert('users', $data);

//     // redirect('user');
//     $this->db->insert('users', $data);

// // 🔥 LOG
// log_activity('CREATE', 'Menambah user: ' . $nama);

// redirect('user/list');
// }

// baru
public function simpan()
{
    $nama     = $this->input->post('nama');
    $username = $this->input->post('username');
    $email    = trim($this->input->post('email')); // 🔥 1. TANGKAP INPUTAN EMAIL DI SINI
    $password = $this->input->post('password');
    $role     = $this->input->post('role');

    // 🔐 HASH PASSWORD
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $data = [
        'nama'       => $nama,
        'username'   => $username,
        'email'      => $email, // 🔥 2. MASUKKAN EMAIL KE ARRAY DATABASE
        'password'   => $password_hash,
        'role'       => $role,
        'created_at' => date('Y-m-d H:i:s')
    ];

    $this->db->insert('users', $data);

    // 🔥 LOG
    log_activity('CREATE', 'Menambah user: ' . $nama);

    redirect('user/list');
}

    public function edit($id)
{
    $data['user'] = $this->db
        ->get_where('users', ['id' => $id])
        ->row();

    $this->load->view('user/edit', $data);
}

//     public function update()
// {
//     $id       = $this->input->post('id');
//     $nama     = $this->input->post('nama');
//     $username = $this->input->post('username');
//     $password = $this->input->post('password');
//     $role     = $this->input->post('role');

//     $data = [
//         'nama'     => $nama,
//         'username' => $username,
//         'role'     => $role
//     ];

//     // 🔥 kalau password diisi → update
//     if(!empty($password)){
//         $data['password'] = password_hash($password, PASSWORD_DEFAULT);
//     }

//     // $this->db->where('id', $id);
//     // $this->db->update('users', $data);

//     // redirect('user');
//     $this->db->where('id', $id);
// $this->db->update('users', $data);

// // 🔥 LOG
// log_activity('UPDATE', 'Update user: ' . $nama);

// redirect('user/list');
// }

// baru

public function update()
{
    $id       = $this->input->post('id');
    $nama     = $this->input->post('nama');
    $username = $this->input->post('username');
    $email    = trim($this->input->post('email')); // 🔥 1. TANGKAP INPUTAN EMAIL BARU
    $password = $this->input->post('password');
    $role     = $this->input->post('role');

    $data = [
        'nama'     => $nama,
        'username' => $username,
        'email'    => $email, // 🔥 2. MASUKKAN EMAIL KE ARRAY UPDATE
        'role'     => $role
    ];

    // 🔥 kalau password diisi → update
    if(!empty($password)){
        $data['password'] = password_hash($password, PASSWORD_DEFAULT);
    }

    $this->db->where('id', $id);
    $this->db->update('users', $data);

    // 🔥 LOG
    log_activity('UPDATE', 'Update user: ' . $nama);

    redirect('user/list');
}

public function delete($id)
{
    // ambil user yang login sekarang
    $current_user_id = $this->session->userdata('user_id');

    // ❌ tidak boleh hapus diri sendiri
    if ($id == $current_user_id) {
        show_error('Tidak bisa menghapus akun sendiri', 403);
    }

    // // hapus user
    // $this->db->where('id', $id);
    // $this->db->delete('users');

    // redirect('user');
    $user = $this->db
    ->get_where('users', ['id' => $id])
    ->row();

    // 🔥 LOG
log_activity('DELETE', 'Hapus user: ' . $user->nama);

$this->db->where('id', $id);
$this->db->delete('users');

redirect('user/list');
}

}
