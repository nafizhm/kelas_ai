<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pengguna extends MY_Controller
{
    public function __construct() { parent::__construct(); $this->require_login(); $this->load->model('Pengguna_model', 'pengguna'); }
    public function index() { $this->admin_view('list', array('title' => 'Pengguna', 'users' => $this->pengguna->all())); }
    public function tambah() { $this->save(); }
    public function edit($id) { $this->save((int)$id); }
    private function save($id = 0)
    {
        $user = $id ? $this->pengguna->find($id) : NULL; if ($id && !$user) show_404();
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[120]');
            $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[60]');
            if (!$id) $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            if ($this->form_validation->run()) {
                $username = $this->input->post('username', TRUE);
                if ($this->pengguna->username_exists($username, $id)) $data['error'] = 'Username sudah digunakan.';
                else {
                    $row = array('nama' => $this->input->post('nama', TRUE), 'username' => $username, 'role' => $this->input->post('role', TRUE) === 'admin' ? 'admin' : 'staff', 'is_active' => $this->input->post('is_active') ? 1 : 0);
                    if ($this->input->post('password')) $row['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                    if ($id) $this->db->update('users', $row, array('id' => $id)); else $this->db->insert('users', $row);
                    $this->session->set_flashdata('success', 'Data pengguna berhasil disimpan.'); redirect('admin/pengguna');
                }
            }
        }
        $this->admin_view('form', array('title' => $id ? 'Edit Pengguna' : 'Tambah Pengguna', 'user' => $user, 'error' => isset($data['error']) ? $data['error'] : NULL));
    }
    public function hapus($id)
    {
        if ($this->input->method() !== 'post') show_404();
        if ((int)$id === (int)$this->session->userdata('user_id')) { $this->session->set_flashdata('error', 'Akun yang sedang dipakai tidak dapat dihapus.'); }
        else { $this->db->delete('users', array('id' => (int)$id)); $this->session->set_flashdata('success', 'Pengguna berhasil dihapus.'); }
        redirect('admin/pengguna');
    }
}
