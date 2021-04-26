<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_admin();
        $this->load->model('user_m');
        $this->load->library('form_validation');
    }
    public function index()
    {
        check_not_login();
        $this->load->model('user_m');
        $data['row'] = $this->user_m->get();
        $this->template->load('template', 'user/user_data', $data);
    }

    public function add()
    {
        $item = new stdClass();
        $item->user_id = null;
        $item->username = null;
        $item->name = null;
        $item->password = null;
        $item->address = null;
        $item->level = null;
        $item->image = null;

        $data = array(
            'page' => 'add',
            'row' => $item,
        );
        $this->template->load('template', 'user/user_form', $data);
    }


    public function edit($id)
    {
        $query = $this->user_m->get($id);
        if ($query->num_rows() > 0) {
            $item = $query->row();

            $data = array(
                'page' => 'edit',
                'row' => $item,
            );
            $this->template->load('template', 'user/user_form', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan');";
            echo "window.location='" . site_url('item') . "';</script>";
        }
    }

    public function process()
    {
        $config['upload_path']    = './uploads/user/';
        $config['allowed_types']  = 'gif|jpg|png|jpeg';
        $config['max_size']       = 2048;
        $config['file_name']      = 'user-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);

        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            if (@$_FILES['image']['name'] != null) {
                if ($this->upload->do_upload('image')) {
                    $post['image'] = $this->upload->data('file_name');
                    $this->user_m->add($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data berhasil disimpan');
                    }
                    redirect('user');
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect('user/add');
                }
            } else {
                $post['image'] = null;
                $this->user_m->add($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data berhasil disimpan');
                }
                redirect('user');
            }
        } else if (isset($_POST['edit'])) {
            if (@$_FILES['image']['name'] != null) {
                if ($this->upload->do_upload('image')) {

                    $item = $this->user_m->get($post['user_id'])->row();
                    if ($item->image != null) {
                        $target_file = './uploads/user/' . $item->image;
                        unlink($target_file);
                    }

                    $post['image'] = $this->upload->data('file_name');
                    $this->user_m->edit($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data berhasil disimpan');
                    }
                    redirect('user');
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect('user/add');
                }
            } else {
                $post['image'] = null;
                $this->user_m->edit($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data berhasil disimpan');
                }
                redirect('user');
            }
        }
    }





    function username_check()
    {
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM user WHERE username = '$post[username]' AND user_id !='$post[user_id]'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('username_check', '%s ini sudah dipakai, silahkan ganti');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function del()
    {
        $id = $this->input->post('user_id');
        $this->user_m->del($id);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Berhasil dihapus');
        }
        redirect('user');
    }
}
