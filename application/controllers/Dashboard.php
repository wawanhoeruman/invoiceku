<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if(!$this->session->userdata('login'))
        {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['nama'] = $this->session->userdata('nama');

        /* Statistik */
        $data['total_customer'] =
            $this->db->count_all('customers');

        $data['total_invoice'] =
            $this->db->count_all('invoices');

        $data['pending'] =
            $this->db
            ->where('status','UNPAID')
            ->count_all_results('invoices');

        $data['paid'] =
            $this->db
            ->where('status','PAID')
            ->count_all_results('invoices');

        $data['overdue'] =
            $this->db
            ->where('status','UNPAID')
            ->where('due_date <', date('Y-m-d'))
            ->count_all_results('invoices');

        /* Omzet dari invoice PAID */
        $this->db->select_sum('grand_total');
        $this->db->where('status','PAID');

        $omzet =
            $this->db
            ->get('invoices')
            ->row()
            ->grand_total;

        if(!$omzet) $omzet = 0;

        $data['omzet'] = $omzet;

        $data['today_invoice'] =
$this->db
->where('tanggal', date('Y-m-d'))
->count_all_results('invoices');

        /* Invoice terbaru */
        $this->db->order_by('id','DESC');
        $this->db->limit(5);

        $data['latest'] =
            $this->db
            ->get('invoices')
            ->result();

        $this->load->view('dashboard', $data);
    }

}