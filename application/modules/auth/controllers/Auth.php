<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends MX_Controller
{
    public function login()
    {
        if ($this->session->userdata('admin_logged_in')) redirect('admin');
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            if ($this->form_validation->run()) {
                $user = $this->db->get_where('users', array('username' => $this->input->post('username', TRUE), 'is_active' => 1))->row();
                if ($user && password_verify($this->input->post('password'), $user->password)) {
                    $this->session->sess_regenerate(TRUE);
                    $this->session->set_userdata(array('admin_logged_in' => TRUE, 'user_id' => $user->id, 'username' => $user->username, 'nama' => $user->nama));
                    redirect('admin');
                }
                $data['error'] = 'Username atau password salah.';
            }
        }
        $this->load->view('login', isset($data) ? $data : array());
    }
    public function logout() { $this->session->sess_destroy(); redirect('admin/login'); }
}
