<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dessert extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('item_m');
    }

    public function index()
    {
        $data['row'] = $this->item_m->dessert();
        $this->template->load('template2', 'tableorder/menu_fix', $data);
    }
}
