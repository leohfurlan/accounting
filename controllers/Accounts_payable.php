<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts_payable extends Admin_controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('accounting/Accounts_payable_model');
    }

    public function index() {
        $data['items'] = $this->Accounts_payable_model->get_all();
        $this->load->view('accounting/accounts_payable/list', $data);
    }

    public function create() {
        if ($this->input->post()) {
            $this->Accounts_payable_model->insert($this->input->post());
            set_alert('success','Título a pagar cadastrado');
            redirect('accounting/accounts_payable');
        }
        $this->load->view('accounting/accounts_payable/form');
    }

    public function edit($id) {
        if ($this->input->post()) {
            $this->Accounts_payable_model->update($id, $this->input->post());
            set_alert('success','Título atualizado');
            redirect('accounting/accounts_payable');
        }
        $data['item'] = $this->Accounts_payable_model->get($id);
        $this->load->view('accounting/accounts_payable/form', $data);
    }

    public function pay($id) {
        $this->Accounts_payable_model->mark_paid($id);
        set_alert('success','Título marcado como pago');
        redirect('accounting/accounts_payable');
    }
}