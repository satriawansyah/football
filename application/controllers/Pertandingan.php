<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pertandingan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Input Skor Pertandingan";
        $data['pertandingan'] = $this->model->pertandingan();
        $this->load->view('header');
        $this->load->view('pertandingan', $data);
    }

    public function input()
    {
        $this->form_validation->set_rules(
            'klub1[]',
            'Klub 1',
            'required'
        );
        $this->form_validation->set_rules(
            'klub2[]',
            'Klub 2',
            'required'
        );
        $this->form_validation->set_rules(
            'score1[]',
            'Score 1',
            'required|numeric'
        );
        $this->form_validation->set_rules(
            'score2[]',
            'Score 2',
            'required|numeric'
        );

        if ($this->form_validation->run() === FALSE) {
            $data['title'] = "Input Skor Pertandingan";
            $data['klub'] = $this->model->klub();
            $this->load->view('header');
            $this->load->view('input_pertandingan', $data);
        } else {
            $klub1 = $this->input->post('klub1');
            $klub2 = $this->input->post('klub2');
            $score1 = $this->input->post('score1');
            $score2 = $this->input->post('score2');

            $uniqueMatches = $this->model->cek_match($klub1, $klub2);

            if ($uniqueMatches) {
                foreach ($klub1 as $key => $value) {
                    if ($score1[$key] > $score2[$key]) {
                        $winner = 1;
                    } elseif ($score1[$key] < $score2[$key]) {
                        $winner = 2;
                    } elseif ($score1[$key] = $score2[$key]) {
                        $winner = 0;
                    }

                    $data = array(
                        'klub1' => $klub1[$key],
                        'klub2' => $klub2[$key],
                        'score1' => $score1[$key],
                        'score2' => $score2[$key],
                        'winner' => $winner,
                    );

                    $this->model->input_pertandingan($data);
                }

                redirect('pertandingan');
            } else {
                redirect('input_pertandingan');
                echo "<script>alert('Pertandingan dengan klub yang sama tidak diizinkan');</script>";
            }
        }
    }
}
