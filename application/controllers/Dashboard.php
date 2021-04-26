<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function index()
	{
		check_not_login();
		$query = $this->db->query("SELECT t_sale_detail.item_id, p_item.name,(SELECT SUM(t_sale_detail.qty)) AS sold
		FROM t_sale_detail
		INNER JOIN t_sale ON t_sale_detail.sale_id = t_sale.sale_id
		INNER JOIN p_item ON t_sale_detail.item_id = p_item.item_id
		WHERE MID(t_sale.date, 6, 2) = DATE_FORMAT(CURDATE(), '%m')
		GROUP BY t_sale_detail.item_id
		ORDER BY sold DESC
		LIMIT 10");
		$data['row'] = $query->result();
		$this->template->load('template', 'dashboard', $data);
	}
}
