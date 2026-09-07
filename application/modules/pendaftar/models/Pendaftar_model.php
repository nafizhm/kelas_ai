<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pendaftar_model extends CI_Model { public function all() { return $this->db->order_by('created_at', 'DESC')->get('pendaftar')->result(); } }
