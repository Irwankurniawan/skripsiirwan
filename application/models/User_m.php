<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_m extends CI_Model
{


    public function login($post)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', $post['username']);
        // $this->db->where('password', $post['password']);
        $this->db->where('password', sha1($post['password']));
        $query = $this->db->get();
        return $query;
    }

    public function get($id = null)
    {
        $this->db->from('user');
        if ($id != null) {
            $this->db->where('user_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }



    // public function add($post)
    // {
    //     $params['name'] = $post['fullname'];
    //     $params['username'] = $post['username'];
    //     $params['password'] = sha1($post['password']);
    //     $params['address'] = $post['address'] != "" ? $post['address'] : null;
    //     $params['level'] = $post['level'];
    //     $params['image'] = $post['image'];
    //     $this->db->insert('user', $params);


    //     // $params = [
    //     //     'name' => $post['fullname'],
    //     //     'username' => $post['username'],
    //     //     'password' => $post['password'],
    //     //     'address' => $post['address'] != "" ? $post['address'] : null,
    //     //     'level' => $post['level'],

    //     // ];
    //     // $this->db->insert('user', $params);
    // }

    public function add($post)
    {
        $params = [
            'name' => $post['name'],
            'username' => $post['username'],
            'password' => sha1($post['password']),
            'address' => $post['address'],
            'level' => $post['level'],
            'image' => $post['image'],
        ];
        $this->db->insert('user', $params);
    }


    // public function edit($post)
    // {
    //     $params['name'] = $post['fullname'];
    //     $params['username'] = $post['username'];
    //     if (!empty($post['password'])) {
    //         $params['password'] = sha1($post['password']);
    //     }
    //     $params['address'] = $post['address'] != "" ? $post['address'] : null;
    //     $params['level'] = $post['level'];
    //     $this->db->where('user_id', $post['user_id']);
    //     $this->db->update('user', $params);


    //     // $params = [
    //     //     'name' => $post['fullname'],
    //     //     'username' => $post['username'],
    //     //     'password' => $post['password'],
    //     //     'address' => $post['address'] != "" ? $post['address'] : null,
    //     //     'level' => $post['level'],

    //     //     'updated' => date('Y-m-d H:i:s')
    //     // ];

    //     // $this->db->where('user_id', $post['id']);
    //     // $this->db->update('user', $params);
    // }

    public function edit($post)
    {
        $params = [
            'name' => $post['name'],
            'username' => $post['username'],
            'password' => sha1($post['password']),
            'address' => $post['address'],
            'level' => $post['level'],
            'updated' => date('Y-m-d H:i:s')
        ];
        if ($post['image'] != null) {
            $params['image'] = $post['image'];
        }
        $this->db->where('user_id', $post['user_id']);
        $this->db->update('user', $params);
    }

    public function del($id)
    {
        $this->db->where('user_id', $id);
        $this->db->delete('user');
    }
}
