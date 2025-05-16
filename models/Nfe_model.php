<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Nfe_model extends CI_Model {
    protected $table = 'acc_nfe';

    public function insert_request($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get($id) {
        return $this->db->where('id',$id)->get($this->table)->row();
    }

    public function update_status($id, $status, $xml = null, $chave = null, $protocolo = null) {
        $update = ['status' => $status];
        if ($xml)      $update['xml']      = $xml;
        if ($chave)    $update['chave']    = $chave;
        if ($protocolo)$update['protocolo'] = $protocolo;
        $this->db->where('id',$id)->update($this->table, $update);
    }
}
