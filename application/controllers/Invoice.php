<?php defined('BASEPATH') or exit('No direct script access allowed');

class Invoice extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('midtrans_m');
    }

    public function index()
    {
        $id = $this->session->userdata('user_id');
        $data['row'] = $this->midtrans_m->get($id);
        $this->template->load('template2', 'tableorder/invoice', $data);
    }
    public function sale_product($payment_id = null)
    {
        $detail = $this->midtrans_m->get_sale_detail($payment_id)->result();
        echo json_encode($detail);
    }
}
