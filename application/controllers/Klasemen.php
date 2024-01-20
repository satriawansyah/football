<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Klasemen extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('model');
    }

    public function index()
    {
        $data['title'] = "Klasemen";
        $data['klasemen'] = $this->model->klasemen();
        $this->load->view('header');
        $this->load->view('klasemen', $data);
    }
}
