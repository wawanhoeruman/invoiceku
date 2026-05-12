<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if(!$this->session->userdata('login')){
            redirect('auth');
        }
    }

public function index()
{
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

    $this->load->view('invoice/menu', $data);
}

public function create()
{
    $data['customer'] = $this->db->get('customers')->result();

    $data['nomor_invoice'] = 'INV-' . date('Ymd-His');

    $this->load->view('invoice/form', $data);
}

    public function simpan()
    {
        $data = [
            'nomor_invoice' => $this->input->post('nomor_invoice'),
            'customer_id'   => $this->input->post('customer_id'),
            'tanggal'       => $this->input->post('tanggal'),
            'due_date'      => $this->input->post('due_date'),
            'status'        => 'UNPAID',
            'grand_total'   => 0
        ];

$this->db->insert('invoices', $data);

$id_invoice = $this->db->insert_id();
log_activity(
    'CREATE_INVOICE',
    'Buat invoice: ' . $data['nomor_invoice']
);

redirect('invoice/items/'.$id_invoice);
    }

//ini yang lama ada bug
// public function items($id)
// {
//     $this->db->select('invoices.*, customers.nama');
//     $this->db->from('invoices');
//     $this->db->join('customers', 'customers.id = invoices.customer_id');
//     $this->db->where('invoices.id', $id);

//     $data['invoice'] = $this->db->get()->row();

//     $data['items'] = $this->db
//         ->get_where('invoice_items', ['invoice_id'=>$id])
//         ->result();

//     $this->load->view('invoice/items', $data);
// }
    public function items($id)
{
    $this->db->select('invoices.*, customers.nama');
    $this->db->from('invoices');
    $this->db->join('customers', 'customers.id = invoices.customer_id', 'left'); // 🔥 FIX
    $this->db->where('invoices.id', $id);

    $invoice = $this->db->get()->row();

    // kalau invoice memang tidak ada
    if(!$invoice){
        show_error('Invoice tidak ditemukan', 404);
    }

    $data['invoice'] = $invoice; // 🔥 WAJIB

    $data['items'] = $this->db
        ->get_where('invoice_items', ['invoice_id'=>$id])
        ->result();

    $this->load->view('invoice/items', $data);
}

public function tambah_item()
{
    $invoice_id = $this->input->post('invoice_id');

    $cek = $this->db->get_where('invoices', [
        'id' => $invoice_id
    ])->row();

    if($cek && $cek->status == 'PAID'){
        redirect('invoice/items/'.$invoice_id);
    }

    $qty   = $this->input->post('qty');
    $harga = $this->input->post('harga');

    $subtotal = $qty * $harga;

    $data = [
        'invoice_id' => $invoice_id,
        'nama_item'  => $this->input->post('nama_item'),
        'qty'        => $qty,
        'harga'      => $harga,
        'subtotal'   => $subtotal
    ];

    $this->db->insert('invoice_items', $data);

    $this->db->select_sum('subtotal');
    $total = $this->db->get_where('invoice_items', [
        'invoice_id'=>$invoice_id
    ])->row()->subtotal;

    if(!$total) $total = 0;

    $this->db->where('id', $invoice_id);
    $this->db->update('invoices', [
        'grand_total'=>$total
    ]);
$inv = $this->db->get_where('invoices',['id'=>$invoice_id])->row();

log_activity(
    'ADD_ITEM',
    'Tambah item ke invoice: ' . $inv->nomor_invoice
);

    redirect('invoice/items/'.$invoice_id);
}

public function hapus_item($id, $invoice_id)
{
    $cek = $this->db->get_where('invoices', [
        'id'=>$invoice_id
    ])->row();

    if($cek && $cek->status == 'PAID'){
        redirect('invoice/items/'.$invoice_id);
    }

    $this->db->delete('invoice_items', ['id'=>$id]);

    $this->db->select_sum('subtotal');
    $total = $this->db->get_where('invoice_items', [
        'invoice_id'=>$invoice_id
    ])->row()->subtotal;

    if(!$total) $total = 0;

    $this->db->where('id', $invoice_id);
    $this->db->update('invoices', [
        'grand_total'=>$total
    ]);
    // hanya hapus item saja
$this->db->delete('invoice_items', ['id'=>$id]);

log_activity(
    'DELETE_ITEM',
    'Hapus item dari invoice ID: ' . $invoice_id
);
//versi lama
// $cek = $this->db->get_where('invoices',['id'=>$id])->row();

// $nomor = $cek->nomor_invoice;

// $this->db->delete('invoice_items', ['invoice_id'=>$id]);
// $this->db->delete('invoices', ['id'=>$id]);

// log_activity(
//     'DELETE_INVOICE',
//     'Hapus invoice: ' . $nomor
// );

    redirect('invoice/items/'.$invoice_id);
}

