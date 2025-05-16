<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coa extends Admin_controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('accounting/Coa_model');
    }

    public function index() {
        $data['coas'] = $this->Coa_model->get_all();
        $this->load->view('accounting/coa/list', $data);
    }

    public function create() {
        if ($this->input->post()) {
            $post = $this->input->post();
            $this->Coa_model->insert($post);
            set_alert('success', 'Conta criada com sucesso');
            redirect('accounting/coa');
        }
        $this->load->view('accounting/coa/form');
    }

    public function edit($id) {
        if ($this->input->post()) {
            $post = $this->input->post();
            $this->Coa_model->update($id, $post);
            set_alert('success', 'Conta atualizada com sucesso');
            redirect('accounting/coa');
        }
        $data['coa'] = $this->Coa_model->get($id);
        $this->load->view('accounting/coa/form', $data);
    }

    public function delete($id) {
        $this->Coa_model->delete($id);
        set_alert('success', 'Conta removida');
        redirect('accounting/coa');
    }
}