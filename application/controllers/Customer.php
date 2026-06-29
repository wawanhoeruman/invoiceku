<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if(!$this->session->userdata('login')){
            redirect('auth');
        }

        $this->load->library('pagination');
    }

    /* =========================
       MENU CUSTOMER
    ========================== */
    public function index()
    {
        $data['total_customer'] =
            $this->db->count_all('customers');

        $data['with_phone'] =
            $this->db
            ->where('telepon !=','')
            ->count_all_results('customers');

        $data['with_email'] =
            $this->db
            ->where('email !=','')
            ->count_all_results('customers');

        $this->load->view('customer/index', $data);
    }

//versi lama
    //    public function list()
    // {
    //     $keyword = $this->input->get('keyword');

    //     if($keyword){
    //         $this->db->group_start();
    //         $this->db->like('nama', $keyword);
    //         $this->db->or_like('telepon', $keyword);
    //         $this->db->or_like('email', $keyword);
    //         $this->db->group_end();
    //     }

    //     $total = $this->db->count_all_results('customers', false);

    //     $config['base_url'] = site_url('customer/list');
    //     $config['reuse_query_string'] = true;
    //     $config['total_rows'] = $total;
    //     $config['per_page'] = 5;
    //     $config['uri_segment'] = 3;

    //     $config['full_tag_open'] =
    //     '<nav><ul class="pagination mt-3">';
    //     $config['full_tag_close'] = '</ul></nav>';

    //     $config['first_link'] = false;
    //     $config['last_link']  = false;

    //     $config['prev_link'] = 'Prev';
    //     $config['next_link'] = 'Next';

    //     $config['prev_tag_open'] = '<li class="page-item">';
    //     $config['prev_tag_close'] = '</li>';

    //     $config['next_tag_open'] = '<li class="page-item">';
    //     $config['next_tag_close'] = '</li>';

    //     $config['num_tag_open'] = '<li class="page-item">';
    //     $config['num_tag_close'] = '</li>';

    //     $config['cur_tag_open'] =
    //     '<li class="page-item active"><span class="page-link">';
    //     $config['cur_tag_close'] =
    //     '</span></li>';

    //     $config['attributes'] =
    //     ['class'=>'page-link'];

    //     $this->pagination->initialize($config);

    //     $page = $this->uri->segment(3);
    //     if(!$page) $page = 0;

    //     $this->db->limit($config['per_page'], $page);

    //     $data['customer'] =
    //         $this->db->get()->result();

    //     $data['keyword'] = $keyword;
    //     $data['paging'] =
    //         $this->pagination->create_links();

    //     $this->load->view('customer/list', $data);
    // }

public function list()
    {
        $keyword = $this->input->get('keyword');

        if($keyword){
            $this->db->group_start();
            $this->db->like('nama', $keyword);
            $this->db->or_like('telepon', $keyword);
            $this->db->or_like('email', $keyword);
            $this->db->group_end();
        }

        $total = $this->db->count_all_results('customers', false);

        $config['base_url'] = site_url('customer/list');
        $config['reuse_query_string'] = true;
        $config['total_rows'] = $total;
        $config['per_page'] = 8;
        $config['uri_segment'] = 3;

        $config['full_tag_open'] = '<nav><ul class="pagination mt-3">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = false;
        $config['last_link']  = false;

        $config['prev_link'] = 'Prev';
        $config['next_link'] = 'Next';

        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';

        $config['attributes'] = ['class'=>'page-link'];

        $this->pagination->initialize($config);

        $page = $this->uri->segment(3);
        if(!$page) $page = 0;

        $this->db->limit($config['per_page'], $page);

        $data['customer'] = $this->db->get()->result();

        // Data tambahan wajib untuk view baru agar tidak Undefined Variable
        $data['page']       = $page; 
        $data['total_rows'] = $total;
        $data['per_page']   = $config['per_page'];

        $data['keyword'] = $keyword;
        $data['paging'] = $this->pagination->create_links();

        $this->load->view('customer/list', $data);
    }


    public function tambah()
    {
        $this->load->view('customer/tambah');
    }

    public function simpan()
    {
        $data = [
            'nama'    => $this->input->post('nama'),
            'telepon' => $this->input->post('telepon'),
            'email'   => $this->input->post('email'),
            'alamat'  => $this->input->post('alamat')
        ];

        $this->db->insert('customers', $data);
        log_activity(
    'CREATE_CUSTOMER',
    'Tambah customer: ' . $data['nama']
);

        redirect('customer/list');
    }



//versilama
// public function hapus($id)
// {
//     $customer = $this->db
//         ->get_where('customers',['id'=>$id])
//         ->row();

//     $nama = $customer ? $customer->nama : 'Unknown';

//     $this->db->delete('customers', ['id'=>$id]);

//     log_activity(
//         'DELETE_CUSTOMER',
//         'Hapus customer: ' . $nama
//     );

//     redirect('customer/list');
// }

    public function hapus($id)
{
    // 🔥 cek apakah dipakai di invoice
    $cek = $this->db
        ->where('customer_id', $id)
        ->count_all_results('invoices');

    // if($cek > 0){
    //     show_error('Customer masih dipakai di invoice', 403);
    // }
    if($cek > 0){
    echo "<script>
        alert('Customer tidak dapat dihapus karena sudah memiliki data invoice');
        window.location.href='".site_url('customer/list')."';
    </script>";
    exit;
}

    $customer = $this->db
        ->get_where('customers',['id'=>$id])
        ->row();

    $nama = $customer ? $customer->nama : 'Unknown';

    $this->db->delete('customers', ['id'=>$id]);

    log_activity(
        'DELETE_CUSTOMER',
        'Hapus customer: ' . $nama
    );

    redirect('customer/list');
}

    public function edit($id)
    {
        $data['customer'] =
            $this->db
            ->get_where('customers',['id'=>$id])
            ->row();

        $this->load->view('customer/edit', $data);
    }

    public function update()
    {
        $id = $this->input->post('id');

        $data = [
            'nama'    => $this->input->post('nama'),
            'telepon' => $this->input->post('telepon'),
            'email'   => $this->input->post('email'),
            'alamat'  => $this->input->post('alamat')
        ];

        $this->db->where('id', $id);
        $this->db->update('customers', $data);
        log_activity(
    'UPDATE_CUSTOMER',
    'Edit customer: ' . $data['nama']
);

        redirect('customer/list');
    }
}