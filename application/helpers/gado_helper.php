<?php

/**
 * Check if user is authenticated in the session
 * 
 * @return boolean
 */
function is_authenticated()
{
    $ci = get_instance();
    return ($ci->session->userdata('email') !== null && !empty($ci->session->userdata('email'))) ? true : false;
}

/**
 * Redirect user to their respective default page
 * 
 * @return void
 */
function role_redirect()
{
    $ci = get_instance();

    if ($ci->session->userdata('role_id') !== null) {
        if ((int) $ci->session->userdata('role_id') === 1) {
            redirect('admin');
        } else {
            redirect('member');
        }
    } else {
        redirect('auth/login');
    }
}

/**
 * Load the basic views for a content
 * 
 * @param string $content_template
 * @param array $data (optional) []
 * 
 * @return void
 */
function load_views($content_template, $data = [])
{
    $ci = get_instance();
    $ci->load->view('templates/header', $data);
    $ci->load->view($content_template);
    $ci->load->view('templates/footer');
}

/**
 * Load the admin UI views for a content
 * 
 * @param string $content_template
 * @param array $data (optional) []
 * 
 * @return void
 */
function load_admin_views($content_template, $data = [])
{
    $ci = get_instance();
    $ci->load->view('templates/header', $data);
    $ci->load->view('templates/pre-content');
    $ci->load->view($content_template);
    $ci->load->view('templates/post-content');
    $ci->load->view('templates/footer');
}

/**
 * Redirect user to login page
 * 
 * @return void
 */
function redirect_to_login_page()
{
    redirect('auth/login');
}
