<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts_receivable extends Admin_controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('accounting/Accounts_receivable_model');
    }

    public function index() {
        $data['items'] = $this->Accounts_receivable_model->get_all();
        $this->load->view('accounting/accounts_receivable/list', $data);
    }

    public function create() {
        if ($this->input->post()) {
            $this->Accounts_receivable_model->insert($this->input->post());
            set_alert('success','Título a receber cadastrado');
            redirect('accounting/accounts_receivable');
        }
        $this->load->view('accounting/accounts_receivable/form');
    }

    public function edit($id) {
        if ($this->input->post()) {
            $this->Accounts_receivable_model->update($id, $this->input->post());
            set_alert('success','Título atualizado');
            redirect('accounting/accounts_receivable');
        }
        $data['item'] = $this->Accounts_receivable_model->get($id);
        $this->load->view('accounting/accounts_receivable/form', $data);
    }

    public function receive($id) {
        $this->Accounts_receivable_model->mark_received($id);
        set_alert('success','Título marcado como recebido');
        redirect('accounting/accounts_receivable');
    }
}