<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller
{
    protected function require_login()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu.');
            redirect('admin/login');
        }
    }

    protected function admin_view($view, $data = array())
    {
        $data['content_view'] = $view;
        $this->load->view('admin/template', $data);
    }
}
