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
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() === false) {
            $data['title'] = 'Codeigniter Gado | Login';
            $this->load_views('auth/login', $data);
        } else {
            // echo 'login successful';
            $this->_login();
        }
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
            $this->load_views('auth/register', $data);
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name')),
                'email' => htmlspecialchars($this->input->post('email')),
                'image' => 'default.png',
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

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('name');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out.</div>');
        redirect('auth/login');
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('users', ['email' => $email])->row_array();
        // var_dump($user);die;

        if ($user) {
            if ((int) $user['is_active'] === 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'name' => $user['name'],
                        'role_id' => $user['role_id'],
                    ];

                    $this->session->set_userdata($data);

                    if ((int) $data['role_id'] === 1) {
                        redirect('admin');
                    } else {
                        redirect('member');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password not correct.</div>');
                    redirect('auth/login');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">User not active.</div>');
                redirect('auth/login');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email not found.</div>');
            redirect('auth/login');
        }
    }

    private function load_views($content_template, $data = [])
    {
        $this->load->view('templates/header', $data);
        $this->load->view($content_template);
        $this->load->view('templates/footer');
    }
}
