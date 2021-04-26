<?php defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('midtrans_m');
    }

    public function index()
    {
        $data['row'] = $this->midtrans_m->get();
        $this->template->load('template', 'transaction/payment_data', $data);
    }

    public function get($id)
    {
        $this->db->from('midtrans_payment');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
}
