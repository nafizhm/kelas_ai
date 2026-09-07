<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pendaftar_model', 'pendaftar');
    }

    public function index() { $this->load->view('index'); }

    public function daftar() { $this->load->view('form'); }

    public function simpan()
    {
        $this->form_validation->set_rules('nama', 'Nama lengkap', 'trim|required|max_length[120]');
        $this->form_validation->set_rules('wa', 'WhatsApp', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[120]');
        $this->form_validation->set_rules('profesi', 'Profesi', 'trim|required|max_length[80]');
        $this->form_validation->set_rules('ide', 'Ide aplikasi', 'trim|required|max_length[2000]');
        $this->form_validation->set_rules('intent', 'Tingkat keseriusan', 'trim|required|max_length[100]');
        if (!$this->form_validation->run()) {
            if ($this->input->is_ajax_request()) {
                return $this->json_response(array(
                    'success' => FALSE,
                    'message' => validation_errors('', '<br>')
                ), 422);
            }

            return $this->load->view('form');
        }

        $nama = $this->input->post('nama', TRUE);
        $this->pendaftar->insert(array(
            'nama' => $nama, 'wa' => $this->input->post('wa', TRUE),
            'email' => $this->input->post('email', TRUE), 'profesi' => $this->input->post('profesi', TRUE),
            'ide' => $this->input->post('ide', TRUE), 'intent' => $this->input->post('intent', TRUE)
        ));

        $pesan = 'Hallo, saya '.$nama.' sudah melakukan registrasi minta diproses ya kak ...';
        $whatsapp_url = 'https://wa.me/6282221992911?text='.rawurlencode($pesan);

        if ($this->input->is_ajax_request()) {
            return $this->json_response(array(
                'success' => TRUE,
                'whatsapp_url' => $whatsapp_url,
                'redirect_url' => base_url()
            ));
        }

        $this->session->set_flashdata('success', 'Pendaftaran berhasil. Terima kasih sudah bergabung!');
        redirect($whatsapp_url);
    }

    private function json_response($data, $status = 200)
    {
        return $this->output
            ->set_status_header($status)
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
}