public function edit_item($id)
{
    $data['item'] = $this->db->get_where('invoice_items', [
        'id' => $id
    ])->row();

    if(!$data['item']){
        redirect('invoice/list');
    }

    $data['invoice'] = $this->db->get_where('invoices', [
        'id' => $data['item']->invoice_id
    ])->row();

    // kalau invoice PAID, blok edit
    if($data['invoice']->status == 'PAID'){
        redirect('invoice/items/'.$data['invoice']->id);
    }

    $this->load->view('invoice/edit_item', $data);
}

public function update_item()
{
    $id         = $this->input->post('id');
    $invoice_id = $this->input->post('invoice_id');

    // cek invoice
    $invoice = $this->db->get_where('invoices', [
        'id' => $invoice_id
    ])->row();

    if(!$invoice){
        redirect('invoice/list');
    }

    // blok kalau PAID
    if($invoice->status == 'PAID'){
        redirect('invoice/items/'.$invoice_id);
    }

    $qty   = $this->input->post('qty');
    $harga = $this->input->post('harga');

    $subtotal = $qty * $harga;

    $this->db->where('id', $id);
    $this->db->update('invoice_items', [
        'nama_item' => $this->input->post('nama_item'),
        'qty'       => $qty,
        'harga'     => $harga,
        'subtotal'  => $subtotal
    ]);

    // update grand total invoice
    $this->db->select_sum('subtotal');
    $total = $this->db->get_where('invoice_items', [
        'invoice_id' => $invoice_id
    ])->row()->subtotal;

    if(!$total) $total = 0;

    $this->db->where('id', $invoice_id);
    $this->db->update('invoices', [
        'grand_total' => $total
    ]);
    log_activity(
    'UPDATE_ITEM',
    'Edit item invoice ID: ' . $invoice_id
);

    redirect('invoice/items/'.$invoice_id);
}

// public function list()
// {
//     $this->load->library('pagination');

//     $keyword = trim($this->input->get('keyword'));
//     $dari    = $this->input->get('dari');
//     $sampai  = $this->input->get('sampai');

//     // --- LOGIKA FILTER (Sama untuk Count & Ambil Data) ---
//     $this->apply_invoice_filters($keyword, $dari, $sampai);

//     $this->db->from('invoices');
//     $this->db->join('customers', 'customers.id = invoices.customer_id', 'left');
//     $config['total_rows'] = $this->db->count_all_results();

//     // --- CONFIG PAGINATION ---
//     $config['base_url'] = site_url('invoice/list');
//     $config['reuse_query_string'] = true;
//     $config['per_page'] = 5;
//     $config['uri_segment'] = 3;
//     $config['full_tag_open'] = '<nav><ul class="pagination mt-2 ml-3">';
//     $config['full_tag_close'] = '</ul></nav>';
//     $config['attributes'] = ['class'=>'page-link'];
//     $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
//     $config['cur_tag_close'] = '</span></li>';
//     $config['num_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = '<li class="page-item">';
//     $config['num_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = '</li>';

//     $this->pagination->initialize($config);
//     $page = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

//     // --- AMBIL DATA ---
//     $this->db->select('invoices.*, customers.nama');
//     $this->apply_invoice_filters($keyword, $dari, $sampai);
//     $this->db->from('invoices');
//     $this->db->join('customers', 'customers.id = invoices.customer_id', 'left');
//     $this->db->order_by('invoices.id','DESC');
//     $this->db->limit($config['per_page'], $page);

//     $data['invoice'] = $this->db->get()->result();
//     $data['pagination'] = $this->pagination->create_links();
//     $data['keyword'] = $keyword;
//     $data['dari'] = $dari;
//     $data['sampai'] = $sampai;

//     $this->load->view('invoice/list', $data);
// }

