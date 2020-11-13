<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!is_authenticated()) redirect('auth/login');
    }

    public function index()
    {

        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Dashboard';
        load_admin_views('admin/index', $data);
    }
}
