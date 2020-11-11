<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Codeigniter Gado | Admin Dashboard';
        $this->load_views('admin/index', $data);
    }

    private function load_views($content_template, $data = [])
    {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/pre-content');
        $this->load->view($content_template);
        $this->load->view('templates/post-content');
        $this->load->view('templates/footer');
    }
}
