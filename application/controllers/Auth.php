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

    
// versilama
// public function forgot_password()
//     {
//         $email = trim($this->input->post('email'));

//         if (empty($email)) {
//             // Kita panggil file login, tapi kita selipkan variabel $mode = 'forgot'
//             $data['mode'] = 'forgot';
//             $this->load->view('login', $data);
//         } else {
//             $user = $this->db->get_where('users', ['email' => $email])->row();

//             if ($user) {
//                 // TODO: Logic kirim email di sini
//                 $this->session->set_flashdata('success', 'Link reset password telah dikirim ke email Anda!');
//                 redirect('auth/forgot_password');
//             } else {
//                 $this->session->set_flashdata('error', 'Email tidak terdaftar!');
//                 redirect('auth/forgot_password');
//             }
//         }
//     } 


// forget psswd
public function forgot_password()
{
    $email_tujuan = trim($this->input->post('email'));

    // Pengecekan versi lama Mas Wawan yang terbukti aman
    if (empty($email_tujuan)) {
        // Jika form kosong / baru pertama kali buka halaman
        $data['mode'] = 'forgot';
        $this->load->view('login', $data);
    } else {
        // Cek dulu apakah emailnya ada di database Mas
        $user = $this->db->get_where('users', ['email' => $email_tujuan])->row();

        if ($user) {
            // 1. Set Konfigurasi SMTP Google (Kode 16 digit Mas Wawan)
$config = [
    'protocol'    => 'smtp',
    'smtp_host'   => 'smtp.gmail.com',       // Menggunakan host standar Gmail
    'smtp_port'   => 587,                    // 🌟 Pindah ke port TLS 587
    'smtp_user'   => 'appinvoiceku@gmail.com',
    'smtp_pass'   => 'umgvvunhnjntlokz',
    'mailtype'    => 'html',
    'charset'     => 'utf-8',
    'newline'     => "\r\n",
    'crlf'        => "\r\n",
    'smtp_crypto' => 'tls',                  // 🌟 Ganti crypto menjadi TLS
    'stream'      => [
        'ssl' => [
            'verify_peer'      => FALSE,
            'verify_peer_name' => FALSE,
            'allow_self_signed'=> TRUE
        ]
    ]
];

            // 2. Load library email
            $this->load->library('email', $config);

            // 3. Susun Emailnya
            $this->email->from('appinvoiceku@gmail.com', 'Invoiceku System');
            $this->email->to($email_tujuan);
            $this->email->subject('Reset Password Link - Invoiceku');
            
            $message = "
            <html>
            <head><title>Reset Password</title></head>
            <body>
                <h2>Halo,</h2>
                <p>Kami menerima permintaan untuk mereset password akun Invoiceku Anda.</p>
                <p>Silakan klik link di bawah ini untuk membuat password baru:</p>
                <p><a href='" . base_url() . "auth/resetpassword?email=" . $email_tujuan . "' style='background:#f1c40f; color:#fff; padding:10px; text-decoration:none; border-radius:5px;'>Reset Password Saya</a></p>
                <br>
                <p>Jika Anda tidak merasa melakukan permintaan ini, abaikan saja email ini.</p>
            </body>
            </html>
            ";
            $this->email->message($message);

            // 4. Proses Kirim
            if ($this->email->send()) {
                $this->session->set_flashdata('success', 'Link reset password telah dikirim ke email Anda!');
                redirect('auth/forgot_password');
            } else {
                // Jika gagal kirim, Ubuntu akan muntahin error-nya di sini biar kita tahu kenapa
                echo $this->email->print_debugger();
                die;
            }

        } else{
            // Jika email tidak terdaftar di database
            $this->session->set_flashdata('error', 'Email tidak terdaftar!');
            redirect('auth/forgot_password');
        }
    }
}

// reset password 
public function resetpassword()
{
    $email = $this->input->get('email');

    if (empty($email)) {
        $this->session->set_flashdata('error', 'Akses ilegal! Email tidak ditemukan.');
        redirect('auth');
    }

    $password_baru = $this->input->post('password_baru');

    if (empty($password_baru)) {
        // 🌟 DI SINI KITA MANGGIL FILE LOGIN DENGAN MODE CHANGE
        $data['mode'] = 'change';
        $data['email'] = $email;
        $this->load->view('login', $data);
    } else {
        // Proses update password ke database
        $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

        $this->db->set('password', $password_hash); // sesuaikan nama kolom DB Mas
        $this->db->where('email', $email);
        $this->db->update('users'); // sesuaikan nama tabel DB Mas

        $this->session->set_flashdata('success', 'Password Anda berhasil diubah! Silakan login.');
        redirect('auth');
    }
}

}