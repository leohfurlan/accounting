<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('accounting/Cash_account_model');
    }

    public function index() {
        $accounts = $this->Cash_account_model->get_all();
        foreach ($accounts as &$a) {
            $a->balance = $this->Cash_account_model->get_balance($a->id);
        }
        $data['accounts'] = $accounts;
        $this->load->view('accounting/dashboard', $data);
    }
}