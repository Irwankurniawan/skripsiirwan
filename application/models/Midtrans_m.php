<?php defined('BASEPATH') or exit('No direct script access allowed');

class Midtrans_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('midtrans_payment');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    function add_sale_detail($params)
    {
        $this->db->insert_batch('midtrans_detail', $params);
    }
    public function get_sale_detail($payment_id = null)
    {
        $this->db->from('midtrans_detail');
        $this->db->join('p_item', 'midtrans_detail.item_id = p_item.item_id');
        if ($payment_id != null) {
            $this->db->where('midtrans_detail.sale_id', $payment_id);
        }
        $query = $this->db->get();
        return $query;
    }


    public function getallkeranjang()
    {
        // $this->db->select('*, p_item.name as item_name, t_cart.price as cart_price');
        // $this->db->from('t_cart');
        // $this->db->join('p_item', 't_cart.item_id = p_item.item_id');
        // $query = $this->db->where('user_id', $this->session->userdata('userid'));
        // return $query->result_array();


        $this->db->select('*, p_item.name as item_name, t_cart.price as cart_price')
            ->from('t_cart')
            ->join('p_item', 't_cart.item_id = p_item.item_id')
            ->where('user_id', $this->session->userdata('userid'));
        $query = $this->db->get();
        return $query->result_array();
    }

    function invoice_no()
    {
        $sql = "SELECT MAX(MID(order_id,9,4)) AS invoice_no
                FROM midtrans_payment
                WHERE MID(order_id,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d')";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $n = ((int)$row->invoice_no) + 1;
            $no = sprintf("%'.04d", $n);
        } else {
            $no = "0001";
        }
        $invoice = "PY" . date('ymd') . $no;
        return $invoice;
    }

    public function add_sale($post)
    {
        $params = array(
            'order_id' => $post['invoice'],
            'customer_id' => $post['customer_id'] == "" ? null : $post['customer_id'],
            'note' => $post['note'],
            'gross_amount' => $post['grandtotal'],
            'payment_type' => $post['payment_type'],
            'bank' => $post['bank'],
            'va_number' => $post['va_number'],
            'biller_code' => $post['biller_code'],
            'transaction_status' => $post['transaction_status'],
            'transaction_time' => $post['transaction_time'],
            'pdf_url' => $post['pdf_url'],
            'date_created' => $post['date_created'],
            'date_modified' => $post['date_modified'],


        );
        $this->db->insert('midtrans_payment', $params);
        return $this->db->insert_id();
    }



    public function get_cart($params = null)
    {
        $this->db->select('*, p_item.name as item_name, t_cart.price as cart_price');
        $this->db->from('t_cart');
        $this->db->join('p_item', 't_cart.item_id = p_item.item_id');
        if ($params != null) {
            $this->db->where($params);
        }
        $this->db->where('user_id', $this->session->userdata('userid'));
        $query = $this->db->get();
        return $query;
    }
    public function del_cart($params = null)
    {
        if ($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('t_cart');
    }
    public function cart_del()
    {
        if (isset($_POST['cancel_payment'])) {
            $this->midtrans_m->del_cart(['user_id' => $this->session->userdata('userid')]);
        } else {
            $cart_id = $this->input->post('cart_id');
            $this->midtrans_m->del_cart(['cart_id' => $cart_id]);
        }

        if ($this->db->affected_rows() > 0) {
            $params = array("success" => true);
        } else {
            $params = array("success" => false);
        }
        echo json_encode($params);
    }
}
