<?php
class UserModel extends CI_Model
{
  public function get()
  {
    return $this->db->get('user')->result_array();
  }
  public function role()
  {
    return $this->db->get('user_role')->result_array();
  }
}
