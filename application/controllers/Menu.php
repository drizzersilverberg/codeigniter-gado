<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!is_authenticated()) redirect('auth/login');

        $this->load->model('MenuModel', 'menuModel');
    }

    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'trim|required');

        if ($this->form_validation->run() == false) {
            load_admin_views('menu/index', $data);
        } else {
            $this->db->insert('menu', [
                'menu' => $this->input->post('menu')
            ]);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Menu Added
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');

            redirect('menu');
        }
    }

    public function submenu()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->menuModel->getMenu();
        $data['subMenu'] = $this->menuModel->getSubMenu();

        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('submenu', 'Submenu', 'trim|required');
        $this->form_validation->set_rules('url', 'Url', 'trim|required');
        $this->form_validation->set_rules('icon', 'Icon', 'trim|required');

        if ($this->form_validation->run() == false) {
            load_admin_views('menu/submenu', $data);
        } else {
            $this->db->insert('sub_menu', [
                'menu_id' => $this->input->post('menu_id'),
                'title' => $this->input->post('submenu'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active') !== null ? 1 : 0,
            ]);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Submenu Added
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');

            redirect('menu/submenu');
        }
    }
}
