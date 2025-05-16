<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cash_accounts extends Admin_controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('accounting/Cash_account_model');
    }

    public function index() {
        $data['accounts'] = $this->Cash_account_model->get_all();
        $this->load->view('accounting/cash_accounts/list', $data);
    }

    public function create() {
        if ($this->input->post()) {
            $this->Cash_account_model->insert($this->input->post());
            set_alert('success','Conta de caixa/banco criada');
            redirect('accounting/cash_accounts');
        }
        $this->load->view('accounting/cash_accounts/form');
    }

    public function edit($id) {
        if ($this->input->post()) {
            $this->Cash_account_model->update($id,$this->input->post());
            set_alert('success','Conta atualizada');
            redirect('accounting/cash_accounts');
        }
        $data['account'] = $this->Cash_account_model->get($id);
        $this->load->view('accounting/cash_accounts/form', $data);
    }

    public function delete($id) {
        $this->Cash_account_model->delete($id);
        set_alert('success','Conta removida');
        redirect('accounting/cash_accounts');
    }
}