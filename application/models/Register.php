<?php
class Register extends CI_Model
{
  public function insert()
  {
    $data = [
      'name' => htmlspecialchars($this->input->post('name', true)),
      'email' => htmlspecialchars($this->input->post('email', true)),
      'image' => 'default.jpg',
      'password' => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
      'role_id' => 2,
      'is_active' => 0,
      'date_created' => time()
    ];

    $this->db->insert('user', $data);
    $this->session->set_flashdata('success', 'account successfully created!');
    redirect('auth');
  }
}
