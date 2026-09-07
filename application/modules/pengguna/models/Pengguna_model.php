<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pengguna_model extends CI_Model
{
    public function all() { return $this->db->order_by('id', 'DESC')->get('users')->result(); }
    public function find($id) { return $this->db->get_where('users', array('id' => $id))->row(); }
    public function username_exists($username, $except = 0) { $this->db->where('username', $username); if ($except) $this->db->where('id !=', $except); return $this->db->count_all_results('users') > 0; }
}
