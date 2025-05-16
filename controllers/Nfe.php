<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Nfe extends Admin_controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('accounting/Nfe_model');
        $this->config->load('accounting/nfe', true);
        $nfeConfig = $this->config->item(null, 'accounting/nfe');
        // Carrega a biblioteca sped-nfe (vendor)
        require_once FCPATH . 'vendor/autoload.php';
        $this->nfe = new \NFePHP\NFe\Make();
        $this->tools = new \NFePHP\NFe\Tools($nfeConfig, storage_path('sped-cache'));
    }

    public function create() {
        if ($this->input->post()) {
            $post = $this->input->post();
            $data = [
                'customer_id' => $post['customer_id'],
                'items_json'  => json_encode($post['items']),
            ];
            $id = $this->Nfe_model->insert_request($data);
            redirect('accounting/nfe/send/'.$id);
        }
        // Carregar clientes e itens
        $data['customers'] = $this->clients_model->get();
        $this->load->view('accounting/nfe/form', $data);
    }

    public function send($id) {
        $req = $this->Nfe_model->get($id);
        // 1. Montar XML
        $dom = $this->nfe->taginfNFe(['Id'=>null,'versao'=>'4.00']);
        // ... preencher demais tags (ide -> emit, dest, det, etc.) usando $req->items_json
        $xml = $this->nfe->getXML();
        // 2. Assinar
        $signedXml = $this->tools->signNFe($xml);
        // 3. Enviar para SEFAZ
        $response = $this->tools->sefazEnviaLote([$signedXml], 1);
        $std = $this->tools->sefazConsultaRecibo(json_decode($response)->infRec->nRec);
        // 4. Tratar resposta
        $chave    = $this->tools->lastProtocol->protocol->infProt->chNFe;
        $prot     = $this->tools->lastProtocol->protocol->infProt->nProt;
        $status   = ($this->tools->lastProtocol->protocol->infProt->cStat == 100) ? 'autorizado' : 'denegado';
        // 5. Atualizar base
        $this->Nfe_model->update_status($id, $status, $signedXml, $chave, $prot);
        set_alert('success', 'NF-e '.($status=='autorizado'?'autorizada':'com erro').' - Protocolo '.$prot);
        redirect('accounting/nfe');
    }

    public function index() {
        $data['nfes'] = $this->db->get('acc_nfe')->result();
        $this->load->view('accounting/nfe/list', $data);
    }
}