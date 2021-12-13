<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('UserModel');
  }
  public function index()
  {
    $data['title'] = 'Admin';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['detail'] = $this->UserModel->get();
    $data['role'] = $this->UserModel->role();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar');
    $this->load->view('admin/user');
    $this->load->view('templates/footer');
  }

  public function delete($id)
  {
    $this->db->delete('user',['id' => $id]);
    redirect('user');
  }

  public function edit($id)
  {
    $role_id = 0;
    if ($this->input->post('level',true) == "Administrator") {
      $role_id = 1;
    }elseif ($this->input->post('level',true) == "Member") {
      $role_id = 2;
    }

      $data = [
      'name' => $this->input->post('nama',true),
      'email' => $this->input->post('email',true),
      'image' => $this->input->post('foto',true),
      'role_id' => $role_id,
      'is_active' => $this->input->post('status',true)
      ];
      $this->db->update('user',$data,['id'=>$id]);
      // var_dump($this->input->post('foto',true));
      redirect('User');
  }
}
