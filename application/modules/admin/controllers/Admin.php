<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends MY_Controller
{
    public function __construct() { parent::__construct(); $this->require_login(); }
    public function index()
    {
        $this->admin_view('dashboard', array('title' => 'Dashboard', 'jumlah_pengguna' => $this->db->count_all('users'), 'jumlah_pendaftar' => $this->db->count_all('pendaftar')));
    }
}
