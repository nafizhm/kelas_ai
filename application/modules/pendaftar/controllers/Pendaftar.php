<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pendaftar extends MY_Controller
{
    public function __construct() { parent::__construct(); $this->require_login(); $this->load->model('Pendaftar_model', 'pendaftar'); }
    public function index() { $this->admin_view('list', array('title' => 'Pendaftar', 'pendaftar' => $this->pendaftar->all())); }
    public function hapus($id) { if ($this->input->method() !== 'post') show_404(); $this->db->delete('pendaftar', array('id' => (int)$id)); $this->session->set_flashdata('success', 'Pendaftar berhasil dihapus.'); redirect('admin/pendaftar'); }
}
