<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Tax_guides extends Admin_controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('accounting/Tax_guide_model');
    }

    public function create() {
        if ($this->input->post()) {
            $post = $this->input->post();
            // 1. Inserir registro base
            $id = $this->Tax_guide_model->create([
                'type'          => $post['type'],
                'competencia'   => $post['competencia'],
                'company_id'    => $post['company_id'],
                'tax_value'     => $post['tax_value'],
                'bank_code'     => '010'
            ]);
            // 2. Gerar guia via Python API Integra Contador
            $cmd = 'python3 ' . FCPATH . 'modules/accounting/api/generate_tax_guide.py '
                 . escapeshellarg($post['type']) . ' '
                 . escapeshellarg($post['competencia']) . ' '
                 . escapeshellarg($post['tax_value']) . ' '
                 . escapeshellarg($post['company_id']);
            $output = shell_exec($cmd);
            $response = json_decode($output, true);
            if (!empty($response['pdf_path'])) {
                $this->Tax_guide_model->mark_sent($id, $response['pdf_path']);
                set_alert('success','Guia '. $post['type'] .' gerada e salva em '. $response['pdf_path']);
            } else {
                set_alert('danger','Erro ao gerar guia: ' . ($response['error'] ?? '')); 
            }
            redirect('accounting/tax_guides/index');
        }
        $data['companies'] = $this->clients_model->get();
        $this->load->view('accounting/tax_guides/form', $data);
    }

    public function index() {
        $data['guides'] = $this->Tax_guide_model->get_pending();
        $this->load->view('accounting/tax_guides/list', $data);
    }

    public function send_batch() {
        $guides = $this->Tax_guide_model->get_pending();
        foreach ($guides as $g) {
            $this->_send_guide_email($g);
            $this->Tax_guide_model->mark_sent($g->id, $g->file_path);
        }
        set_alert('success','Todas as guias enviadas por e-mail');
        redirect('accounting/tax_guides/index');
    }

    private function _send_guide_email($guide) {
        $this->load->library('email');
        $company = $this->clients_model->get($guide->company_id);
        $this->email->from('no-reply@seucrm.com','Seu CRM');
        $this->email->to($company->email);
        $this->email->subject('Guia '. $guide->type .' competência '. date('m/Y', strtotime($guide->competencia)));
        $this->email->message('Olá, segue em anexo a guia de impostos tipo '. $guide->type .'.');
        $this->email->attach(FCPATH . $guide->file_path);
        $this->email->send();
    }
}
