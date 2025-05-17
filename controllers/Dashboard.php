<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends AdminController // corrigido: Admin_controller → AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('accounting/Cash_account_model'); // Certifique-se que o caminho está correto
    }

    public function index()
    {
        $accounts = $this->Cash_account_model->get_all();

        foreach ($accounts as &$a) {
            $a->balance = $this->Cash_account_model->get_balance($a->id);
        }

        $data['accounts'] = $accounts;

        // Renderiza com o template padrão do Perfex CRM
        $data['title'] = _l('accounting_dashboard');
        $this->load->view('accounting/dashboard', $data);
    }
}