// // Tambahkan fungsi pembantu ini di bawah fungsi list atau di paling bawah class sebelum tanda }
// private function apply_invoice_filters($keyword, $dari, $sampai)
// {
//     if($keyword){
//         $this->db->group_start();
        
//         if(strcasecmp($keyword, 'overdue') == 0){
//             // Khusus Overdue: Unpaid DAN sudah lewat tanggal
//             $this->db->where('invoices.status', 'UNPAID');
//             $this->db->where('invoices.due_date <', date('Y-m-d'));
//             $this->db->where('invoices.due_date !=', '0000-00-00');
//         } elseif(strcasecmp($keyword, 'unpaid') == 0){
//             // Khusus Unpaid murni: Unpaid DAN BELUM lewat tanggal
//             $this->db->where('invoices.status', 'UNPAID');
//             $this->db->group_start();
//                 $this->db->where('invoices.due_date >=', date('Y-m-d'));
//                 $this->db->or_where('invoices.due_date', '0000-00-00');
//                 $this->db->or_where('invoices.due_date', NULL);
//             $this->db->group_end();
//         } elseif(strcasecmp($keyword, 'paid') == 0){
//             // Khusus Paid
//             $this->db->where('invoices.status', 'PAID');
//         } else {
//             // Pencarian nama atau nomor invoice
//             $this->db->like('invoices.nomor_invoice', $keyword);
//             $this->db->or_like('customers.nama', $keyword);
//         }
        
//         $this->db->group_end();
//     }

//     if($dari)   $this->db->where('invoices.tanggal >=', $dari);
//     if($sampai) $this->db->where('invoices.tanggal <=', $sampai);
// }


public function list()
{
    $this->load->library('pagination');

    $keyword = $this->input->get('keyword');
    $dari    = $this->input->get('dari');
    $sampai  = $this->input->get('sampai');

    /* COUNT DATA */
    $this->db->select('invoices.id');
    $this->db->from('invoices');
    $this->db->join('customers', 'customers.id = invoices.customer_id', 'left');

    // if($keyword){
    //     $this->db->group_start();
    //     $this->db->like('nomor_invoice', $keyword);
    //     $this->db->or_like('customers.nama', $keyword);
    //     $this->db->or_where('status', strtoupper($keyword));
    //     $this->db->group_end();
    // }
if($keyword){
    $keyword = trim($keyword);
    $this->db->group_start();
    
    // Gunakan strcasecmp agar 'overdue' atau 'OVERDUE' sama saja
    if(strcasecmp($keyword, 'overdue') == 0){
        // Kita sebutkan nama tabelnya: invoices.status dan invoices.due_date
        $this->db->where('invoices.status', 'UNPAID');
        $this->db->where('invoices.due_date <', date('Y-m-d'));
        $this->db->where('invoices.due_date !=', '0000-00-00');
        $this->db->where('invoices.due_date IS NOT NULL');
    } else {
        $this->db->like('invoices.nomor_invoice', $keyword);
        $this->db->or_like('customers.nama', $keyword);
        $this->db->or_where('invoices.status', strtoupper($keyword));
    }
    
    $this->db->group_end();
}

    if($dari){
        $this->db->where('tanggal >=', $dari);
    }

    if($sampai){
        $this->db->where('tanggal <=', $sampai);
    }

    $config['total_rows'] = $this->db->count_all_results();

    $config['base_url'] = site_url('invoice/list');
    $config['reuse_query_string'] = true;
    $config['per_page'] = 5;
    $config['uri_segment'] = 3;

    $config['full_tag_open'] =
    '<nav><ul class="pagination mt-2 ml-3">';
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
    $config['cur_tag_close'] = '</span></li>';

    $config['attributes'] = ['class'=>'page-link'];

    $this->pagination->initialize($config);

    $page = $this->uri->segment(3);
    if(!$page) $page = 0;

    /* DATA */
    $this->db->select('invoices.*, customers.nama');
    $this->db->from('invoices');
    $this->db->join('customers', 'customers.id = invoices.customer_id', 'left');

    if($keyword){
        $this->db->group_start();
        $this->db->like('nomor_invoice', $keyword);
        $this->db->or_like('customers.nama', $keyword);
        $this->db->or_where('status', strtoupper($keyword));
        $this->db->group_end();
    }

    if($dari){
        $this->db->where('tanggal >=', $dari);
    }

    if($sampai){
        $this->db->where('tanggal <=', $sampai);
    }

    $this->db->order_by('invoices.id','DESC');
    $this->db->limit($config['per_page'], $page);

    $data['invoice'] = $this->db->get()->result();
    $data['pagination'] = $this->pagination->create_links();

    $data['keyword'] = $keyword;
    $data['dari'] = $dari;
    $data['sampai'] = $sampai;

    $this->load->view('invoice/list', $data);
}

