<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

if(!$this->session->userdata('login')){
    redirect('auth');
}

        $this->load->database();
    }

public function index()
{
    $this->load->library('pagination');

    $keyword = $this->input->get('keyword');
    $dari    = $this->input->get('dari');
    $sampai  = $this->input->get('sampai');

    /* =========================
       COUNT DATA
    ========================== */
    $this->db->from('logs');

    if($keyword){
        $this->db->group_start();
        $this->db->like('activity', $keyword);
        $this->db->or_like('description', $keyword);
        $this->db->group_end();
    }

    if($dari){
        $this->db->where('DATE(created_at) >=', $dari);
    }

    if($sampai){
        $this->db->where('DATE(created_at) <=', $sampai);
    }

    $config['total_rows'] = $this->db->count_all_results();

    /* =========================
       CONFIG PAGINATION
    ========================== */
    $config['base_url'] = site_url('history/index');
    $config['per_page'] = 10;
    $config['reuse_query_string'] = true;
    $config['uri_segment'] = 3;

    // style biar sama invoice
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

    $config['cur_tag_open'] =
    '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close'] =
    '</span></li>';

    $config['attributes'] = ['class'=>'page-link'];

    $this->pagination->initialize($config);

    $page = $this->uri->segment(3);
    if(!$page) $page = 0;

    /* =========================
       GET DATA
    ========================== */
    $this->db->select('logs.*, users.nama as user_nama');
    $this->db->from('logs');
    $this->db->join('users', 'users.id = logs.user_id', 'left');

    if($keyword){
        $this->db->group_start();
        $this->db->like('activity', $keyword);
        $this->db->or_like('description', $keyword);
        $this->db->group_end();
    }

    if($dari){
        $this->db->where('DATE(logs.created_at) >=', $dari);
    }

    if($sampai){
        $this->db->where('DATE(logs.created_at) <=', $sampai);
    }

    $this->db->order_by('logs.created_at','DESC');
    $this->db->limit($config['per_page'], $page);

    $data['logs'] = $this->db->get()->result();
    $data['pagination'] = $this->pagination->create_links();

    $data['keyword'] = $keyword;
    $data['dari']    = $dari;
    $data['sampai']  = $sampai;

    $this->load->view('history/index', $data);
}

public function hapus($id)
{
    $this->db->delete('logs', ['id' => $id]);

    redirect('history');
}

}