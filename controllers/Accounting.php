<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Accounting extends AdminController {
    public function __construct() {
        parent::__construct();
        // Carregar database para consultas diretas
        $this->load->database();
    }

    /**
     * Dashboard principal do módulo
     */
    public function index() {
        // Título da página
        $data['title'] = _l('Dashboard de Saldos');

        // Busca todas as contas de caixa e seus saldos
        $data['accounts'] = $this->db
            ->select('name, type, balance')
            ->from(db_prefix() . 'acc_cash_accounts')
            ->get()
            ->result();

        // Carrega view do dashboard
        $this->load->view('accounting/dashboard', $data);
    }

    /**
     * Atalho para /dashboard
     */
    public function dashboard() {
        $this->index();
    }
}