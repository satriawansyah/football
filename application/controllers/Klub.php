<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Klub extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Klub";
        $data['klub'] = $this->model->klub();
        $this->load->view('header');
        $this->load->view('klub', $data);
    }

    public function input()
    {
        $this->form_validation->set_rules('nm_klub', 'Nama Klub', 'required|is_unique[klub.nm_klub]');
        $this->form_validation->set_rules('kota', 'Kota', 'required');

        if ($this->form_validation->run() === false) {
            $data['title'] = "Klub";
            $this->load->view('header');
            $this->load->view('input_klub', $data);
        } else {
            $data = array(
                'nm_klub' => $this->input->post('nm_klub'),
                'kota' => $this->input->post('kota'),
            );
            $this->model->input_klub($data);
            redirect('klub');
        }
    }
}