public function hapus($id)
{
    $cek = $this->db->get_where('invoices', [
        'id'=>$id
    ])->row();

    if($cek && $cek->status == 'PAID'){
        redirect('invoice/list');
    }
    $nomor = $cek->nomor_invoice;

    $this->db->delete('invoice_items', ['invoice_id'=>$id]);
    $this->db->delete('invoices', ['id'=>$id]);

    log_activity(
    'DELETE_INVOICE',
    'Hapus invoice: ' . $nomor
);
    redirect('invoice/list');
}

public function pdf($id)
{
    require_once APPPATH . '../vendor/autoload.php';

    $this->db->select('invoices.*, customers.nama, customers.alamat, customers.telepon');
    $this->db->from('invoices');
//versilama
    // $this->db->join('customers', 'customers.id = invoices.customer_id');
    $this->db->join('customers', 'customers.id = invoices.customer_id', 'left');
    $this->db->where('invoices.id', $id);

    $data['invoice'] = $this->db->get()->row();

    $data['items'] = $this->db
        ->get_where('invoice_items', ['invoice_id'=>$id])
        ->result();

    $html = $this->load->view('invoice/pdf', $data, true);

    $options = new Dompdf\Options();
    $options->set('isRemoteEnabled', true);
    $options->set('chroot', FCPATH);

    $dompdf = new Dompdf\Dompdf($options);

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $dompdf->stream("invoice.pdf", array("Attachment"=>false));
}

public function paid($id)
{
    // ambil data dulu
    $invoice = $this->db->get_where('invoices', [
        'id' => $id
    ])->row();

    $this->db->where('id', $id);
    $this->db->update('invoices', [
        'status'  => 'PAID',
        'paid_at' => date('Y-m-d H:i:s')
    ]);

    // ✅ FIX + LOG
log_activity(
    'PAID_INVOICE',
    'Invoice dibayar: ' . $invoice->nomor_invoice
);

    redirect('invoice/items/'.$id);
}

public function export()
{
    $keyword = $this->input->get('keyword');
    $dari    = $this->input->get('dari');
    $sampai  = $this->input->get('sampai');

    $this->db->select('invoices.*, customers.nama');
    $this->db->from('invoices');
    $this->db->join('customers', 'customers.id = invoices.customer_id', 'left');

    if($keyword){
        $this->db->group_start();
        $this->db->like('nomor_invoice', $keyword);
        $this->db->or_like('customers.nama', $keyword);
        $this->db->or_where('status', strtoupper($keyword));
        $this->db->group_end();
    }
// if($keyword){
//     $keyword = trim($keyword);
//     $this->db->group_start();
    
//     // Gunakan strcasecmp agar 'overdue' atau 'OVERDUE' sama saja
//     if(strcasecmp($keyword, 'overdue') == 0){
//         // Kita sebutkan nama tabelnya: invoices.status dan invoices.due_date
//         $this->db->where('invoices.status', 'UNPAID');
//         $this->db->where('invoices.due_date <', date('Y-m-d'));
//         $this->db->where('invoices.due_date !=', '0000-00-00');
//         $this->db->where('invoices.due_date IS NOT NULL');
//     } else {
//         $this->db->like('invoices.nomor_invoice', $keyword);
//         $this->db->or_like('customers.nama', $keyword);
//         $this->db->or_where('invoices.status', strtoupper($keyword));
//     }
    
//     $this->db->group_end();
// }


    if($dari){
        $this->db->where('tanggal >=', $dari);
    }

    if($sampai){
        $this->db->where('tanggal <=', $sampai);
    }

    $this->db->order_by('invoices.id','DESC');

    $data = $this->db->get()->result();

    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=laporan_invoice.csv");

    echo "No Invoice,Customer,Tanggal,Status,Total\n";

    foreach($data as $r){

        echo $r->nomor_invoice.",";
        echo $r->nama.",";
        echo $r->tanggal.",";
        echo $r->status.",";
        echo $r->grand_total."\n";

    }
}

}