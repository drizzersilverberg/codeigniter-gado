<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
    }

    public function login()
    {
        $data['title'] = 'Codeigniter Gado | Login';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/login');
        $this->load->view('templates/auth_footer');
    }

    public function register()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[password_confirm]', [
            'required' => 'Password can\'t blank',
            'min_length' => 'Password must more 3 chars',
            'matches' => 'Passwords not match',
            'is_unique' => 'Email was taken',
        ]);
        $this->form_validation->set_rules('password_confirm', 'Password', 'required|trim|matches[password]', [
            'required' => 'Password can\'t blank',
            'min_length' => 'Password must more 3 chars',
            'matches' => 'Passwords not match',
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Codeigniter Gado | Register';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/register');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id' => 2, // member
                'is_active' => 1,
                'created_date' => time(),
            ];

            $this->db->insert('users', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Register was success. Please login.</div>');
            redirect('auth/login');
        }
    }
}
