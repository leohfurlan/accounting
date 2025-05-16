<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Journal extends Admin_controller {
    public function __construct() {
        parent::__construct();
        // Carregar models necessários
        $this->load->model('accounting/Journal_model');
        $this->load->model('accounting/Coa_model');
        $this->load->model('clients_model');
        $this->load->model('projects_model');
    }

    // Listagem de lançamentos
    public function index() {
        // Checar permissão
        if (!has_permission('accounting', '', 'viewAccounting')) {
            access_denied('viewAccounting');
        }
        $data['entries'] = $this->Journal_model->get_all_entries();
        $this->load->view('accounting/journal/list', $data);
    }

    // Criar novo lançamento
    public function create() {
        if (!has_permission('accounting', '', 'createAccounting')) {
            access_denied('createAccounting');
        }
        if ($this->input->post()) {
            $post = $this->input->post();
            // Cliente e projeto
            $entry_data = [
                'date'        => $post['date'],
                'description' => $post['description'],
                'client_id'   => $post['client_id'] ?: null,
                'project_id'  => $post['project_id'] ?: null,
            ];
            // Validação de partidas dobradas
            $total_debit  = array_sum(array_column($post['lines'], 'debit'));
            $total_credit = array_sum(array_column($post['lines'], 'credit'));
            if ($total_debit !== $total_credit) {
                set_alert('danger', 'Débito e crédito devem ser iguais');
                redirect('accounting/journal/create');
            }
            // Inserir lançamento
            $this->Journal_model->insert_entry($entry_data, $post['lines']);
            set_alert('success', 'Lançamento criado com sucesso');
            redirect('accounting/journal');
        }
        // Dados para formulário
        $data['accounts']  = $this->Coa_model->get_all();
        $data['clients']   = $this->clients_model->get();
        $data['projects']  = $this->projects_model->get();
        $this->load->view('accounting/journal/form', $data);
    }

    // Editar lançamento
    public function edit($id) {
        if (!has_permission('accounting', '', 'editAccounting')) {
            access_denied('editAccounting');
        }
        if ($this->input->post()) {
            $post = $this->input->post();
            $total_debit  = array_sum(array_column($post['lines'], 'debit'));
            $total_credit = array_sum(array_column($post['lines'], 'credit'));
            if ($total_debit !== $total_credit) {
                set_alert('danger', 'Débito e crédito devem ser iguais');
                redirect('accounting/journal/edit/' . $id);
            }
            $entry_data = [
                'date'        => $post['date'],
                'description' => $post['description'],
                'client_id'   => $post['client_id'] ?: null,
                'project_id'  => $post['project_id'] ?: null,
            ];
            $this->Journal_model->update_entry($id, $entry_data, $post['lines']);
            set_alert('success', 'Lançamento atualizado com sucesso');
            redirect('accounting/journal');
        }
        $data['entry']    = $this->Journal_model->get_entry($id);
        $data['accounts'] = $this->Coa_model->get_all();
        $data['clients']  = $this->clients_model->get();
        $data['projects'] = $this->projects_model->get();
        $this->load->view('accounting/journal/form', $data);
    }

    // Excluir lançamento
    public function delete($id) {
        if (!has_permission('accounting', '', 'deleteAccounting')) {
            access_denied('deleteAccounting');
        }
        $this->Journal_model->delete_entry($id);
        set_alert('success', 'Lançamento removido');
        redirect('accounting/journal');
    }
}