<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    // public function __construct()
    // {
    //     parent::__construct();
    // }
    public function index()
    {
        $data['title'] = "Login";

        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required');
        if ($this->form_validation->run() == FALSE) {

            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {

            $email = $this->input->post('email');
            $db = $this->db->get_where('user', ['email' => $email])->row_array();
            $password = $this->input->post('password');

            if ($db) {
                if (password_verify($password, $db['password'])) {
                    if ($db['is_active'] == 1) {
                        $data = [
                            'email' => $db['email'],
                            'role_id' => $db['role_id']
                        ];
                        $this->session->set_userdata($data);
                        if ($db['role_id'] == 1) {
                            redirect('admin');
                        } else {
                            redirect('user');
                        }
                        var_dump($db);
                    } else {
                        $this->session->set_flashdata('error', 'please activated your account!');
                        redirect('auth');
                    }
                } else {
                    $this->session->set_flashdata('error', 'wrong password!');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('error', "don't have an account?, please register now");
                redirect('auth');
            }
        }
    }

    public function register()
    {
        $data['title'] = "Register";
        $this->load->model('register');

        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]|matches[password_repeat]', [
            'matches' => 'password does not match',
            'min_length' => 'password too short'
        ]);
        $this->form_validation->set_rules('password_repeat', 'Password_repeat', 'required|matches[password]|min_length[3]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/register');
            $this->load->view('templates/auth_footer');
        } else {
            $this->register->insert();
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('success', 'you have been logged out!');
        redirect('auth');
    }
}
