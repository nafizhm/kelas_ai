<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pendaftar_model extends CI_Model
{
    public function insert($data) { $this->db->insert('pendaftar', $data); return $this->db->insert_id(); }
}
